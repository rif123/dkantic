<!-- Block hot deals2 -->
<div class="col-sm-12">
	<div class="block-hot-deals2">
		<h3 class="title">hot deals</h3>
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<div class="hot-deal-tab">
					<div class="countdown">
						<span class="countdown-lastest" data-y="2016" data-m="10" data-d="1" data-h="00" data-i="00" data-s="00"></span>
					</div>
					<ul class="nav-tab">
						<li class="active"><a data-toggle="tab" href="#hotdeals-1">up to 70% off</a></li>
						@foreach($listPromo as $key => $val)
							@php $active = "" @endphp
							@if($key == 0)
								@php $active = "active" @endphp
							@endif
							<li class="{{ $active }}"><a data-toggle="tab" href="#hotdeals-{{$key}}">{{ $val['nama_promo'] }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-sm-8 col-md-9">
				<div class="tab-container">
				@foreach($listPromo as $key => $val)
						@php $active = "" @endphp
						@if($key == 0)
							@php $active = "active" @endphp
						@endif
					<div id="hotdeals-{{$key}}" class="tab-panel {{ $active  }}">
						<ul class="products kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
							@foreach(listProdByPromo($val['id_promo']) as $k => $v)
								@php 
									$getImage = listGetImage($v['id_produk']);
									$image = !empty($getImage[0]['name_image_produk']) ? $getImage[0]['name_image_produk'] : "";
								@endphp
								<li class="product">
									<div class="product-container">
										<div class="product-left">
											<div class="product-thumb">
												<a class="product-img" href="#"><img  onerror="this.onerror=null;this.src='{{ asset('/img/placeholder.png') }}';"  src="{{ asset('/images/') }}/{{$image}}" alt="Product" style="height:15vh"></a>
												<a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
											</div>
										</div>
										<div class="product-right">
											<div class="product-name">
												<a href="#">{{ $v['nama_produk'] }}</a>
											</div>
											<div class="price-box">
												<span class="product-price">{{ convertRp($v['harga_produk']) }}</span>
											</div>
											<div class="product-star">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-half-o"></i>
											</div>
											<div class="product-button">
												<a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
											</div>
										</div>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				@endforeach


				</div>
			</div>
		</div>
	</div>
</div>
                <!-- Block hot deals2 -->