@extends("layouts.app")

@section("title")
BlogPost | Reset password link
@endsection

@section("styles")
    <style>
        #reset-link{
            margin-top: 30px;
            margin-left: 400px;
        }
    </style>
@endsection

@section("main-yield-1")
    <div id="reset-link">
        <div class="form"> 
            <form action="{{ route('password.email') }}" method="POST"> 
                {{ csrf_field() }}
                <label for="email">Email address</label>
                <input type="text" name="email" id="email">
                <input type="submit" name="submit" value="Send Reset link">
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