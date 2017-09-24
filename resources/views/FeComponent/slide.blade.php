<div class="col-sm-5 col-md-7">
		<div class="advanced-search box-radius">
			<form class="form-inline">
				<div class="form-group search-category">
					<select id="category-select" class="search-category-select">
						<option value="">All Categories</option>
						@foreach(getCategori() as $key => $val)
							<option value="{{ $val['id_kategori'] }}">{{ $val['nama_kategori'] }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group search-input">
					<input type="text" placeholder="Mau Makan Apa Hari ini?">
				</div>
				<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<!-- ./block search -->


	<div class="col-sm-9 col-md-7">
		<!-- Home slide -->
		<div class="block block-slider">
			<ul class="home-slider kt-bxslider">
				@foreach($listPromoBox as $k => $v)
					<li>
						<a href="{{ url('/promo-slider').'/'.toSlug($v['nama_slide']).'/'.$v['id_slide'] }}">
							<img onerror="this.onerror=null;this.src='{{ asset('/img/placeholder.png') }}';" src="{{ asset('/imagePromoSlide/') }}/{{ $v['image_slide'] }}" alt="Slider">
						</a>
					</li>
				@endforeach
			</ul>
		</div>
		<!-- ./Home slide -->
	</div>


	<div class="col-sm-9 col-md-3">
		<div class="block-banner-right banner-hover">
			@foreach($listPromoBox as $k => $v)
				@if($k < 2)
					<a href="#"><img onerror="this.onerror=null;this.src='{{ asset('/img/placeholder.png') }}';" src="{{ asset('/imagePromoSlide/') }}/{{ $v['image_slide'] }}" alt="Banner"></a>
				@endif
			@endforeach
		</div>
	</div>
<!-- block banner owl-->
<div class="col-sm-12">
	<div class="block block-banner-owl" >
		<div class="block-inner kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
			@foreach($listPromo as $key => $val)
				<div class="banner-text">
					<h4>{{ $val['nama_promo'] }}</h4>
					<p>{{ $val['desc_promo'] }}</p>
					<a class="button-radius white" href="{{ url('/promo').'/'.toSlug($val['nama_promo']).'/'.$val['id_promo'] }}">Shop now<span class="icon"></span></a>
				</div>
				@endforeach
		</div>
	</div>
</div>