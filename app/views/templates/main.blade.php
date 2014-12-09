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
    <div class="contain-to-grid fixed">
        <nav class="top-bar" data-topbar role="navigation">
            <ul class="title-area">
                <li class="name">
                  <h1><a href="{{ URL::to('/') }}">Dude, check out my new blog</a></h1>
                </li>
                <li class="divider"></li>
            </ul>
            
            <section class="top-bar-section">
                <ul class="left">
                    <li class="divider"></li>
                    <li><a href="{{ URL::to('/') }}">Home</a></li>
                    <li><a href="{{ URL::to('feed') }}">RSS</a></li>
                    @if ( !Auth::guest() )
                        <li><a href="{{ URL::to('admin') }}">Create Post</a></li>
                    @endif
                </ul>
                
                <ul class="right">
                    @if ( Auth::guest() )
                        <li class="has-form">
                            <a href="{{ URL::to('login') }}" class="button">Login</a>
                        </li>
                        <li class="has-form">
                            <a href="{{ URL::to('signup') }}" class="button secondary ">Sign Up</a>
                        </li>
                    @else
                        <li class="name">
                            <h1 class="welcome">Welcome, </h1>
                        </li>
                        <li class="name">
                            <?php $username = Auth::user()->username; ?>
                            <h1>{{ HTML::link('author/'.$username, $username) }}</h1>
                        </li>
                        <li class="divider"></li>
                        <li class="has-form"><a href="{{ URL::to('logout') }}" class="button">Logout</a></li>
                    @endif
                </ul>
            </section>
            
        </nav><!-/.navbar-inner->
    </div><!-/.navbar-fixed-top->
    
    <div class="row">
        <div class="row">
            @yield('content')
        </div>
        @yield('pagination')
    </div><!-/.container->
    <hr />
    <div class="row">
        <footer class="columns large-12 large-centered">
            <!--div class="small-centered columns small-6"-->
                <div class="large-2 columns name">Joel Rainwater</div>
                <div class="large-10 columns" style="border-left: 1px solid #ccc"> &copy; {{ date("Y") }}</div>
            <!--/div-->
        </footer>
    </div><!-/.container->
    
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/foundation/js/foundation.min.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>