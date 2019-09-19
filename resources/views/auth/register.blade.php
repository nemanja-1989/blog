@extends("layouts.app")

@section("title")
BlogPost | Register
@endsection

@section("styles")
    <style> 
        #register{
            margin-top: 30px;
            margin-left: 400px;
        }
    </style>
@endsection

@section("main-yield-1")
    <div id="register">
        <h1>Register</h1> 
        <div class="form">
            <form action="{{ route('register') }}" method="POST"> 
                {{ csrf_field() }}
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                <label for="email">Email address</label>
                <input type="text" name="email" id="email">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <input type="submit" name="submit" value="Register">
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
    </div><!--end register-->
@endsection