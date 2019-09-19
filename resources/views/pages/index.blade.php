@extends("layouts.app")

@section("title")
BlogPost | Home
@endsection

@section("styles")
    <style> 
        #welcome{
            margin-top: 50px;
            padding: 50px;
            background: rgba(235, 64, 52);
            color: #fff;
            border-radius: 5px;
        }
        #welcome h1{
            font-size: 55px;
            margin: 0;
        }
        #welcome p{
            margin: 5px 0 0 0;
        }
        .latest-posts{
            border: none;
            border-radius: 5px;
            background: #fff;
            margin-top: 10px;
        }
        .latest-posts a{
            display: block;
            color: rgba(235, 64, 52);
            padding: 10px 15px;
            font-weight: 700;
            text-decoration: none;
        }
        .read-more{
            border: none;
            border-radius: 5px;
            background: rgba(235, 64, 52);
            margin-top: 10px;
        }
        .read-more a{
            display: block;
            color: #fff;
            padding: 10px 15px;
            font-weight: 700;
            text-decoration: none;
        }
        #blogposts{
            margin-top: 50px;
        }
    </style>
@endsection

@section("main-yield-1")
    <div id="welcome">
        <h1>Welcome to our BlogPost site!</h1>
        <p>Thank you so much for visiting! Please read some blogs here!</p>
        <button class="latest-posts"><a href="{{ route('pages.latest') }}">Latest BlogPosts</a></button>
    </div><!--end welcome-->
    @if(count($posts) > 0)
    <div id="blogposts">
        @foreach($posts as $post)
            <h1>{{ $post->title }}</h1>
            <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "...":"" }}</p>
        <button class="read-more"><a href="{{ route('pages.single', $post->slug) }}">Read more</a></button>
        <hr>
        @endforeach
        <div class="paginate">
            {{ $posts->links() }}
        </div><!--end paginate-->
    </div><!--end blogposts-->
    @else 
        <div class="empty-db">  
            <p>No posts yet!</p>
            <button class="create"><a href="{{ route('posts.create') }}">New BlogPost</a></button>
        </div><!-- empty db-->
    @endif
@endsection
