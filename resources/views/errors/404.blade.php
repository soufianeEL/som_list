<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error 404</title>
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- bootstrap framework -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href='{{ asset('/fonts/googleapis.css') }}' rel='stylesheet' type='text/css'>
    <!-- main stylesheet -->
    <link href="{{ asset('/css/main.min.css') }}" rel="stylesheet" media="screen" id="mainCss">

</head>

    <body class="error_page">

        <div id="error_wrapper">
            <div id="error_wrapper_inner">
                <h1 class="error_heading">Error 404</h1>
                <h2 class="error_subheading">The requested URL <span>url_link</span> was not found on this server.</h2>
                <p><a href="/">Go Back</a></p>
            </div>
        </div>
    </body>

</html>