<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<head>
  <title>Chat @if(isset($to)){{':'.$to}}@endif</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
  <meta name="description" content="A micro-blogging system built with love and laravel">
  <meta name="robots" content="index, nofollow">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bulma.css')}}">
  <link rel="icon" type="image/x-icon" href="{{URL::asset('favicon.ico')}}">
  <style type="text/css">
    section > div.msgLists{
      position: fixed;
      overflow: auto;
      top: 60px;
      bottom: 0;
      left: 0;
      border-right:1px solid grey;
    }
    li.messageBox{
      height: 64px;
      max-height: 64px;
      display: block;
      background-color: ivory;
      padding: 10px 5px;
    }
    li.messageBox:hover,
    li.messageBox:focus{
      cursor: pointer;
      background-color: rgba(0,0,0,0.05);
    }
  </style>
  <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
</head>
<body>
  <div class="wrapper">
    @section('navigation')
    <nav class="navbar is-custom is-fixed-top">
      <div class="navbar-brand">
        <a class="navbar-item" href="/">@if(isset($site_data[0][0])){!!ucfirst($site_data[0][0]->blog_name)!!}@else {{"YourBlog"}}@endif</a>
        <div class="navbar-burger burger" data-target="navbarBurger" style="margin-right: 10px;">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div id="navbarBurger" class="navbar-menu">
        <div class="navbar-start">
        
        </div>
@if(Auth::check())
        <div class="navbar-end">
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="javascript:void(0);">
                {{Auth::user()->username}}
              </a>
            <div class="navbar-dropdown is-right is-boxed">
              <a class="navbar-item" href="/documentation/overview/start/">
                Overview
              </a>
              <a class="navbar-item" href="https://bulma.io/documentation/modifiers/syntax/">
                Modifiers
              </a>
              <a class="navbar-item" href="https://bulma.io/documentation/columns/basics/">
                Columns
              </a>
              <a class="navbar-item" href="https://bulma.io/documentation/layout/container/">
                Layout
              </a>
              <a class="navbar-item" href="https://bulma.io/documentation/form/general/">
                Form
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item" href="https://bulma.io/documentation/elements/box/">
                Elements
              </a>
              <a class="navbar-item" id="logout" href="javascript:;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </div>
          </div>
      </div>
@endif
</div>
    </nav>
@yield('content')

</div>
@section('footer')
<footer class="footer">
  <div class="container">
    <div class="content has-text-centered">
      <p>
        &copy; S.M.Mominul Haque Sejan 2015-{{date('Y')}}
      </p>
    </div>
  </div>
</footer>
<script  type="text/javascript" src="{{URL::asset('js/sweetalert.min.js')}}"></script>
<script type="text/javascript">
$("#logout").click(function(){
  swal({
    title: "Are you sure?",
    text: "You want to logout!",
    icon: "warning",
    buttons: {
      cancel: true,
      confirm: {
        text: "Logout",
        closeModal: false,
      },
    },
  })
  .then((confirm) => {
    if (confirm) {
      setTimeout(function(){window.location.href="{{url('/')}}/Auth/logout"},1600);
    } else {
      swal("Logout","Cancelled","error",{
        buttons: false,
        timer:800,
      });
    }
  });
});


  document.addEventListener('DOMContentLoaded', function () {
  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {
        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);
        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }
});
  </script>
</body>
</html>