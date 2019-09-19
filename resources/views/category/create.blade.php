@extends("layouts.app")

@section("title")
Blogpost | Create Categories
@endsection

@section("styles")
    <style>
        
    </style>
@endsection

@section("main-yield-1")
    <button class="back-button"><a href="{{ route('category.index') }}">View all categories</a></button>
    <div id="create-categories"> 
        <h1>Create new category</h1>
        <div class="form"> 
            <form action="{{ route('category.store') }}" method="POST">
                {{ csrf_field() }}
                <label for="category_name">Category name</label>
                <input type="text" name="category_name" id="category_name">
                <input type="submit" name="submit" value="Create new category">
            </form>
        </div><!--end form-->
        @if(count($errors) > 0)
            <div class="errors">
                <ul> 
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><!--end errors-->
        @endif
    </div><!--end create-categories-->
@endsection