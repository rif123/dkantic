<div class="content">
				<div class="container-fluid" >
					<div class="row">
                        @if(!empty($listProduk))
                            @foreach($listProduk as $key => $val)
                            @php 
                                $listProd = getImageProd($val['id_produk']);
                                $img = "";
                                if(!empty($listProd[0]['name_image_produk'])) {
                                    $img = $listProd[0]['name_image_produk'];
                                }
                            @endphp
                                <div class="col-md-4 doPreview" style="cursor:pointer" data-id-produk="{{$val['id_produk']}}">
                                    <div class="card">
                                        <div class="card-header card-chart" data-background-color="green">
                                            <img src="{{asset('/images/').'/'.$img}}">
                                        </div>
                                        <div class="card-content">
                                            <h4 class="title">{{ $val['nama_produk'] }}</h4>
                                            <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> - </span> Produk sales.</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">access_time</i> updated {{ date("d M Y H:i:s", strtotime($val['created'])) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach          
                        @else
                        <p class="text-info">
                            Belum ada data produk.                 
                        </p>
                        @endif
					</div>
            </div>		
</div>