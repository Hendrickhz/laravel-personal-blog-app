@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">

        @if (request()->has('keyword'))
            <h5>Search Keyword: "  {{request()->keyword}} "</h5>
        @endif
       @if (Session::has('create_message'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('create_message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       @endif
       @if (Session::has('update_message'))
       <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{Session::get('update_message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       @endif
       @if (Session::has('delete_message'))
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{Session::get('delete_message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       @endif
        <div class="row">
           <div class="col-3">
            <a href="{{route('articles.create')}}" class=" btn btn-outline-secondary my-3"> Create Article</a>

            <a href="" class=" btn btn-outline-secondary my-3">Trash Bin <i class=" bi bi-trash2"></i></a>
           </div>
            <div class=" my-3 offset-4 col-5">
                <form action="{{ route('articles.index') }}" method="get">
                <div class=" input-group ">
                    <input placeholder="Search article..." type="text" class=" form-control" name="keyword"
                        @if (request()->has('keyword')) value="{{ request()->keyword }}" @endif>
                    @if (request()->has('keyword'))
                        <a href="{{ route("articles.index") }}" class="btn btn-danger"> <i class=" bi bi-x"></i></a>
                    @endif
                    <button class=" btn btn-primary"> <i class=" bi bi-search"></i></button>
                </div>
            </form></div>
        </div>
        <h3 class=" my-4">Articles List</h3>
        <table class=" table table-bordered">
            <thead>
                <tr class=" table-primary">
                    <th>#</th>
                    <th class=" d-flex justify-content-between"><span>Article</span>  <div class=" d-flex gap-2">
                        <a href="{{route('articles.index',["title"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                         <a href="{{route('articles.index',["title"=>"desc"])}}">
                           <i class="bi bi-chevron-down"></i>
                         </a>
                         <a href="{{route('articles.index')}}">
                           <i class="bi bi-dash-lg"></i>
                         </a>
                     </div>
                    </th>
                    <th class="">
                        <div class="d-flex justify-content-between">


                        <span>Category</span>
                         <div class=" d-flex gap-2">
                        <a href="{{route('articles.index',["category"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                         <a href="{{route('articles.index',["category"=>"desc"])}}">
                           <i class="bi bi-chevron-down"></i>
                         </a>
                         <a href="{{route('articles.index')}}">
                           <i class="bi bi-dash-lg"></i>
                         </a>
                        </div>
                     </div></th>
                    <th>Uploaded At</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($articles as $article)
                    <tr>
                        <td>
                            {{-- {{$loop->iteration}} --}}
                            {{$article->id}}
                        </td>
                        <td class=" ">
                            <p>{{$article->title}}</p>
                            <small class=" text-muted">{{Str::words($article->article_excerpt,10,'...')}}</small>
                        </td>
                        <td>{{$article->category->category_name}}</td>
                        <td>{{$article->created_at->format('d-m-Y')}}</td>
                        <td>
                            <div class=" btn-group btn-group-sm">
                                <a href="{{route('articles.show',$article->id)}}" class="btn btn-light btn-sm"><i class=" bi bi-eye"></i></a>
                                <a href="{{route('articles.edit',$article->id)}}" class="btn btn-light btn-sm"><i class=" bi bi-pencil"></i></a>
                                <button type="submit" form="deleteArticleForm{{$article->id}}" class="btn btn-light btn-sm"><i class=" bi bi-trash3"></i></button>
                                <form action="{{route('articles.destroy',$article->id)}}"  method="POST" id="deleteArticleForm{{$article->id}}" >
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        {{$articles->links()}}
    </div>
</div>
@endsection
