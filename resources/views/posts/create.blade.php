@extends("layouts.app")

@section("title")
BlogPost | Create BlogPost
@endsection

@section("styles")
    <style>
        #create-post{
            margin-left: 300px;
        }
        #create-post form{
            width: 600px;
        }
        form input[type="file"]{
            border: none;
            color: transparent;
        }
        #category-select{
            display: block;
            font-size: 16px;
            font-family: sans-serif;
            font-weight: 700;
            color: #444;
            line-height: 1.3;
            width: 100%;
            max-width: 100%; 
            box-sizing: border-box;
            margin: 0;
        }
        .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
        }
        .custom-file-input::before {
        content: 'No file chosen';
        color: rgb(107, 16, 10);
        display: inline-block;
        background: linear-gradient(top, #f9f9f9, #e3e3e3);
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 700;
        font-size: 10pt;
        }
        .custom-file-input:hover::before {
        border-color: black;
        }
        .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }
        .back-button{
            margin-top: 30px;
        }
        .js-example-basic-multiple{
            width: 100%;
        }
    </style>
@endsection

@section("scripts")
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@endsection

@section("main-yield-1")
    <button class="back-button"><a href="{{ route('posts.index') }}">View all BlogPosts</a></button>
    <div id="create-post"> 
        <h1>New BlogPost</h1>
        <div class="form">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                <label for="title">BlogPost title</label>
                <input type="text" name="title" id="title">
                <label for="slug">BlogPost Url</label>
                <input type="text" name="slug" id="slug">
                <label for="image">BlogPost Image</label>
                <input type="file" name="image" id="image" class="custom-file-input" title="">
                <label for="category_id">Category name</label>
                <select id="category-select" name="category_id">
                    <option value="">Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <label for="tags">Tags</label>
                <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                    @endforeach
                </select>
                <label for="body">BlogPost description</label>
                <textarea name="body"></textarea>
                <input type="submit" name="submit" value="Create new BlogPost">
            </form>
            @if(count($errors) > 0)
                <div class="errors"> 
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><!--end errors-->
            @endif
            <script>
                    CKEDITOR.replace( 'body' );
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
            </script>
        </div><!--end form-->
    </div><!--end create post-->
@endsection