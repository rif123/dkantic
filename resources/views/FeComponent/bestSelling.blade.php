<!-- block tabs -->
<div class="col-sm-12">
					<div class="block block-tabs">
						<div class="block-head">
							<div class="block-title">
								<div class="block-title-text text-lg">Kategori</div>
							</div>
							<ul class="nav-tab">                           
								@foreach(listKategory() as $key => $val)
								@php $active = "" @endphp
									@if($key == 0) 
										@php $active = "active" @endphp
									@endif
									<li class="{{ $active }}" ><a data-toggle="tab" href="#tab-{{$key}}">{{ $val['nama_kategori'] }}</a></li>
								@endforeach
	                      	</ul>
						</div>
						<div class="block-inner">
							<div class="tab-container">
								@foreach(listKategory() as $key => $val)
									@php $active = "" @endphp
									@if($key == 0) 
										@php $active = "active" @endphp
									@endif
									<div id="tab-{{$key}}" class="tab-panel {{ $active }}">
										<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
											@foreach(listProdByKategori($val['id_kategori']) as $k => $v)
												@php 
													$getImage = listGetImage($v['id_produk']);
													$image = !empty($getImage[0]['name_image_produk']) ? $getImage[0]['name_image_produk'] : "";
												@endphp
												<li class="product">
													<div class="product-container">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="#"><img src="{{ asset('/images/') }}/{{$image}}" alt="Product"></a>
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
				<!-- ./block tabs -->