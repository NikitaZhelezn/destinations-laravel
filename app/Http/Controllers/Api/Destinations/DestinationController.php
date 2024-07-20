<?php

namespace App\Http\Controllers\Api\Destinations;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationListRequest;
use App\Http\Requests\DestinationRequest;
use App\Http\Services\Api\Destinations\DestinationService;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;

class DestinationController extends ApiController
{
    /**
     * @param DestinationService $service
     */
    public function __construct(
        protected DestinationService $service
    ) {}

    /**
     * @param DestinationListRequest $request
     * @return JsonResponse
     */
    public function get(DestinationListRequest $request): JsonResponse
    {
        return $this->response($this->service->destinationsList($request));
    }

    /**
     * @param DestinationRequest $request
     * @return JsonResponse
     */
    public function nearDestinations(DestinationRequest $request): JsonResponse
    {
        return $this->response([
            'destinations' => $this->service->setDestination($request->destination)
                ->getDestinationsInRadius($request),
            'message' => __('Nearest destination list.'),
        ]);
    }
}
