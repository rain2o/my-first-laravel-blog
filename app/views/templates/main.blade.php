<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="My first attempt at a Laravel blog" />
    <meta name="author" content="Joel Rainwater" />
    <title>Dude, check out my new blog</title>
    <link rel="stylesheet" href="/assets/css/app.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <script src="/assets/vendor/modernizr/modernizr.js"></script>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <a class="brand" href="{{ URL::base() }}">Blog</a>
                
                <div class="btn-group pull-right">
                    @if ( Auth::guest() )
                        <a class="btn" href="{{ URL::to('login') }}">
                            <i class="icon-user"></i> Login
                        </a>
                    @else
                        Welcome, <strong>{{ HTML::link('admin', Auth::user()->username) }} </strong> 
                        | {{HTML::link('logout', 'Logout') }}
                    @endif
                </div><!-/.btn-group pull-right->
                
                <div class="nav-collapse">
                    <ul class="nav">
                        <li><a href="{{ URL::base() }}">Home</a></li>
                        @if ( !Auth::guest() )
                            <li><a href="{{ URL::to('admin') }}">Create New</a></li>
                        @endif
                    </ul>
                </div><!-/.nav-collapse->
                
            </div><!-/.container-fluid->
        </div><!-/.navbar-inner->
    </div><!-/.navbar-fixed-top->
    
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
        @yield('pagination')
    </div><!-/.container->
    
    <div class="container">
        <footer>
            <p>My Blog &copy; 2014</p>
        </footer>
    </div><!-/.container->
</body>
</html>