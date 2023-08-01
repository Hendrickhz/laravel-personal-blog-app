@extends('layouts.public')

@section('content')
<h2 class=" mb-4">Articles categorized by : '{{$category->category_name}}'</h2>
@if (request()->has('keyword'))
   <h5>Search Keyword: "  {{request()->keyword}} "</h5>
@endif
@forelse ($articles as $article)
   <div class="mb-5">
      <div class="row">
       <div class="col-8">
           <h4 class=" fw-bold"><a class=" text-decoration-none text-black" href="{{route('public.show',$article->article_slug)}}">{{$article->title}}</a></h4>
           <p class="text-muted">
               {{Str::words($article->article_excerpt,10)}}
           </p>
           <div class=" d-flex gap-2 align-items-center">
               <small class=" text-muted">{{$article->created_at->format('M d')}}</small> .
               <small class=" text-muted">{{Str::readingMinutes($article->full_text)}} minutes</small> .
               <small class=" btn btn-sm btn-light rounded px-2 py-1">{{$article->category->category_name}}</small>
           </div>
       </div>
       <div class="col-4">
           @if ($article->img)

           <img src=" {{asset(Storage::url($article->img))}}" class="" alt="" height="150">
           @else
           <img src=" https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=" class="" alt="" height="150">

           @endif
       </div>
      </div>
   </div>
@empty
   <p>There is no article at the momment.</p>
@endforelse
{{$articles->links()}}
@endsection
