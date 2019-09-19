@extends("layouts.app")

@section("title")
BlogPost | Delete Comments
@endsection

@section("styles")
    <style> 
        #edit-comments{
            margin-left: 300px;
        }
    </style>
@endsection

@section("main-yield-1")
    @if(Session::has("Success"))
        <div class="session"> 
            <strong>{{ Session::get("Success") }}</strong>
        </div><!--end session-->
    @endif
    <div id="edit-comments"> 
        <button class="back-button"><a href="{{ route('posts.show', $comment->post->id) }}">Back</a></button>
        <h1>Delete Comment</h1>
        <div class="form"> 
            <form action="{{ route('comments.update', $comment->id) }}" method="POST"> 
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <label for="name">Name</label>
                <input type="text" name="name" disabled value="{{ $comment->name }}">
                <label for="email">Email address</label>
                <input type="text" name="email" disabled value="{{ $comment->email }}">
                <label for="comment">Comment</label>
                <textarea name="comment">{{ $comment->comment }}</textarea>
                <input type="submit" name="submit" value="Delete Comment">
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
    </div><!--end section-->
@endsection