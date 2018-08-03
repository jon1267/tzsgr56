<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('blog/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('blog/css/blog-home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jon_style.css') }}" rel="stylesheet" >

</head>

<body>

<!-- Navigation -->
@yield('navigation')

<!-- Page Content -->
<div class="container">
    @yield('content')
</div>
<!-- /.container -->

<!-- Footer -->
@yield('footer')


<!-- Bootstrap core JavaScript -->
<script src="{{ asset('blog/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('blog/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('js/jon_scripts.js')}}"></script>

</body>

</html>