@extends('layouts.app')

@section('content')
<div class=" container">
    <div class="row justify-content-center">
        <div class=" col-6 card">
              <div class="card-body">
                <h4>Create A new Tag</h4>
                <form id="createTagForm" action="{{route('tags.store')}}" method="POST" >
                    @csrf
                </form>

                        <div class="mb-3">
                            <label class=" form-label" for="">Tag Name</label>
                            <input form="createTagForm" type="text" value="{{old('tag_name')}}" class=" form-control @error('tag_name') is-invalid @enderror" name="tag_name">
                            @error('tag_name')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" form="createTagForm" class=" btn btn-primary">Create</button>
                        </div>
              </div>

        </div>
    </div>
</div>

@endsection
