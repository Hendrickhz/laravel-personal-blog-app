@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-6 offset-3">
            <h1 class=" fs-1 fw-bolder">{{$article->title}}</h1>
            <p class=" text-muted fs-4">{{Str::words($article->article_excerpt,20)}}</p>
            <div class=" d-flex gap-2 align-items-center">
                <small class=" text-muted">{{$article->created_at->diffForHumans()}}</small> .
                <small class=" text-muted">{{Str::readingMinutes($article->full_text)}} min read</small> .
                <small class=" btn btn-sm btn-light rounded px-2 py-1">{{$article->category->category_name}}</small>
            </div>

            <div class="my-3 d-flex gap-2 small">
                <span>Tags: </span>
                @foreach ($article->tags as $tag)
                    <span class="  text-decoration-underline">#{{$tag->tag_name}}</span>
                @endforeach
           </div>

            <div class="my-3">
                  @if ($article->img)

                <img src=" {{asset(Storage::url($article->img))}}" class="  w-full" alt="" height="500" >
                @else
                <img src=" https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=" class="w-full" alt="" height="500">

                @endif
            </div>
            <div class="">
                <p>{{$article->full_text}}</p>
            </div>
        </div>
    </div>
@endsection
