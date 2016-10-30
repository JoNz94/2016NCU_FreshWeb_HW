<!DOCTYPE html>
<html>
<head>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">  
    <!-- 上面這行與 AJAX 有關 -->
    <!-- 以下是 remodal -->
    <link rel="stylesheet" href="{{ asset('css/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/remodal-default-theme.css')}}">
    <script src="{{ asset('js/remodal.js') }}"></script>
    <!-- 以下是 selection -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cs-select.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cs-skin-border.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cs-skin-overlay.css')}}" />
    

</head>
<body>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ action('Homepage@index')}}">Bear Test</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a href="{{ action('MessageBoardController@index')}}">MessageBoard</a></li>
        <li><a href="/Work">Work</a></li>

      @if (Auth::user() === null)
        <li><a href="{{ action('Auth\AuthController@getLogin')}}">Login</a></li>
      @endif
      @if (Auth::user() != null)
        <li><a href="{{ action('Auth\AuthController@getLogout')}}">Logout</a></li>
      @endif
      
   
      </ul>
    </div>
  </div>
</nav>
 		<div class="container">
 			@yield('content')
 		</div>
</body>
</html>