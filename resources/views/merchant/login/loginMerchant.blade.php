@extends('indexLogin')
@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="center-block col-md-4" style="float: none;">
				<div class="col-md-12">
					<div class="card card-profile">
						<br>
						<br>
						<div class="content">
							<h6 class="category text-gray">Selamat Datang Dashboard Merchant</h6>
							<div class="card-content">
								<div class="card-header" data-background-color="orange">
									<h4 class="card-title">MERCHANT</h4>
								</div>
								<form id="formLogin">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group label-floating">
												<input type="text" class="form-control" placeholder="Username" name="username">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group label-floating">
												<input type="password" class="form-control passEvent" placeholder="Password" name="password">
											</div>
										</div>
									</div>
									<input type="hidden" name="_token" value="{{csrf_token()}}" >
									<button type="button" class="btn btn-primary pull-right doLogin" >Login</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script>var urlLogin  = "{{ route('merchant.doLogin') }}";</script>
	<script src="{{asset('/') }}js/f_login/login.js"></script>
@endsection