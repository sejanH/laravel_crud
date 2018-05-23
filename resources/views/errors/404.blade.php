<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
@include('errors.header')
</head>
<body>
	<nav id="categorybar" class="navbar navbar-default" data-spy="affix"  data-offset-top="100">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mycategorybar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>

          <a class="navbar-brand" href="/">Go back to home page</a>
        </div>
        <div class="collapse navbar-collapse" id="mycategorybar">
          <ul class="nav navbar-nav">
          <li>
            <p class="navbar-text">This is a dead end</p>
          </li>
          </ul>
        </div>
      </nav>
	<center style="position: relative;top:10%;">
		<div class="jumbotron alert alert-custom">
			<h2>The document you are looking for is not here.</h2>
			<a href="{{URL::previous()}}" class="btn btn-custom">&laquo; Go back</a>
		</div>
	</center>
</body>
</html>