@extends('layouts.app')

@section('content')
    <div class="">
        <h4>{{$article->title}}</h4>
        <div class="">
            <span class=" text-muted">{{$article->created_at}}</span>
            <p class="  ">Category: {{$article->category->category_name}}</p>
        </div>
        <div class="mx-auto my-3">
            <img src="{{$article->img}}" width="500" class=" img-thumbnail " alt="">
        </div>
        <div class="">
            <p>{{$article->full_text}}</p>
        </div>
    </div>
@endsection
