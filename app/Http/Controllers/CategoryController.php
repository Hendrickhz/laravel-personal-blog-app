<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::
        when(request()->has('title'), function ($query) {
            $nameSort = request()->title;
            $query->orderBy("category_name", $nameSort);
        })
        ->paginate(10)->withQueryString();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
     $category=   Category::create([
            "category_name"=>$request->category_name,
            "category_slug"=>Str::slug($request->category_name)
        ]);
         return  redirect()->route('categories.index')->with('create_message',$category->category_name. " is created successfully.");
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            "category_name"=>$request->category_name,
            "category_slug"=>Str::slug($request->category_name)
        ]);
        return  redirect()->route('categories.index')->with('create_message',$category->category_name. " is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
       $category->delete();
        return redirect()->back()->with('delete_message',$category->category_name. " is deleted permanently");
    }
}
