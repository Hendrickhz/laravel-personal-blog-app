@extends('layouts.app')

@section('content')
<div class=" container">
    <div class="row">
        <div class="col-12">
            <h4>Create A new article</h4>
            <form id="createArticleForm" action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            </form>
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class=" form-label" for="">Article Title</label>
                        <input form="createArticleForm" type="text" value="{{old('title')}}" class=" form-control @error('title') is-invalid @enderror" name="title">
                        @error('title')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label class=" form-label" for="">Description</label>
                        <textarea form="createArticleForm" name="description" class=" form-control @error('description') is-invalid @enderror" rows="17">{{old('description')}}</textarea>
                        @error('description')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   </div>

                   <div class="col-lg-4">
                    <div class="mb-3">
                        <label class=" form-label" for="">Article Thumbnail</label>
                        <div class="single-photo-upload  d-flex justify-content-center align-items-center">
                            <div class=" text-center upload-logo">
                                <i class="bi bi-upload"></i>
                                <p class="mb-0">Upload</p>
                            </div>
                        </div>
                        <input form="createArticleForm" type="file"  class=" form-control d-none real-upload @error('img') is-invalid @enderror" name="img">
                        @error('img')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class=" form-label" for="">Article Photos</label>
                        {{-- <div class="  d-flex justify-content-center align-items-center">
                            <div class=" text-center upload-logo">
                                <i class="bi bi-upload"></i>
                                <p class="mb-0">Upload</p>
                            </div>
                        </div> --}}
                        {{-- <input form="createArticleForm" type="file"  class=" form-control  @error('photos') is-invalid @enderror" name="photos[]" multiple accept="image/jpeg,image/png">
                        @error('photos')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('photos.*')
                            <div class=" text-danger small">{{ $message }}</div>
                        @enderror --}}
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $item)
                                {{$item}}
                            @endforeach
                        @endif --}}
                    </div>
                    <div class="mb-3">
                        <label class=" form-label" for="">Category</label>
                        <select form="createArticleForm" class=" form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option >Choose Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @selected(old('category_id')== $category->id)>
                                {{$category->category_name}}
                            </option>
                            @endforeach
                        </select>

                        @error('category')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <label class=" form-label" for="">Tags</label>
                        @foreach (App\Models\Tag::all() as $tag)
                        <div class="form-check">
                            <input form="createArticleForm"
                            class="form-check-input"
                            type="checkbox"
                            name="tags[]"
                            value="{{$tag->id}}"
                            id="tag_{{$tag->id}}"
                           @checked(in_array($tag->id,old('tags',[])))
                            >
                            <label class="form-check-label" for="tag_{{$tag->id}}">
                                {{$tag->tag_name}}
                            </label>
                        </div>
                        @endforeach
                             @error('tags')
                        <div class=" text-danger small">{{ $message }}</div>
                            @enderror @error('tags.*')
                    <div class=" text-danger small">{{ $message }}</div>
                           @enderror
                    </div>
                    <button form="createArticleForm" class=" btn btn-primary w-100">Create</button>
                   </div>
            </div>

        </div>
    </div>
</div>
@vite('resources/js/photo-upload.js')
@endsection
