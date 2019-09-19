@extends("layouts.app")

@section("title")
BlogPost | Single tag
@endsection

@section("styles")
    <style> 
       .post-count{
           color:grey;
       }
       #single-tag{
           margin-top: 50px;
       }
       #single-tag th, td{
            text-align: left;
            padding: 10px 30px;
            border-bottom: 1px solid lightgrey;
       }
       #fleft{
           float: left;
       }
       #fleft h1{
           margin-top: 0;
       }
       #fright{
           float: right;
       }
       .edit{
           padding: 5px 50px;
       }
       .edit a{
           font-weight: 700;
       }
    </style>
@endsection

@section("main-yield-1")
    <div id="single-tag"> 
        <div id="fleft">
            <h1>{{ $tag->tag_name }} Tag <small class="post-count"><em>( {{ $tag->posts->count() }} Posts )</em></small></h1>
        </div><!--end fleft-->
        <div id="fright"> 
            <button class="edit"><a href="{{ route('tags.edit', $tag->id) }}">Edit tag</a></button>
        </div><!--end fright-->
        <div class="clear"></div>
        <hr>
        <table> 
            <tr> 
                <th>#</th>
                <th>Post title</th>
                <th>Tags</th>
                <th></th>
            </tr>
            @foreach($tag->posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>
                    @foreach($post->tags as $tag)
                        <span class="tags">{{ $tag->tag_name }}</span>
                    @endforeach
                </td>
                <td>
                    <button class="view"><a href="{{ route('posts.show', $post->id) }}">View</a></button>
                </td>
            </tr>
            @endforeach
        </table>
    </div><!--end single-tag-->
@endsection