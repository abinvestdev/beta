@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>FX GAME</h3>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-5">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Betting Cart</h5>

              
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
              <button class="btn btn-primary btn-sm btn-bet">Start</button>
              <button class="btn btn-danger btn-sm btn-bet">Stop</button>
              <table class="table">
              	<thead>
	              	<tr>
	            	  	<th style="width: 1%;text-align:center">Rounds</th>
	            	  	<th style="width:36%;text-align:center">Amount</th>
	            	  	<th style="text-align:center">Buy</th>
	            	  	<th style="text-align:center">Sell</th>
	              	</tr>
              	</thead>
              	<tbody>
              	  @for($i=1;$i<13;$i++)
              	 <tr>
              		 <td>{{$i}}</td>
              		 <td><input type="text" class="form-control" style="text-align:right;color:#fff;"></td>
              		 <td style="text-align:center"><input type="radio" name="test_{{$i}}"></td>
              		 <td style="text-align:center"><input type="radio" name="test_{{$i}}"></td>
              	 </tr>
              	 @endfor

              	</tbody>
              </table>
               
              </div>
              
            </div>

            <!-- /.card -->
          </div>
        </div>
        </div>
        </section>
        </div>
@endsection
		