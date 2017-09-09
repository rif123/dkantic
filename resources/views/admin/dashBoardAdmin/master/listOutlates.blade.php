<div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">New Outlate</h4>
	                                <p class="category">Data Terbaru Outlate</p>
	                            </div>
	                            <div class="card-content table-responsive">
	                                <table class="table table-hover">
	                                    <thead class="text-warning">
	                                        <th>ID</th>
	                                    	<th>Name</th>
	                                    	<th>Pemilik</th>
	                                    	<th>Alamat</th>
	                                    	<th>Hp</th>
	                                    	<th>Create</th>
	                                    </thead>
	                                    <tbody>
										@php $no = "1" @endphp
										@if(!empty($listOutlate))
											@foreach ($listOutlate as $key => $val)
												<tr>
													<td>{{$no}}</td>
													<td>{{$val['nama_outlate']}}</td>
													<td>{{$val['nama_pemilik_outlate']}}</td>
													<td>{{$val['alamat_outlate']}}</td>
													<td>{{$val['hp_outlate']}}</td>
													<td>{{ date("d M Y H:i:s", strtotime($val['created'])) }}</td>
												</tr>
												@php $no++; @endphp
											@endforeach
										@endif
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>