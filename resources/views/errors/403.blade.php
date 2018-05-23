<!DOCTYPE html>
<html>
<head>
	<title>403 Permission Denied</title>
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

		<div class="container-fluid jumbotron alert alert-custom" style="position: relative;top:10%;">
			<div class="row col-sm-3"></div>
			<div class="row col-sm-6">
			<h2>You are not allowed to edit this post.</h2>
			<ul>Reasons:
				<li>You are not the author of this post</li>
				<li>If you're the author; You aren't logged in</li>
				<li>You are not the Admin</li>
			</ul><hr>
			<a href="{{url('/')}}" class="btn btn-default">&laquo; Go back to homepage</a>
		</div>
		</div>

</body>
</html>