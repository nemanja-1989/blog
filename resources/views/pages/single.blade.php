@extends("layouts.app")

@section("title")
BlogPost | Single BlogPost
@endsection

@section("styles")
    <style> 
        .back-button{
            margin-top: 30px;
        }
        em{
            color: grey;
        }
        .all-comments{
            margin-top: 60px;
        }
        .comments{
            margin-top: 60px;
        }
        #comments{
            margin-top: 30px;
            border-bottom: 1px solid lightgrey;
        }
        #comments p{
            margin-left: 70px;
            font-family: Raleway;
        }
        #gravatar{
            float: left;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        #p1{
            margin: 0;
        }
        #p2{
            margin: 0;
        }
    </style>
@endsection

@section("main-yield-1")
<button class="back-button"><a href="{{ route('pages.index') }}">View all BlogPosts</a></button>
    @if(count($posts) > 0)
    <div id="single-blogpost"> 
        @foreach($posts as $post)
            <img src="{{ url('img/' . $post->image) }}" width="1200px" height="760px" alt="">
            <h2>{{ $post->title }}</h2>
            <p>{{ strip_tags($post->body) }}</p>
            <p><strong>Area:&nbsp;&nbsp;&nbsp;</strong><em>{{ $post->category->category_name }}</em></p>
            <p><strong>Tags:&nbsp;&nbsp;&nbsp;</strong>
                @foreach($post->tags as $tag)
                    <span class="tags">{{ $tag->tag_name }}</span>
                @endforeach
            </p>
            <p><strong>Published on:</strong>&nbsp;&nbsp;&nbsp;<em>{{ date("M j,Y H:i:s a", strtotime($post->created_at)) }}</em></p>
        @endforeach
    </div><!--end sigle-blogpost-->
    <div class="comments">
        <h1>Comment here</h1> 
        <div class="form">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                {{ csrf_field() }}
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <label for="comment">Comment</label>
                <textarea name="comment"></textarea>
                <input type="submit" name="submit" value="Comment"> 
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
    </div><!--end comments-->
    <div class="all-comments"> 
        <h2>Comments &nbsp;&nbsp;&nbsp;(<small>{{ $post->comments->count() }}</small> <img src="/img/comment.png" width="20px" height="20px">)</h2>
            @foreach($post->comments as $comment)
                <div id="comments">
                    <img id="gravatar" src={{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?d=mm" }}> 
                    <p id="p1"><strong>{{ $comment->name }}</strong></p>
                    <p id="p2"><small><em>{{ date("M j,Y H:i:s A", strtotime($comment->created_at)) }}</em></small></p>
                    <p>{{ $comment->comment }}</p>
                </div><!--end comments-->
            @endforeach
    </div><!--end all-comments-->
    @else 
        <div class="empty-db">  
            <p>No posts yet!</p>
            <button class="create"><a href="{{ route('posts.create') }}">New BlogPost</a></button>
        </div><!-- empty db-->
    @endif
@endsection