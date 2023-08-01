<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::

            when(request()->has('keyword'), function ($query) {
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
        $categories=Category::all();
        return view('public.articles', compact('articles','categories'));
    }
    public function show($slug)
    {
        $article= Article::where("article_slug",$slug)->firstOrFail();
         return view('public.show',compact('article'));
    }
    public function categorized($slug)
    {
        $category=Category::where('category_slug',$slug)->firstOrFail();
        $articles = Article::
            where('category_id',$category->id)->
            when(request()->has('keyword'), function ($query) {
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
        return view('public.categorized', compact('articles','category'));
    }
}
