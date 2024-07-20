<?php

namespace App\Http\Services\Api\Destinations;

use App\Http\Resources\Api\Destinations\DestinationListResource;
use App\Http\Resources\Api\Destinations\DestinationResource;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * class DestinationService;
 *
 * @public setDestination(Destination $destination): DestinationService;
 * @public destinationsList(Request $request): array;
 * @public getDestinationsInRadius(Request $request): array;
 */
class DestinationService
{
    /**
     * @param Destination $destination
     */
    public function __construct(
        protected Destination $destination
    ) {}

    /**
     * @param Destination $destination
     * @return $this
     */
    public function setDestination(Destination $destination): DestinationService
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function destinationsList(Request $request): array
    {
        $destinations = Destination::when(! empty($request->get('name')),
            function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->get('name').'%');
        })->when(! empty($request->get('lon')),
            function (Builder $query) use ($request) {
                $query->where('lon', 'like', '%'.$request->get('lon').'%');
        })->when(! empty($request->get('lat')),
            function (Builder $query) use ($request) {
                $query->where('lat', 'like', '%'.$request->get('lat').'%');
        });

        $count = $destinations->count();
        $destinations = $destinations
            ->offset($request->get('offset', 0))
            ->limit($request->get('limit', 20))
            ->get();

        if ($destinations->isEmpty()) {
            return [
                'destinations' => [],
                'total' => [],
                'message' => __('Destinations list.')
            ];
        }

        return [
            'destinations' => DestinationListResource::collection($destinations),
            'total' => $count,
            'message' => __('Destinations list.')
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getDestinationsInRadius(Request $request): array
    {
        $locations = DB::table('destinations')
            ->select(DB::raw('id, name, lat, lon, ROUND(( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ), 2) AS distance'))
            ->having('distance', '<=', $request->get('radius'))
            ->having('id', '!=', $this->destination->id)
            ->orderBy('distance')
            ->setBindings([
                $this->destination->lat,
                $this->destination->lon,
                $this->destination->lat,
            ]);

        $count = $locations->count();
        $locations = $locations
            ->offset($request->get('offset', 0))
            ->limit($request->get('limit', 20))
            ->get();

        if ($locations->isEmpty()) {
            return [
                'destinations' => [],
                'count' => 0,
                'message' => __('Nearest destination list.'),
            ];
        }

        return [
            'destinations' => DestinationResource::collection($locations),
            'total' => $count,
            'message' => __('Nearest destination list.'),
        ];
    }
}
