<!DOCTYPE html>
<html>
<head>
    <!-- <title>@yield('title')</title> -->
  <title>@yield('title')</title>
  <meta charset="UTF-8" />

  <!-- use CSS,CSS file under public/css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" /> 

</head>

<body>
    <div class="nav" id="navbar">
        <ul class="item">
            <li>
                <a href={{url("/")}}>
                    HOME
                </a>
            </li>
            <li>
                <a href="{{url("allPost")}}">
                    All post
                </a>
            </li>
            <li>
                <a href={{url("/allauthors")}}>
                    Authors
                </a>
            </li>
            @if((!empty(session()->get('userName'))))
                <li>
                    <a href="{{url("/Logout")}}">
                    Log Out
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="container">
        <!-- NAV -->
      <div class="top" id="topbar">
          @yield('topbar')
        
        @if(session()->exists('userName'))
            <div class="top" id="welcome">
                Welcome Back  {{session()->get('userName')}}  !
            </div>
        @endif
      </div>

      <div class="bodypart" id="content">
        @yield('content')
    </div>
    </div>
</body>
</html>