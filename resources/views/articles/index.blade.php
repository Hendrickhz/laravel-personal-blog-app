@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <table class=" table table-bordered">
            <thead>
                <tr class=" table-primary">
                    <th>#</th>
                    <th>Article</th>
                    <th>Category</th>
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
                                <a href="" class="btn btn-light btn-sm"><i class=" bi bi-pencil"></i></a>
                                <a href="" class="btn btn-light btn-sm"><i class=" bi bi-trash3"></i></a>
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
