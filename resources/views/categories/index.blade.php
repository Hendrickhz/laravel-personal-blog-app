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
            <a href="{{route('categories.create')}}" class=" btn btn-outline-secondary my-3"> Create New Category</a>
           </div>
           
        </div>
        <h3 class=" my-4">Categories List</h3>
        <table class=" table table-bordered">
            <thead>
                <tr class=" table-primary">
                    <th>#</th>
                    <th class=" d-flex justify-content-between"><span>Name</span>  <div class=" d-flex gap-2">
                        <a href="{{route('categories.index',["title"=>"asc"])}}"> <i class="bi bi-chevron-up"></i></a>

                         <a href="{{route('categories.index',["title"=>"desc"])}}">
                           <i class="bi bi-chevron-down"></i>
                         </a>
                         <a href="{{route('categories.index')}}">
                           <i class="bi bi-dash-lg"></i>
                         </a>
                     </div>
                    </th>

                    <th>Created At</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{-- {{$loop->iteration}} --}}
                            {{$category->id}}
                        </td>

                        <td>{{$category->category_name}}</td>
                        <td>{{$category->created_at->format('d-m-Y')}}</td>
                        <td>
                            <div class=" btn-group btn-group-sm">

                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-light btn-sm"><i class=" bi bi-pencil"></i></a>
                                <button type="submit" form="deleteCategoryForm{{$category->id}}" class="btn btn-light btn-sm"><i class=" bi bi-trash3"></i></button>
                                <form action="{{route('categories.destroy',$category->id)}}"  method="POST" id="deleteCategoryForm{{$category->id}}" >
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
</div>
@endsection
