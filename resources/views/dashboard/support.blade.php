@include('dashboard.header')
<div class="main-panel bg-dark">
	<div class="content bg-dark">
		<div class="page-inner">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif
			@if($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{$message}}</p>
			</div>
			@endif
			<div class="mb-5 row p-md-3">
				<div class="shadow col-12 p-md-2">
					<div class="col-12 text-center bg-dark p-3">
						<h1 class="title1 text-light">S9fx Network Support</h1>
						<div class="sign-up-row widget-shadow text-light">
							<h4 class="text-light">For inquiries, suggestions or complains. Mail us</h4>
							<h1 class="mt-3 text-primary"> <a
									href="mailto:support@digitalcryptocurrencytrade.com">support@s9fxnetwork.com</a>
							</h1>
						</div>
					</div>
					<div class="pb-5 col-md-8 offset-md-2">
						<form method="post" action="{{url('/support-email')}}">
							@csrf
							<div class="form-group">
								<input type="hidden" name="name" value="{{Auth::user()->name}}" />
							</div>
							<div class="form-group">
								<input type="hidden" name="email" value="{{Auth::user()->email}}" />
							</div>

							<div class="form-group">
								<h5 for="" class="text-light">Message<span class=" text-danger">*</span></h5>
								<textarea name="message" class="form-control text-light bg-dark" rows="5"></textarea>
							</div>
							<div class="">
								<input type="submit" class="py-2 btn btn-primary btn-block" value="Send">
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	@include('dashboard.footer')