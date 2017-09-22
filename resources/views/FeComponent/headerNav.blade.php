
<!-- header -->
<header id="header">
		<div class="container">
			<!-- main header -->
			<div class="row">
				<div class="main-header">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="logo">
								<a href="{{ url(route('fe.index')) }}"><img src="{{ asset('/imageConfig/') }}/{{ menuConfig('logo_config') }}" alt="Logo"></a>
							</div>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 main-header-banner">
							<div class="block block-header-right">
								<ul class="list-link">
									<li class="item">
										<a href="#">
											<span class="icon phone"></span>
											<span class="line1">Call us:<br><strong>{{ menuConfig('telp_config') }}</strong></span>
										</a>
									</li>
									<li class="item">
										@if(\Session::has('authCustomer')) 
										<a href="{{ url(route('user.doLogout')) }}">
											<span class="icon login"></span>
											<span class="line1">Logout<br><strong>Keluar</strong></span>
										</a>
										<a href="{{ url(route('user.profile')) }}">
											<span class="icon login"></span>
											<span class="line1">Profile<br><strong>Setting Profile</strong></span>
										</a>
										@else 
										<a href="{{ url(route('user.login')) }}">
											<span class="icon login"></span>
											<span class="line1">Login<br><strong>Registrasi</strong></span>
										</a>
										@endif
									</li>
									<li class="item">
										<a href="checkout.html">
											<span class="icon checkout"></span>
											<span class="line1">Checkout<br><strong>Order</strong></span>
										</a>
									</li>
									<li class="item item-cart block-wrap-cart">
										<a href="cart.html">
											<span class="icon cart"></span>
											<span class="line1">Shopping Cart<br><strong>$0.00</strong></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ./main header -->
		</div>
        @include('FeComponent.menuHorizontal')
	</header>
	<!-- ./header -->