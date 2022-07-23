<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\JsonResponse;

class AdvertisementController extends Controller
{
    /**
     * list all advertisements.
     *
     * @return JsonResponse
     */
    public function index($user_id = null): JsonResponse
    {
        return ApiResponder::handleResources(
            Advertisement::query()
                ->ofUser($user_id)
                ->ofCategory(request()->category_id)
                ->hasTags(request()->tag)
                ->get(),
            AdvertisementResource::class
        );
    }
}
