@extends("layouts.app")

@section("title")
Blogpost | Edit Categories
@endsection

@section("styles")
    <style>
        #category-edit{
            width: 49%;
            background: rgba(61, 151, 224);
            color: #fff; 
            float: left;
        }
        #category-delete{
            width: 49%;
            background: rgb(250, 36, 36);
            color: #fff; 
            float: right;
        }
    </style>
@endsection

@section("main-yield-1")
    @if(Session::has("Success"))
        <div class="session">
            <strong>{{ Session::get("Success") }}</strong>
        </div><!--end session-->
    @endif
    <button class="back-button"><a href="{{ route('category.index') }}">View all categories</a></button>
    <div id="edit-category"> 
        <div class="form">
            <form action="{{ route('category.update', $category->id) }}" method="POST"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <label for="category_name">Category name</label>
                <input type="text" name="category_name" id="category_name" value="{{ $category->category_name }}">
                <input id="category-edit" type="submit" name="submit" value="Edit category">
            </form>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST"> 
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input id="category-delete" type="submit" name="submit" value="Delete category">
            </form>
            <div class="clear"></div>
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
    </div><!--end edit-category-->
@endsection