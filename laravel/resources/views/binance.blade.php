@extends('layouts.app')
<style>

  .minus{
    color:red!important;
  }
  .add{
    color:green;
  }
  .table th, .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 0!important;
}
.btn-sm, .btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
    font-size: 1.2rem!important;
    line-height: 1.5;
    border-radius: 0.2rem;
}

</style>
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>BINANCE </h3>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
 </div>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-6" >
            <div class="card" style="min-height:500px;">
            <form action="{{route('user.cart')}}" method="POST" id="addCart">
            @csrf
              <!-- <div class="card-header">
                <h5 class="card-title">Betting Cart             <p id="btcValue" style="float:right;display:none;"></p></h5>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body  p-0" style="background:rgb(33, 55, 67)">
              <div class="row">
              <div class="col-12" style="padding-right:1%;">
                <button type="submit" class="btn btn-primary btn-sm btn-bet" onClick="startTimer('60',0)">Start</button>
                <button type="button" class="btn btn-danger btn-sm btn-bet">Stop</button>
                </div>
                </div>
              <div class="row">
                <div class="col-6">
                <h5 style="text-align:right;padding-top:5%;">Minutes</h5>
              </div>
              <div class="col-4">
              <select class="form-control minute_value" >
             	 <option>1</option>
             	 <option>2</option>
             	 <option>4</option>
             	 <option>5</option>
             	 <option>10</option>
              </select>
              </div>
              </div>
              <div class="table-responsive" style="max-height:400px;">
              <table class="table ">
              	<thead>
	              	<tr>
	            	  	<th style="width: 1%;text-align:center">Rounds</th>
	            	  	<th style="width:36%;text-align:center">Amount</th>
	            	  	<th style="text-align:center"><i class="fa fa-arrow-up" style="color:blue"></i></th>
	            	  	<th style="text-align:center"><i class="fa fa-arrow-down" style="color:red"></i></th>
	            	  	<th>Start Value</th>
	            	  	<th>Time/Status</th>
	              	</tr>
              	</thead>
              	<tbody>
              	  @for($i=1;$i<13;$i++)
              	 <tr>
              		 <td>{{$i}}</td>
              		 <td><input name="round_bet[]" type="text" class="form-control betAmount" style="text-align:right;color:#fff;"></td>
              		 <td style="text-align:center"><input type="radio" name="bet_{{$i}}" class="bet_val" value="up" checked></td>
              		 <td style="text-align:center"><input type="radio" name="bet_{{$i}}" class="bet_val" value="down"></td>
              		 <td><p class="oldValue"></p><input type="hidden" name="starting_amount[]" class="start_amnt"></td>
              		 <td><div class="time">00:00</div></td>
              	 </tr>
              	 @endfor

              	</tbody>
              </table>
              </div>
               
              </div>
              </form>
            </div>


            <!-- /.card -->
          </div>
          <div class="col-6">
            <div style="background:#000;padding:2%"><img src="{{asset('image/renew_binance_logo.png')}}"></div>

            <div style="background:#fff;color:#000;text-align:center;=">
            <p style="margin-bottom: 2px; height: 52px; font-family: 'Lato'; font-size: 44px; font-weight: 800; text-align: center; color:#000;" id="btcValue"></p>
            </p>
            <div style="width:100%;max-height:200px;overflow:hidden;position:relative;top:20%">
            <iframe src="https://bitlive.co.kr/?m=game&m2=binance&m3=i
            " width="550" height="410" scrolling="no" frameborder="0" style="position:relative;top:-203px"></iframe>
            </div>
          </div>
        </div>
        </div>
        </section>
        </div>
<script>
    let oldValue;
    let socket = new WebSocket("ws://193.108.118.125:3003")
    socket.onopen = function (evt) {
        socket.send(JSON.stringify({ 'origin': window.location.hostname, 'source': 'binance' }))
    }

    socket.onmessage = function (evt) {
        let obj = JSON.parse(evt.data);
        let classTxt = obj.indicator == '-' ? 'minus' : 'add';
        document.getElementById('btcValue').innerHTML = `$${obj.value}`
        // document.getElementById('btcValueOld').innerHTML = `$${obj.oldValue}`
        oldValue = obj.value;
        document.getElementById('btcValue').classList.remove((classTxt == 'add' ? 'minus' : 'add'))
        document.getElementById('btcValue').classList.add(classTxt)

        socket.send(JSON.stringify({
            'continues': true
        }))
    }

    socket.onerror = function (e) {
        console.log(e)
    }
    
    function disconnect() {
        socket.send(JSON.stringify({disconnect: '!DISCONNECT'}));
    }
    function startTimer(duration,display) {
    var duration = parseInt(duration) * $('.minute_value').val();
    var timer = duration, minutes, seconds;
    var currentBalance = $('#my-wallet').find('b').text();
    if($('.betAmount').eq(display).val() != '' && $('.betAmount').eq(display).val() != 0){
    	$('.oldValue').eq(display).text($('#btcValue').text());
    	$('.start_amnt').eq(display).val($('#btcValue').text());

	    var countDown = setInterval(function startCount() {
	        minutes = parseInt(timer / 60, 10);
	        seconds = parseInt(timer % 60, 10);

	        minutes = minutes < 10 ? "0" + minutes : minutes;
	        seconds = seconds < 10 ? "0" + seconds : seconds;

	        $('.time').eq(display).text(minutes + ":" + seconds);

	        if (--timer < 0) {
	            timer = duration;
	        }
	        if(minutes == 0 && seconds == 0){
	        	clearInterval(countDown);
	        	$('.time').eq(display).text($('#btcValue').text());
	        	var next = parseInt(display) + 1;
	        	startTimer(60,next);
	        }
	    }, 1000);
	}
	    if($('.betAmount').eq(0).val() == ''){
	    	alert("please place a bet");
	    }
}
$(document).ready(function (e) {
 $(".betAmount").on('keyup', (function (e) {
   let index = $(this).index(".betAmount");
   let myBalance = $('#my-wallet').find('b').text();
      checkBal = parseFloat(myBalance) - parseFloat($(this).val());
      if(checkBal <= 0){
        alert("no balance");
        $('.betAmount').eq(i).val(myBalance);
      }else{
        // $('#my-wallet').find('b').text(checkBal);
      }
      let betamnt = parseFloat($(this).val());
      for(i=index+1;i < $('.betAmount').length;i++){
          betamnt = betamnt * 2;
          myBalance = parseFloat(myBalance) - parseFloat(betamnt);
          if(myBalance >= 0){

          $('.betAmount').eq(i).val(betamnt.toFixed(8));
        }else{
          $('.betAmount').eq(i).val(0.00000000);

        }
      }
 }));
});
$(document).ready(function (e) {
 $("#addCart").on('submit', (function (e) {
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
    

    },
    error: function (e) {

    }
  });

 }));
});
// jQuery(function ($) {
//     var fiveMinutes = 60 * 1,
//         display = $('#time');
//     startTimer(fiveMinutes, display);
// });
</script>
@endsection
		