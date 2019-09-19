@extends("layouts.app")

@section("title")
BlogPost | Latest BlogPost
@endsection

@section("styles")
    <style> 
        .back-button{
            margin-top: 30px;
        }
        #latest-blogposts{
            margin-bottom: 120px;
        }
        em{
            color: grey;
        }
    </style>
@endsection

@section("main-yield-1")
    <button class="back-button"><a href="{{ route('pages.index') }}">View all BlogPosts</a></button>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div id="latest-blogposts"> 
                    <img src="{{ url('/img/', $post->image) }}" width="1200px" height="760px" alt="">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ strip_tags($post->body) }}</p>
                    <p>Area:&nbsp;&nbsp;&nbsp;<em>{{ $post->category->category_name }}</em></p>
                    <p>Tags:&nbsp;&nbsp;&nbsp;
                        @foreach($post->tags as $tag)
                            <span class="tags">{{ $tag->tag_name }}</span>
                        @endforeach
                    </p>
                    <p>Published on:&nbsp;&nbsp;&nbsp;<em>{{ date("M j,Y H:i:s a", strtotime($post->created_at)) }}</em></p>
                    <hr>
            </div><!--end latest-blogposts-->
        @endforeach
    @else 
        <div class="empty-db">  
            <p>No BlogPosts yet!</p>
        </div><!-- empty db-->
    @endif
@endsection