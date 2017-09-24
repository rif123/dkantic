@if($status == false)
<div class="block block-categories-slider">
	<div class="banner-text">
		<h4>{{ $listPromoBox[0]['nama_promo'] }}</h4>
		<p>{{ $listPromoBox[0]['desc_promo'] }}</p>
	</div>
</div>
@endif

@if($status == true)
<div class="block block-categories-slider">
	<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">
		@foreach($listPromoBox as $key => $val)
			<a href="#"><img src="{{ asset('/imagePromoSlide').'/'.$val['image_slide'] }}" alt="slider-cat.jpg" style="height:20vh"></a>
		@endforeach
	</div>
</div>
@endif
