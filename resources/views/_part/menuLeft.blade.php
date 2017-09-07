@php
	$merchant = get_menu_merchant();
@endphp
<div class="sidebar-wrapper">
		<ul class="nav">
			@foreach($merchant as $key => $val)
				@php $checked = "";  @endphp
				@if( $val['link'] == route(Route::currentRouteName()) )
					@php  $checked = "active"  @endphp
				@endif 
				<li class="{{$checked}}">
					<a href="{{$val['link']}}">
						<i class="material-icons">{{$val['icon']}}</i>
						<p>{{$val['label']}}</p>
					</a>
				</li>
			@endforeach
			<li class="active-pro">
				<a href="{{ url(route('merchant.destroy')) }}">
					<i class="material-icons">account_circle</i>
					<p>Logout</p>
				</a>
			</li>
		</ul>
	</div>
</div>
