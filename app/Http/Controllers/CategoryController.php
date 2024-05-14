<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceWithEntries;
use App\Http\Resources\CategoryTypeResource;
use App\Http\Resources\CategoryWithEntriesResource;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        return CategoryResource::collection($categories);
    }

    public function allCategoryTypes()
    {
        $categoryTypes = CategoryType::all()->except([2,3,4,5]);
        return CategoryTypeResource::collection($categoryTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Request $request)
    {
        if($request->has('withEntries')) {
            return new CategoryWithEntriesResource($category);
        }
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
       $category->update($request->validated());
       return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
