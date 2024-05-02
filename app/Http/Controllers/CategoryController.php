<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        return view('category.index', ['categories' => $categories]);
    }

    public function reorder()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('category.reorder', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        $categoryTypes = CategoryType::all();
        return view('category.create', ['categories' => $categories, 'categoryTypes' => $categoryTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('category.reorder');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id', null)->get();
        $categoryTypes = CategoryType::all();
        return view('category.edit', ['category' => $category, 'categories' => $categories, 'categoryTypes' => $categoryTypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
       $category->update($request->validated());
        return redirect()->route('category.reorder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.reorder');
    }
}
