@extends('layouts.app')

@section('content')
<div class=" container">
    <div class="row justify-content-center">
        <div class=" col-6 card">
              <div class="card-body">
                <h4>Update the category</h4>
                <form id="updateCategoryForm" action="{{route('categories.update',$category->id)}}" method="POST" >
                    @csrf
                    @method('put')
                </form>

                        <div class="mb-3">
                            <label class=" form-label" for="">Category Name</label>
                            <input form="updateCategoryForm" type="text" value="{{old('category_name',$category->category_name)}}" class=" form-control @error('category_name') is-invalid @enderror" name="category_name">
                            @error('category_name')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" form="updateCategoryForm" class=" btn btn-primary">Update</button>
                        </div>
              </div>

        </div>
    </div>
</div>

@endsection
