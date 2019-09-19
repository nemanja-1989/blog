@extends("layouts.app")

@section("title")
BlogPost | Login
@endsection

@section("styles")
    <style>
        #login{
            margin-top: 30px;
            margin-left: 400px;
        }
        #login form p a{
            text-decoration: none;
            color: rgba(107, 16, 10);
        }
    </style>
@endsection

@section("main-yield-1")
    <div id="login"> 
        <div class="form"> 
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <label for="email">Email address</label>
                <input type="text" name="email" id="email">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <input type="submit" name="submit" value="Login">
                <p><a href="{{ route('password.request') }}">Forgot your password?</a></p>
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
    </div><!--end login-->
@endsection