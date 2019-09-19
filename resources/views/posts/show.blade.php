@extends("layouts.app")

@section("title")
BlogPost | Single BlogPost
@endsection

@section("styles")
    <style>
      #single-post{
          margin-top: 30px;
      }
      em{
          color: grey;
      }
      #p-url a{
          text-decoration: none;
          color: grey;
      }
      .url-box{
          background: rgba(240, 243, 247);
          border-radius: 5px;
          margin-top: 20px;
          width: 500px;
          padding: 10px 0;
      }
      #comments{
          margin-top: 30px;
      }
      #comment-pic{
          width: 20px;
          height: 20px;
      }
      #comments th, td{
          border-bottom: 1px solid lightgrey;
          padding: 10px 20px;
          text-align: left;
      }
      .edit img{
          width: 15px;
      }
      .delete img{
          width: 15px;
      }
    </style>
@endsection

@section("main-yield-1")
    @if($post)
        <div id="single-post"> 
            <button class="back-button"><a href="{{ route('posts.index') }}">View all BlogPosts</a></button>
            <img src="{{ url('/img', $post->image) }}" width="1200px" height="760px" alt="">
            <h2>{{ $post->title }}</h2>
            <p>{!! $post->body !!}</p>
            <div class="url-box">
                <p id="p-url"><strong>Url address:</strong><em>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('pages.single', $post->slug) }}">{{ route('pages.single', $post->slug) }}</a></em></p>
                <p><strong>Category:&nbsp;&nbsp;&nbsp;&nbsp;</strong><em>{{ $post->category->category_name }}</em></p>
                <p><strong>Tags:&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    @foreach($post->tags as $tag)
                       <span class="tags"> {{ $tag->tag_name }} </span>
                    @endforeach
                </p>
                <p><strong>Published on:</strong><em>&nbsp;&nbsp;&nbsp;&nbsp;{{ date("M j,Y H:i:s a", strtotime($post->created_at)) }}</em></p>
                <button class="create"><a href="{{ route('posts.create') }}">New BlogPost</a></button>
                <button class="edit"><a href="{{ route('posts.edit', $post->id) }}">Edit BlogPost</a></button>
            </div><!--end url-box-->
            <div id="comments"> 
                <h2><img id="comment-pic" src="/img/comment.png"> Comments <small>({{ $post->comments->count() }})</small></h2>
                <table> 
                    <tr> 
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Added</th>
                        <th></th>
                    </tr>
                    @foreach($post->comments as $comment)
                    <tr> 
                        <th>{{ $comment->id }}</th>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ substr($comment->comment, 0, 30) }}{{ strlen($comment->comment) > 30 ? "...":"" }}</td>
                        <td>{{ date("M j,Y - H:i:s A", strtotime($comment->created_at)) }}</td>
                        <td>
                            <button class="edit"><a href="{{ route('comments.edit', $comment->id) }}"><img src="/img/pencil.png"></a></button>
                            <button class="delete"><a href="{{ route('comments.delete', $comment->id) }}"><img src="/img/trash.png"></a></button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!--end comments-->
        </div><!--end sigle-post-->
    @else 
    <div class="empty-db">  
            <p>No posts yet!</p>
        </div><!-- empty db-->
    @endif
@endsection