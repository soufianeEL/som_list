<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- main stylesheet -->
    <link href="{{ asset('/css/main.min.css') }}" rel="stylesheet" media="screen" id="mainCss">
    <!-- elusive icons -->
    <link href="{{ asset('/icons/elusive/css/elusive-webfont.css') }}" rel="stylesheet" media="screen">
    <!-- elegant icons -->
    <link href="{{ asset('/icons/elegant/style.css') }}" rel="stylesheet" media="screen">
    <!-- scrollbar -->
    <link rel="stylesheet" href="{{ asset('/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    @yield('head')
	<!-- Fonts -->
	<link href='{{ asset('/fonts/googleapis.css') }}' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="side_menu_active side_menu_expanded">
    <div id="page_wrapper">
        <!-- header -->
        <header id="main_header">
            @include('_main_header')
        </header>
        <!-- breadcrumbs -->
        <nav id="breadcrumbs">
            <ul>
                <li><a href="dashboard.html">Home</a></li>
            </ul>
        </nav>
        <!-- main content -->
        <div id="main_wrapper">

            @if (Session::has('message'))
                <div class="flash alert-info">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p>{{ Session::get('message') }}</p>
                </div>
                <script type="text/javascript">
                    $('.close').click(function(){
                        $('.flash').hide(500);
                    });
                </script>
            @endif
            @if ($errors->any())
                <div class='flash alert-danger alert-dismissible'>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach ( $errors->all() as $error )
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                <script type="text/javascript">
                    $('.close').click(function(){
                        $('.flash').hide(500);
                    });
                </script>
            @endif

            @yield('content')

        </div>

        <!-- main menu -->
        @include('_main_menu')
    </div>

    <!-- fastclick -->
    <script src="{{ asset('/js/fastclick.min.js') }}"></script>

    <!-- typeahead -->
    <script src="{{ asset('/lib/typeahead/typeahead.bundle.min.js') }}"></script>
    <!-- scrollbar -->
    <script src="{{ asset('/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- Yukon Admin functions -->
    <script src="{{ asset('/js/yukon_all.min.js') }}"></script>
    @yield('js')
</body>
</html>
