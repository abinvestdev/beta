<div class="modal fade" id="wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Wallet Transaction</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
            <div class="modal-body" style="padding:0!important;">
           
              <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Deposit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Withdrawal</a>
                  </li>
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                   <form method="POST" action="{{ route('user.deposit') }}" class="user" id="user-deposit">
                   @csrf
                  <div class="form-group">
                    <input type="text" name="deposit_amount" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Amount Deposit">
                  </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                      Send
                    </button>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                   <form method="POST" action="{{ route('user.withdraw') }}" class="user" id="user-withdraw">
                   @csrf
                  <div class="form-group">
                    <input type="text" name="withdrawal_amount" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Withdrawal Amount">
                  </div>
                     <button type="submit" class="btn btn-primary btn-user btn-block">
                      Submit
                    </button>
                    </form>
                  </div>
                
                </div>
              </div>
              <!-- /.card -->
            </div>
            </div>
			    </div>
			  </div>
			</div>