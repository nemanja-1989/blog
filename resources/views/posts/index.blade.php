@extends("layouts.app")

@section("title")
BlogPost | All BlogPosts
@endsection

@section("styles")
    <style>
        #all-blogposts{
            margin-top: 30px;
        }
        #all-blogposts table{
            margin-top: 30px;
            display: inline-block;
        }

        #all-blogposts th, td{
            border-bottom: 1px solid lightgrey;
            padding: 10px 20px;
            text-align: left;
        }
    </style>
@endsection

@section("main-yield-1")
    @if(Session::has("Success"))
        <div class="session"> 
            <strong>{{ Session::get("Success") }}</strong>
        </div><!--end session-->
    @endif
        <h1 style="margin-top: 30px;">All Posts</h1>
    @if(count($posts) > 0)
        <div id="all-blogposts">
            <table>
                <tr> 
                    <th>#</th>
                    <th>BlogPost title</th>
                    <th>BlogPost decription</th>
                    <th>BlogPost was created</th>
                    <th></th>
                </tr>
                @foreach($posts as $post)
                    <tr> 
                        <th>{{ $post->id }}</th>
                        <td>{{ substr($post->title, 0, 10) }}{{ strlen($post->title) > 10 ? "...":"" }}</td>
                        <td>{{ substr(strip_tags($post->body), 0, 50) }}{{ strlen(strip_tags($post->body)) > 50 ? "...":"" }}</td>
                        <td>{{ date("M j,Y H:i:s a", strtotime($post->created_at)) }}</td>
                        <td>
                            <button class="view"><a href="{{ route('posts.show', $post->id) }}">View BlogPost</a></button>
                            <button class="create"><a href="{{ route('posts.create') }}">New BlogPost</a></button>
                            <button class="edit"><a href="{{ route('posts.edit', $post->id) }}">Edit BlogPost</a></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div><!--end all blogposts-->
    @else 
        <div class="empty-db">  
            <p>No posts yet!</p>
            <button class="create"><a href="{{ route('posts.create') }}">New BlogPost</a></button>
        </div><!-- empty db-->
    @endif
@endsection