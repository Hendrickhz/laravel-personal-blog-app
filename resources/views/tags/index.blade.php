@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">

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
            <a href="{{route('tags.create')}}" class=" btn btn-outline-secondary my-3"> Create New Tag</a>
           </div>

        </div>
        <h3 class=" my-4">Tags List</h3>
        <table class=" table table-bordered">
            <thead>
                <tr class=" table-primary">
                    <th>#</th>
                    <th class=" d-flex justify-content-between"><span>Name</span>  <div class=" d-flex gap-2">
                        <a href="{{route('tags.index',["title"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                         <a href="{{route('tags.index',["title"=>"desc"])}}">
                           <i class="bi bi-chevron-down"></i>
                         </a>
                         <a href="{{route('tags.index')}}">
                           <i class="bi bi-dash-lg"></i>
                         </a>
                     </div>
                    </th>

                    <th>Created At</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($tags as $tag)
                    <tr>
                        <td>
                            {{-- {{$loop->iteration}} --}}
                            {{$tag->id}}
                        </td>

                        <td>{{$tag->tag_name}}</td>
                        <td>{{$tag->created_at->format('d-m-Y')}}</td>
                        <td>
                            <div class=" btn-group btn-group-sm">

                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-light btn-sm"><i class=" bi bi-pencil"></i></a>
                                <button type="submit" form="deleteTagForm{{$tag->id}}" class="btn btn-light btn-sm"><i class=" bi bi-trash3"></i></button>
                                <form action="{{route('tags.destroy',$tag->id)}}"  method="POST" id="deleteTagForm{{$tag->id}}" >
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        {{$tags->links()}}
    </div>
</div>
@endsection
