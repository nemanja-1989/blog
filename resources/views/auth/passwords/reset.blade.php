@extends("layouts.app")

@section("title")
BlogPost | Reset password 
@endsection

@section("styles")
    <style>
        #reset-password{
            margin-top: 30px;
            margin-left: 400px;
        }
    </style>
@endsection

@section("main-yield-1")
    <div id="reset-password">
        <div class="form"> 
            <form action="{{ route('password.reset') }}" method="POST"> 
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <label for="email">Email address</label>
                <input type="text" name="email" id="email">
                <label for="password">New password</label>
                <input type="password" name="password" id="password">
                <label for="password_confirmation">Confirm new password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <input type="submit" name="submit" value="Reset password">
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
    </div><!--end reset link-->
@endsection