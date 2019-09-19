@extends("layouts.app")

@section("title")
Blogpost | Categories
@endsection

@section("styles")
    <style>
        .all-categories{
            margin-top: 30px;
        }
        .all-categories th, td{
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
    @if(count($categories) > 0)
            <div class="all-categories">
                <h1>All categories</h1>
                <table>
                    <tr> 
                        <th>#</th>
                        <th>BlogPost Category</th>
                        <th>BlogPost Created at</th>
                        <th></th>
                    </tr>
                    @foreach($categories as $category)
                        <tr>    
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ date("M j,Y H:i:s a", strtotime($category->created_at)) }}</td>
                            <td>
                                <button class="create"><a href="{{ route('category.create') }}">Create categories</a></button>
                                <button class="edit"><a href="{{ route('category.edit', $category->id) }}">Edit categories</a></button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!--end all-categories-->
    @else 
    <div class="empty-db">  
            <p>No categories yet!</p>
            <button class="create"><a href="{{ route('category.create') }}">New Category</a></button>
        </div><!-- empty db-->
    @endif
@endsection