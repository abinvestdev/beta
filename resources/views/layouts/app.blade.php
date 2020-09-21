<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body{background: rgb(25, 44, 56);    font-family: proxima-nova, sans-serif;color: rgba(255, 255, 255, 0.5);  }
     .navbar-dark{ background:rgb(7, 29, 42); }
     .modal-content{background: rgb(26, 44, 56);}
     .modal-header{ border-bottom:0!important; color: rgb(177, 186, 211);}
     input{    background: rgb(15, 33, 46)!important;    box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 3px 0px, rgba(0, 0, 0, 0.12) 0px 1px 2px 0px;
    border: 2px solid rgb(47, 69, 83)!important;}
    .btn-primary{background: rgb(47, 69, 83)!important; box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 3px 0px, rgba(0, 0, 0, 0.12) 0px 1px 2px 0px;
    border: 2px solid rgb(47, 69, 83)!important;}
    .custom-control-label::before {background: rgb(47, 69, 83)!important; box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 3px 0px, rgba(0, 0, 0, 0.12) 0px 1px 2px 0px;
    border: 2px solid rgb(47, 69, 83)!important;}
    .navbar-dark::after {
    content: "";
    background: #1b1b1b;
    position: absolute;
    bottom: 60px;
    top: 60px;
    left: 0;
    right: 0;
    transform: skewY(-3deg);
  }
  .swal2-styled.swal2-confirm{
      font-size: 10px!important;
  }
  .swal2-title {
      font-size: 1.275em!important;
  }

    </style>
</head>
<body>
    <div id="app">
      <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">AB INVEST</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
      @if(!Auth::user())
  			<ul class="navbar-nav ml-auto">
  			  <li class="nav-item">
  			    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalCenter2">Sign Up</a>
  			  </li>
  			  <li class="nav-item">
  			    <a class="nav-link" href="#"  data-toggle="modal" data-target="#exampleModalCenter">Log In</a>
  			  </li>
  			</ul>
      @else
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                </a>
          </li>
          
        </ul>


      @endif
			</div>
		</div>
  		</nav>
  		<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form method="POST" action="{{ route('login') }}" class="user" id="UserLogin">
                  @csrf
                       <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="form-group" style="position:relative;">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label" for="customCheck" style="padding-top: 1%;">Remember Me</label>
                    </div>
<!--                     <a href="#" class="register-link">Not a member yet?</a>
 -->                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
              <!--     <hr>
                  <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Login with Google
                  </a>
                  <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                  </a> -->
                </form>			      </div>
			    </div>
			  </div>
			</div>
			<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form method="POST" action="{{ url('api/join') }}" class="user" id="registerUser">
                  @csrf
                  <div class="form-group">
                    <input type="text" name="name" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Full Name">
                  </div>
                   <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Repeat Password">
                  </div>
               
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Register 
                  </button>
              <!--     <hr>
                  <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Login with Google
                  </a>
                  <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                  </a> -->
                </form>			      </div>
			    </div>
			  </div>
			</div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
<script>
    
$(document).ready(function (e) {
 
  $(".register-link").on('click', (function (e) {
    $('.register-area').show();
  }));
    $("#registerUser").on('submit', (function (e) {
      e.preventDefault();

    checkData  = new FormData(this);
    thisAction = $(this).attr("action");

     $.ajax({
       
        url: thisAction,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {

        },

        success: function (data) {
          
          obj = JSON.parse(data);
          if(obj['status'] == 'failed'){
            Swal.fire({
            type: 'error',
            title: obj.mesg,   
          });

          }
          if(obj['status'] == 'success'){
            $('input').val('');
            Swal.fire(
            obj.mesg,
            'You may now login',
            'success'
          )

          }

        },
        error: function (e) {

        }
      });

  }));
});
$(document).ready(function (e) {
 

    $("#UserLogin").on('submit', (function (e) {
      e.preventDefault();

    checkData  = new FormData(this);
    thisAction = $(this).attr("action");

     $.ajax({
       
        url: thisAction,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {

        },

        success: function (data) {
          
          obj = JSON.parse(data);
          if(obj['status'] == 'failed'){
            Swal.fire({
            type: 'error',
            title: obj.mesg,   
          });

          }
          if(obj['status'] == 'success'){
            $('input').val('');
            Swal.fire(
            obj.mesg,
            'You may now login',
            'success'
          )

          }

        },
        error: function (e) {

        }
      });

  }));
});
  </script>
</html>
