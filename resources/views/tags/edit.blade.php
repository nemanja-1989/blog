@extends("layouts.app")

@section("title")
Blogpost | Edit Tags
@endsection

@section("styles")
    <style>
        #tag-edit{
            width: 49%;
            background: rgba(61, 151, 224);
            color: #fff; 
            float: left;
        }
        #tag-delete{
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
    <button class="back-button"><a href="{{ route('tags.index') }}">View all tags</a></button>
    <div id="edit-tag"> 
        <div class="form">
            <form action="{{ route('tags.update', $tag->id) }}" method="POST"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <label for="tag_name">Tag name</label>
                <input type="text" name="tag_name" id="category_name" value="{{ $tag->tag_name }}">
                <input id="tag-edit" type="submit" name="submit" value="Edit tag">
            </form>
            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"> 
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input id="tag-delete" type="submit" name="submit" value="Delete tag">
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