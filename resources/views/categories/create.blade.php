@extends('layouts.app')

@section('content')
<div class=" container">
    <div class="row justify-content-center">
        <div class=" col-6 card">
              <div class="card-body">
                <h4>Create A new category</h4>
                <form id="createCategoryForm" action="{{route('categories.store')}}" method="POST" >
                    @csrf
                </form>

                        <div class="mb-3">
                            <label class=" form-label" for="">Category Name</label>
                            <input form="createCategoryForm" type="text" value="{{old('category_name')}}" class=" form-control @error('category_name') is-invalid @enderror" name="category_name">
                            @error('category_name')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" form="createCategoryForm" class=" btn btn-primary">Create</button>
                        </div>
              </div>

        </div>
    </div>
</div>

@endsection
