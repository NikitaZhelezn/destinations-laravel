<?php

use App\Http\Controllers\Api\Destinations\DestinationController;
use Illuminate\Support\Facades\Route;

/**
 * Destinations API.
 */
Route::group(['as' => 'api.destinations.', 'prefix' => 'destinations'], function () {
    /** Get list of existed destination with Offset and Limit */
    Route::get('list', [DestinationController::class, 'get'])
        ->name('list');

    /** Get nearby locations by radius and start destination with Offset and Limit. */
    Route::get('near-list', [DestinationController::class, 'nearDestinations'])
        ->name('near-list');
});
