<!Doctype html>
<html>
<head>
	<title>
	@yield('title')
	</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:75%;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
</head>
<body>
  <div class="container">
<h3>
<a href="/">Home</a>
</h3>
</div>
	@yield('content')
<!-- // ... Loading jQuery from CDN
// ... Some other global JavaScript -->
@yield('scripts')
</body>
</html>