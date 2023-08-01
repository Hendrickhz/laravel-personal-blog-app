<div class=" position-sticky " style="top: 10%">
    <p>Discover more of what matters to you</p>
    <div class="d-flex gap-3 flex-wrap ">
        @foreach (App\Models\Category::all() as $category)
            <a href="{{route('public.categorized',$category->category_slug)}}" class=" btn btn-light">{{$category->category_name}}</a>
        @endforeach
    </div>

</div>
