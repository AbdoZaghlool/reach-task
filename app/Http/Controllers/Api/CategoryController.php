<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiResponder::handleResources(Category::all(), CategoryResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return ApiResponder::success(data: new CategoryResource($category), message: 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return ApiResponder::success(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return ApiResponder::success(data: new CategoryResource($category), message: 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->hasAdvertisements()) {
            return ApiResponder::error(message: 'Can\'t Delete This Category, It Has Advertisements.');
        }
        $category->delete();
        return ApiResponder::success(message: 'Deleted Successfully!');
    }
}
