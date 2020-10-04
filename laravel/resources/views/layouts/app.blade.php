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
    
  .swal2-styled.swal2-confirm{
      font-size: 10px!important;
  }
  .swal2-title {
      font-size: 1.275em!important;
  }
  .card {
    background:none!important;
  }
  .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #4e9ff0;
    background:none!important;
    border:none!important;
        padding: 0.5rem 1rem;
}
.nav-tabs .nav-link.active {
    color: #85c2ff;
    background-color: none!important;
  border:none!important;
    padding: 0.5rem 1rem!important;
    padding-top: 7%;

}
.nav-tabs .nav-link{
  border:none!important;
}
.nav-tabs .nav-link:hover{
  border:none!important;
  }
.nav-tabs {
    border-bottom: 1px solid #44505d;
}
.pt-4, .py-4 {
    padding-top: 4.5rem !important;
}
.card-title {
    margin-bottom: -0.25rem;
}
.btn-bet{
  width:48.9%;
}
.table thead th {
    color: #fff!important;
     vertical-align: bottom;
    border-bottom: 2px solid #48494b;
}
.table tr > td{
    color: #8c9186!important;
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
          <li class="nav-item">
            <a class="nav-link" href="#"  data-toggle="modal" data-target="#wallet"><i class="fa fa-users"></i> Wallet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('game.bitcoin')}}" ><i class="fa fa-users"></i> Game</a>
          </li>

          
        </ul>


      @endif
			</div>
		</div>
  		</nav>
  		<!-- Modal -->
       @if(!Auth::user())
  			@include('layouts.login')
        @include('layouts.register')
      @else
       @include('layouts.wallet')
      @endif

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
            'Successfully Logged in',
            'success'
          )
setTimeout(location.reload.bind(location), 2000);
          }

        },
        error: function (e) {

        }
      });

  }));



    $("#user-deposit").on('submit', (function (e) {
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
            'Successfully sent',
            'success'
          )
          setTimeout(location.reload.bind(location), 2000);
          }

        },
        error: function (e) {

        }
      });

  }));
    $("#user-deposit").on('submit', (function (e) {
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
            'Successfully sent',
            'success'
          )
          }

        },
        error: function (e) {

        }
      });

  }));
     $("#user-withdraw").on('submit', (function (e) {
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
            'Successfully sent',
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
