@extends("layouts.app")

@section("title")
Blogpost | Tags
@endsection

@section("styles")
    <style>
        .all-tags{
            margin-top: 30px;
        }
        .all-tags th, td{
            padding: 10px 20px;
            border-bottom: 1px solid lightgrey;
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
    @if(count($tags) > 0)
            <div class="all-tags">
                <h1>All tags</h1>
                <table>
                    <tr> 
                        <th>#</th>
                        <th>BlogPost Tags</th>
                        <th>BlogPost Created at</th>
                        <th></th>
                    </tr>
                    @foreach($tags as $tag)
                        <tr>    
                            <th>{{ $tag->id }}</th>
                            <td>{{ $tag->tag_name }}</td>
                            <td>{{ date("M j,Y H:i:s a", strtotime($tag->created_at)) }}</td>
                            <td>
                                <button class="view"><a href="{{ route('tags.show', $tag->id) }}">View</a></button>
                                <button class="create"><a href="{{ route('tags.create') }}">Create tags</a></button>
                                <button class="edit"><a href="{{ route('tags.edit', $tag->id) }}">Edit tags</a></button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!--end all-categories-->
    @else 
    <div class="empty-db">  
            <p>No categories yet!</p>
            <button class="create"><a href="{{ route('tags.create') }}">New tag</a></button>
        </div><!-- empty db-->
    @endif
@endsection