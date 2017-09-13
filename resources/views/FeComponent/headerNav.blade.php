
<!-- header -->
<header id="header">
<?php 
	// echo "<pre>";
	// print_R(menuConfig());die;
?>
		<div class="container">
			<!-- main header -->
			<div class="row">
				<div class="main-header">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="logo">
								<a href="{{ url(route('fe.index')) }}"><img src="{{ asset('/frontend/data/') }}/option1/logo.png" alt="Logo"></a>
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
                                        <div class="block-mini-cart">
                                            <div class="mini-cart-content">
                                            <h5 class="mini-cart-head">2 Items in my cart</h5>
                                            <div class="mini-cart-list">
                                                <ul>
                                                    <li class="product-info">
                                                        <div class="p-left">
                                                            <a href="#" class="remove_link"></a>
                                                            <a href="#">
                                                            <img class="img-responsive" src="{{ asset('/frontend/data/') }}/p1.jpg" alt="Product">
                                                            </a>
                                                        </div>
                                                        <div class="p-right">
                                                            <p class="p-name">Donec Ac Tempus</p>
                                                            <p class="product-price">$139.98</p>
                                                            <p>Qty: 1</p>
                                                        </div>
                                                    </li>
                                                    <li class="product-info">
                                                        <div class="p-left">
                                                            <a href="#" class="remove_link"></a>
                                                            <a href="#">
                                                            <img class="img-responsive" src="{{ asset('/frontend/data/') }}/p2.jpg" alt="Product">
                                                            </a>
                                                        </div>
                                                        <div class="p-right">
                                                            <p class="p-name">Donec Ac Tempus</p>
                                                            <p class="product-price">$139.98</p>
                                                            <p>Qty: 1</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                </div>
                                                <div class="toal-cart">
                                                    <span>Total</span>
                                                    <span class="toal-price pull-right">$279.96</span>
                                                </div>
                                                <div class="cart-buttons">
                                                    <a href="checkout.html" class="button-radius btn-check-out">Checkout<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
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