<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TagRequest;
use App\Http\Resources\Api\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiResponder::handleResources(Tag::all(), TagResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->validated());
        return ApiResponder::success(data: new TagResource($tag), message: 'Tag Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tag $tag)
    {
        return ApiResponder::success(new TagResource($tag));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagRequest  $request
     * @param  Tag  $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return ApiResponder::success(data: new TagResource($tag), message: 'Tag Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->hasAdvertisements()) {
            return ApiResponder::error(message: 'Can\'t Delete This Tag, It Has Advertisements.');
        }
        $tag->delete();
        return ApiResponder::success(message: 'Deleted Successfully!');
    }
}
