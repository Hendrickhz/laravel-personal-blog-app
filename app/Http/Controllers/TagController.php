<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::paginate(10)->withQueryString();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $tag=Tag::create([
            "tag_name"=>$request->tag_name,
        ]);
        return redirect()->route('tags.index')->with('create_message',$tag->tag_name. " is created successfully.");
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            "tag_name"=>$request->tag_name,
        ]);
        return redirect()->route('tags.index')->with('update_message',$tag->tag_name. " is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
         return redirect()->back()->with('delete_message',$tag->tag_name. " is deleted permanently.");
    }
}
