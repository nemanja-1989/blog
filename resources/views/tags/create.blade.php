@extends("layouts.app")

@section("title")
Blogpost | Create Tags
@endsection

@section("styles")
    <style>
        
    </style>
@endsection

@section("main-yield-1")
    <button class="back-button"><a href="{{ route('tags.index') }}">View all tags</a></button>
    <div id="create-categories"> 
        <h1>Create new tag</h1>
        <div class="form"> 
            <form action="{{ route('tags.store') }}" method="POST">
                {{ csrf_field() }}
                <label for="tag_name">Tag name</label>
                <input type="text" name="tag_name" id="tag_name">
                <input type="submit" name="submit" value="Create new tag">
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