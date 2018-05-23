<!DOCTYPE html>
<html>
    <head>
		@include("partials.header")
		<title>@yield('title')</title>
    </head>
    <body data-spy="scroll" data-target="#categorybar" data-offset="100">
    	<div class="wrapper">
    	 @section('navigation')
	    	<div class="blog_slogan grid">
          <div class="grid__item">
              <span class="grid__heading" style="text-align: center;">Welcome @if(isset($site_data[0][0])){{"to ".$site_data[0][0]->blog_name}}@endif</span>
          </div>
        </div>

		<div class="container-fluid">
      <div class="row">
      <nav id="categorybar" class="navbar navbar-default" data-spy="affix"  data-offset-top="100">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mycategorybar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="/">@if(isset($site_data[0][0])){!!ucfirst($site_data[0][0]->blog_name)!!}@else {{"YourBlog"}}@endif</a>
        </div>
        <div class="collapse navbar-collapse" id="mycategorybar">
          <ul class="nav navbar-nav">
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">Choose a category
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                @if(isset($site_data[1]))
                <?php $size = count($site_data[1]);?>
                @for($i = 0;$i<$size;$i++)
                <li><a href="{{URL::asset('search/'.$site_data[1][$i]->category_name)}}">
                  <i class="fa fa-{{$site_data[1][$i]->category_icon}}"></i>
                  {{ucfirst($site_data[1][$i]->category_name)}}
                </a></li>
                @endfor
                @endif
              </ul>
            </li>
          <li>
            {{Form::open(array('method'=>'post','action'=>'Show@search','class'=>'navbar-form navbar-right'))}}
            <div class="input-group">
              <input type="text" name="search" class="nav-search" placeholder="Search">
              <div class="input-group-btn">
                <button class="nav-searchBtn btn-danger" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            {{Form::close()}}
          </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if(!Auth::check())
            <li><a id="login" href="javascript:;">Login</a></li>
            <li><a id="signup" href="javascript:;">Signup</a></li>
            @else
            <li id="create"><a style="padding: 12px 15px;vertical-align: middle;" href="{{URL::asset('create')}}" title="Add a new post"><i class="fa fa-pencil-square-o" style="font-size: 26px;"></i></a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" id="username" data-toggle="dropdown" href="javascript:void(0);" title="{{Auth::user()->username}}" style="padding: 0;">
                <img src="{{isset($post_data[0]->gender) && $post_data[0]->gender=='female'?URL::asset('/images/user_profile/avatar_female.png'):URL::asset('/images/user_profile/avatar_male.png')}}" height="50px" width="50px" />
                {{Auth::user()->username}}
              </a>
                <ul class="dropdown-menu">
                  <li id="update"><a href="{{URL::asset('manage')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Manage posts</a></li>
                  <li id="update"><a href="{{URL::asset('profile/'.Auth::user()->username)}}"><i class="fa fa-user-md" aria-hidden="true"></i> Manage profile</a></li>
                  <li><a href="{{URL::asset('chat/list')}}"><i class="fa fa-commenting" aria-hidden="true"></i> Messaging</a></li>
                  <li><a id="logout" href="javascript:;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                </ul>
              </li>
            @endif
          </ul>
        </div>
      </nav>
    </div>
<script  type="text/javascript" src="{{URL::asset('js/sweetalert.min.js')}}"></script>
    @if (Session::has('msg'))
    <script type="text/javascript">
      swal({
        icon: 'success',
        text:  "{{ Session::get('msg') }}",
        buttons: false,
        timer:1200,
      });
    </script>
    @endif
          @if (Session::has('success'))
          <div class="alert alert-success">{{ Session::get('success') }}</div>
          @endif
          @if ($errors->any())
          <script type="text/javascript">
          swal({
                  icon: "error",
                  buttons: {
                    cancel: true,
                    try: {
                      text :"Try Again",
                      value: "try",
                      closeModal: false,
                    },
                  },
                  content: {
                    element: "p",
                    attributes:{
                      innerText:  "@foreach ($errors->all() as $error){{ $error }}@endforeach",
                    },
                  },
                  closeModal: true,

          })
          .then((confirm) => {
            if(confirm){
              setTimeout(function(){
                swal.close();
                  $('#loginModal').modal();
              },800);
            }
          });
        </script>
          @endif

          @yield('content')
          <div class="sidebar-right">
            <ol>
              <li>This is a fixed sidebar.</li>
              <li>This won't scroll with your browser.</li>
              <li>It only will be visible on desktop browser.</li>
              <li>Its height 80% of your browser window height.</li>
              <li>Ads or other important notices, recent posts, most visited posts also can be shown here.</li>
            </ol>
          </div>
        </div>
      </div>
    @include("partials.footer")

  @if(!Auth::check())
    @include("partials.authenticate")
  @endif
    <script type="text/javascript">
    	$(function () {
    		//show the login modal form
    		$('#login').click(function(event){
    			event.preventDefault();
    			$('#loginModal').modal();
    		});
    		//show the register modal form
    		$('#signup').click(function(event){
    			event.preventDefault();
    			$('#signupModal').modal();
    		});

    		//hide alert classes
			$('.alert-success').delay(3000).fadeOut(1000);
			$('.alert-danger').delay(3000).fadeOut(1000);
    	});
    </script>
    </body>
</html>
