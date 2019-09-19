@extends("layouts.app")

@section("title")
BlogPost | Edit BlogPost
@endsection

@section("styles")
    <style> 
        .back-button{
            margin-top: 30px;
        }
        #edit-blogpost{
            margin-left: 300px;
        }
        .form form{
            width: 600px;
        }
        form input[type="file"]{
            border: none;
            color: transparent;
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
        #submit-edit{
        width: 49%;
        background: rgba(61, 151, 224);
        color: #fff; 
        float: left;
        }
        #submit-delete{
            width: 49%;
            background: rgb(250, 36, 36);
            color: #fff; 
            float: right;
        }
        .category-select{
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
    @if(Session::has("Success"))
        <div class="session"> 
            <strong>{{ Session::get("Success") }}</strong>
        </div><!--end session-->
    @endif
    <button class="back-button"><a href="{{ route('posts.index') }}">View all BlogPosts</a></button>
    <div id="edit-blogpost"> 
        <div class="form">
            <h1>Edit BlogPost</h1>
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <label for="title">BlogPost title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}">
                <label for="slug">Url address</label>
                <input type="text" name="slug" id="slug" value="{{ $post->slug }}">
                <label for="image">BlogPost Image</label>
                <input type="file" name="image" id="image" class="custom-file-input">
                <label for="category_id">Category name</label>
                <select class="category-select" name="category_id"> 
                    <option value="{{ $post->category->id }}">{{ $post->category->category_name }}</option>
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
                <textarea name="body">{{ $post->body }}</textarea>
                <input id="submit-edit" type="submit" name="submit" value="Edit BlogPost">
            </form>
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"> 
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input id="submit-delete" type="submit" name="submit" value="Delete BlogPost">
            </form>
            <div class="clear"></div>
        </div><!--end form-->
        @if(count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <script>
                CKEDITOR.replace( 'body' );
                $(document).ready(function() {
                    $('.js-example-basic-multiple').select2();
                });
        </script>
    </div><!--end blogpost-->
@endsection