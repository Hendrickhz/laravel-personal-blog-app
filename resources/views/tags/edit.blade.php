@extends('layouts.app')

@section('content')
<div class=" container">
    <div class="row justify-content-center">
        <div class=" col-6 card">
              <div class="card-body">
                <h4>Update the Tag</h4>
                <form id="updateTagForm" action="{{route('tags.update',$tag->id)}}" method="POST" >
                    @csrf
                    @method('put')
                </form>

                        <div class="mb-3">
                            <label class=" form-label" for="">tag Name</label>
                            <input form="updateTagForm" type="text" value="{{old('tag_name',$tag->tag_name)}}" class=" form-control @error('tag_name') is-invalid @enderror" name="tag_name">
                            @error('tag_name')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" form="updateTagForm" class=" btn btn-primary">Update</button>
                        </div>
              </div>

        </div>
    </div>
</div>

@endsection
