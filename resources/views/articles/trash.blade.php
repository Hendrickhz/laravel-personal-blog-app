@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">

        @if (request()->has('keyword'))
            <h5>Search Keyword: "  {{request()->keyword}} "</h5>
        @endif

       @if (Session::has('forceDelete_message'))
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{Session::get('forceDelete_message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       @endif
        <div class="row">
           <div class="col-3">


            <a href="{{route('articles.index')}}" class=" btn btn-outline-secondary my-3">Article List <i class="bi bi-list-task"></i></a>
           </div>
            <div class=" my-3 offset-4 col-5">
                <form action="{{ route('articles.showTrashBin') }}" method="get">
                <div class=" input-group ">
                    <input placeholder="Search article..." type="text" class=" form-control" name="keyword"
                        @if (request()->has('keyword')) value="{{ request()->keyword }}" @endif>
                    @if (request()->has('keyword'))
                        <a href="{{ route('articles.showTrashBin') }}" class="btn btn-danger"> <i class=" bi bi-x"></i></a>
                    @endif
                    <button class=" btn btn-primary"> <i class=" bi bi-search"></i></button>
                </div>
            </form></div>
        </div>
        <h3 class=" my-4">Trash Bin  <i class=" bi bi-trash"></i></h3>
        <table class=" table table-bordered">
            <thead>
                <tr class=" table-primary">
                    <th>#</th>
                    <th class=" d-flex justify-content-between"><span>Article</span>  <div class=" d-flex gap-2">
                        <a href="{{route('articles.showTrashBin',["title"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                         <a href="{{route('articles.showTrashBin',["title"=>"desc"])}}">
                           <i class="bi bi-chevron-down"></i>
                         </a>
                         <a href="{{route('articles.showTrashBin')}}">
                           <i class="bi bi-dash-lg"></i>
                         </a>
                     </div>
                    </th>
                    <th class="">
                        <div class="d-flex justify-content-between">


                        <span>Category</span>
                         <div class=" d-flex gap-2">
                        <a href="{{route('articles.showTrashBin',["category"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                         <a href="{{route('articles.showTrashBin',["category"=>"desc"])}}">
                           <i class="bi bi-chevron-down"></i>
                         </a>
                         <a href="{{route('articles.showTrashBin')}}">
                           <i class="bi bi-dash-lg"></i>
                         </a>
                        </div>
                     </div></th>
                    <th>  <div class="  d-flex justify-content-between">
                        <span>
                           Deleted At
                        </span>
                        <div class=" d-flex gap-2">
                            <a href="{{route('articles.showTrashBin',["deleted_at"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                             <a href="{{route('articles.showTrashBin',["deleted_at"=>"desc"])}}">
                               <i class="bi bi-chevron-down"></i>
                             </a>
                             <a href="{{route('articles.showTrashBin')}}">
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
                        <td>

                                    {{$article->deleted_at->format('d-m-Y')}}

                        </td>
                        <td>{{$article->created_at->format('d-m-Y')}}</td>
                        <td>
                            <div class=" btn-group btn-group-sm">
                                <a href="{{route('articles.restore',$article->id)}}" class="btn btn-light btn-sm"><i class="bi bi-arrow-clockwise"></i></a>

                                <button type="submit" form="forceDeleteArticleForm{{$article->id}}" class="btn btn-light btn-sm"><i class=" bi bi-trash3"></i></button>
                                <form action="{{route('articles.forceDelete',$article->id)}}"  method="POST" id="forceDeleteArticleForm{{$article->id}}" >
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
