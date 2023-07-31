@extends('layouts.app')

@section('content')
    <div class="">
        <h4>{{$article->title}}</h4>
        <div class="">
            <span class=" text-muted">{{$article->created_at}}</span>
            <p class="  ">Category: {{$article->category->category_name}}</p>
        </div>
        <div class="mx-auto my-3">
              @if ($article->img)

            <img src=" {{asset(Storage::url($article->img))}}" class="img-thumbnail" alt="" height="500">
            @else
            <img src=" https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=" class="img-thumbnail" alt="" height="500">

            @endif
        </div>
        <div class="">
            <p>{{$article->full_text}}</p>
        </div>
    </div>
@endsection
