@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>BITMEX</h3>
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
          <div class="col-6">
            <div class="card" style="min-height:500px;">
              <div class="card-header">
                <h5 class="card-title">Betting Cart             <p id="btcValueOld" style="float:right;"></p></h5>

              
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;overflow-x: hidden;">
              <button class="btn btn-primary btn-sm btn-bet" onClick="startTimer('60',0)">Start</button>
              <button class="btn btn-danger btn-sm btn-bet">Stop</button>
                      <div class="row">

              <div class="col-6">
              <h5 style="text-align:right;padding-top:5%;">Minutes</h5>
              </div>
              <div class="col-4">
              <select class="form-control minute_value" >
             	 <option>1</option>
             	 <option>2</option>
             	 <option>3</option>
             	 <option>4</option>
              </select>
              </div>
              </div>
              <table class="table">
              	<thead>
	              	<tr>
	            	  	<th style="width: 1%;text-align:center">Rounds</th>
	            	  	<th style="width:36%;text-align:center">Amount</th>
	            	  	<th style="text-align:center">Up</th>
	            	  	<th style="text-align:center">Down</th>
	            	  	<th>Start Value</th>
	            	  	<th>Time/Status</th>
	              	</tr>
              	</thead>
              	<tbody>
              	  @for($i=1;$i<13;$i++)
              	 <tr>
              		 <td>{{$i}}</td>
              		 <td><input type="text" class="form-control betAmount" style="text-align:right;color:#fff;"></td>
              		 <td style="text-align:center"><input type="radio" name="test_{{$i}}"></td>
              		 <td style="text-align:center"><input type="radio" name="test_{{$i}}"></td>
              		 <td><p class="oldValue"></p></td>
              		 <td><div class="time">00:00</div></td>
              	 </tr>
              	 @endfor

              	</tbody>
              </table>
               
              </div>
              
            </div>


            <!-- /.card -->
          </div>
              <div class="col-6">
            <p id="btcValue" style="display:none;"></p>
            <iframe src="https://bitlive.co.kr/?m=game&m2=binance&m3=i
    " width="550" height="410" scrolling="no" frameborder="0"></iframe>

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
        document.getElementById('btcValueOld').innerHTML = `$${oldValue}`
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
    if($('.betAmount').eq(display).val() != ''){
    	$('.oldValue').eq(display).text($('#btcValueOld').text());

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
	        	$('.time').eq(display).text($('#btcValueOld').text());
	        	var next = parseInt(display) + 1;
	        	startTimer(60,next);
	        }
	    }, 1000);
	}
	    if($('.betAmount').eq(0).val() == ''){
	    	alert("please place a bet");
	    }


}

// jQuery(function ($) {
//     var fiveMinutes = 60 * 1,
//         display = $('#time');
//     startTimer(fiveMinutes, display);
// });
</script>
@endsection
		