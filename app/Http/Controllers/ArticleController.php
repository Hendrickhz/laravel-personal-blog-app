<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::when(request()->has('title'), function ($query) {
            $titleSort = request()->title;
            $query->orderBy("title", $titleSort);
        })
            ->when(request()->has('category'), function ($query) {
                $categorySort = request()->category;
                $query->orderBy("category_id", $categorySort);
            })
            ->when(request()->has('keyword'), function ($query) {
                $query->where(function (Builder $builder) {
                    $keyword = request()->keyword;
                    $builder->where("title", "like", "%" . $keyword . "%");
                    $builder->orWhere("full_text", "like", "%" . $keyword . "%");

                });
            })
            ->latest("id")
            ->with('category')
            ->paginate(10)
            ->withQueryString();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {



        $article= new Article;
        $article->title= $request->title;
        $article->full_text= $request->description;
        $article->article_slug= Str::slug($request->title);
        $article->article_excerpt= Str::words($request->title,30);
        $article->category_id=$request->category_id;

        $img="";
        if ($request->hasFile('img')) {

            $img = $request->file('img')->store('public/img');
            $article->img=$img;

        }


        $article->save();
        return redirect()->route('articles.index')->with("create_message","A new article is created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories=Category::all();
        return view('articles.edit',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
            $article->full_text = $request->description;
            $article->article_slug = Str::slug($request->title);
            $article->article_excerpt = Str::words($request->title, 30);
            $article->category_id = $request->category_id;

            // Check if a new thumbnail is uploaded
            if ($request->hasFile('thumbnail')) {
                // Delete the old thumbnail if it exists
                if ($article->img) {
                    Storage::delete($article->img);
                }

                // Store the new thumbnail
                $thumbnailPath = $request->file('thumbnail')->store('public/img');

                $article->img = $thumbnailPath;
            }

            $article->update();
            // $article->tags()->sync($request->tags);
            return redirect()->route('articles.index')->with("update_message", "Article updated successfully.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
         return redirect()->route('articles.index')->with('delete_message',"Article is deleted Successfully.");
    }
}
