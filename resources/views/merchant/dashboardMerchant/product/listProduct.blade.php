<div class="content">
				<div class="container-fluid">
					<div class="row">
                        @foreach($listProduk as $key => $val)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header card-chart" data-background-color="green">
                                        <img src="{{asset('/img/content/').'/'.$val['img_produk']}}">
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
					</div>
            </div>		
</div>