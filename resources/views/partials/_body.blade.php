<div id="nav">
    <div class="container">
        <div id="flex-nav">
            <div id="logo"> 
                <h1>BlogPost</h1>
            </div><!--end logo-->
            <div id="navbar">
                <ul> 
                    <li><a href="{{ route('pages.index') }}">BlogPost</a></li>
                </ul>
            </div><!--end navbar-->
            @if(Auth::check())
            <div id="my-account">
                <ul> 
                    <li><a href="">{{ Auth::user()->name }}</a>
                        <ul>
                            <li><a href="{{ route('posts.index') }}">Posts</a></li>
                            <li><a href="{{ route('category.index') }}">Categories</a></li>
                            <li><a href="{{ route('tags.index') }}">Tags</a></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--end my-account-->
            @else 
            <div id="my-account">
                    <ul> 
                        <li><a href="">Account</a>
                            <ul>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--end my-account-->
            @endif
        </div><!--end flex-nav-->
    </div><!--end container-->
</div><!--end nav-->
<div id="wrapper">
    <div id="main"> 
        <div id="main-yied-1"> 
            @yield("main-yield-1")
        </div><!--end main yied 1-->
    </div><!--end main-->
</div><!--end wrapper-->
    <div id="footer">
        <div class="container">
            <div id="copyright"> 
                <small>BlogPost &copy; production 2019</small>
            </div><!--copyright-->
        </div><!--end container-->
    </div><!--end footer-->
