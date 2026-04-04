@include('dashboard.header')
<div class="main-panel bg-dark">
	<div class="content bg-dark">
		<div class="page-inner">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif

			@if(session('error'))
			<div class="alert alert-danger" role="alert">
				{{ session('error') }}
			</div>
			@endif

			@if($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{$message}}</p>
			</div>
			@endif

			<div class="mt-2 mb-4">
				<h1 class="title1 text-light">Request for Withdrawal</h1>
			</div>

			<div class="mb-5 row">
				<!-- BANK WITHDRAWAL (NEW) -->
				<div class="col-lg-4">
					<div class="p-3 rounded card bg-dark">
						<div class="card-body border-danger">
							<h2 class="card-title mb-3 text-light"> Bank</h2>

							<h4 class="text-light">Minimum amount: <strong style="float:right;"> $100</strong></h4><br>
							<h4 class="text-light">Maximum amount:<strong style="float:right;"> $100000</strong></h4><br>
							<h4 class="text-light">Charge Type:<strong style="float:right;">fixed</strong></h4><br>

							<h4 class="text-light">Charges Amount:
								<strong style="float:right;"> $0 </strong>
							</h4><br>

							<h4 class="text-light">Duration:<strong style="float:right;"> 1 - 24 Hours</strong></h4><br>

							<div class="text-center">
								<form action="{{route('user.withdraw')}}" method="post">
									@csrf
									<div class="form-group">
										<input type="hidden" value="Bank" name="method">
										<button class="btn btn-primary" type='submit'>
											<i class="fa fa-plus"></i> Request withdrawal
										</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>

				<!-- BNB -->
				<div class="col-lg-4">
					<div class="p-3 rounded card bg-dark">
						<div class="card-body border-danger">
							<h2 class="card-title mb-3 text-light"> BNB</h2>
							<h4 class="text-light">Minimum amount: <strong style="float:right;"> $2500</strong></h4><br>
							<h4 class="text-light">Maximum amount:<strong style="float:right;"> $100000</strong></h4><br>
							<h4 class="text-light">Charge Type:<strong style="float:right;">percentage</strong></h4><br>
							<h4 class="text-light">Charges Amount:
								<strong style="float:right;"> 0% </strong>
							</h4><br>
							<h4 class="text-light">Duration:<strong style="float:right;"> Instant</strong></h4><br>

							<div class="text-center">
								<form action="{{route('user.withdraw')}}" method="post">
									@csrf
									<div class="form-group">
										<input type="hidden" value="BNB" name="method">
										<button class="btn btn-primary" type='submit'><i class="fa fa-plus"></i> Request
											withdrawal</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>

				<!-- DOGE -->
				<div class="col-lg-4">
					<div class="p-3 rounded card bg-dark">
						<div class="card-body border-danger">
							<h2 class="card-title mb-3 text-light"> Doge</h2>
							<h4 class="text-light">Minimum amount: <strong style="float:right;"> $2500</strong></h4><br>
							<h4 class="text-light">Maximum amount:<strong style="float:right;"> $10000</strong></h4><br>
							<h4 class="text-light">Charge Type:<strong style="float:right;">percentage</strong></h4><br>
							<h4 class="text-light">Charges Amount:
								<strong style="float:right;"> 2% </strong>
							</h4><br>
							<h4 class="text-light">Duration:<strong style="float:right;"> Instant Payment</strong></h4><br>

							<div class="text-center">
								<form action="{{route('user.withdraw')}}" method="post">
									@csrf
									<div class="form-group">
										<input type="hidden" value="Doge" name="method">
										<button class="btn btn-primary" type='submit'><i class="fa fa-plus"></i> Request
											withdrawal</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>

				<!-- BITCOIN -->
				<div class="col-lg-4 mt-4">
					<div class="p-3 rounded card bg-dark">
						<div class="card-body border-danger">
							<h2 class="card-title mb-3 text-light"> Bitcoin</h2>
							<h4 class="text-light">Minimum amount: <strong style="float:right;">$2500</strong></h4><br>
							<h4 class="text-light">Maximum amount:<strong style="float:right;"> $100000</strong></h4><br>
							<h4 class="text-light">Charge Type:<strong style="float:right;">percentage</strong></h4><br>
							<h4 class="text-light">Charges Amount:
								<strong style="float:right;"> 0% </strong>
							</h4><br>
							<h4 class="text-light">Duration:<strong style="float:right;"> Instant</strong></h4><br>

							<div class="text-center">
								<form action="{{route('user.withdraw')}}" method="post">
									@csrf
									<div class="form-group">
										<input type="hidden" value="Bitcoin" name="method">
										<button class="btn btn-primary" type='submit'><i class="fa fa-plus"></i> Request
											withdrawal</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>

				<!-- USDT -->
				<div class="col-lg-4 mt-4">
					<div class="p-3 rounded card bg-dark">
						<div class="card-body border-danger">
							<h2 class="card-title mb-3 text-light"> USDT (Tether)</h2>
							<h4 class="text-light">Minimum amount: <strong style="float:right;">$100</strong></h4><br>
							<h4 class="text-light">Maximum amount:<strong style="float:right;"> $50000</strong></h4><br>
							<h4 class="text-light">Charge Type:<strong style="float:right;">percentage</strong></h4><br>
							<h4 class="text-light">Charges Amount:
								<strong style="float:right;"> 1% </strong>
							</h4><br>
							<h4 class="text-light">Duration:<strong style="float:right;"> Instant</strong></h4><br>

							<div class="text-center">
								<form action="{{route('user.withdraw')}}" method="post">
									@csrf
									<div class="form-group">
										<input type="hidden" value="USDT" name="method">
										<button class="btn btn-primary" type='submit'><i class="fa fa-plus"></i> Request
											withdrawal</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>

			</div>

			<!-- Withdrawal Modal -->
			<div id="withdrawdisabled" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-dark">
							<h4 class="modal-title text-light">Withdrawal Status</h4>
							<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body bg-dark">
							<h4 class="text-light">Withdrawal is Disabled at the moment, Please check back later</h4>
						</div>
					</div>
				</div>
			</div>
			<!-- /Withdrawals Modal -->

		</div>
	</div>
	@include('dashboard.footer')
