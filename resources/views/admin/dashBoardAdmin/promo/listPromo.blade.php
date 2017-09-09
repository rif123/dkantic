<div class="card">
	<div class="card-header" data-background-color="purple">
		<h4 class="title">New Data Kota</h4>
		<p class="category">Data Terbaru Kota</p>
	</div>
	<div class="card-content table-responsive">
		<table class="table table-hover">
			<thead class="text-warning">
				<th>ID</th>
				<th>Name</th>
				<th>Created</th>
			</thead>
			<tbody>
			@php $no = "1" @endphp
			@if(!empty($listKota))
				@foreach ($listKota as $key => $val)
					<tr>
						<td>{{$no}}</td>
						<td>{{$val['nama_kota']}}</td>
						<td>{{ date("d M Y H:i:s", strtotime($val['created'])) }}</td>
					</tr>
					@php $no++; @endphp
				@endforeach
			@endif
			</tbody>
		</table>
	</div>
</div>