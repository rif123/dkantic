<div class="col-lg-6 col-md-6">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Detail informasi Merchant</h4>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card-content table-responsive">
                <table class="table table-hover listGlobal">
                    <thead class="text-warning">
                        <tr>
                            <th>Name</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{ !empty($parser[0]['id_merchant']) ? $parser[0]['id_merchant'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>user Merchant</td>
                            <td>{{ !empty($parser[0]['username_merchant']) ? $parser[0]['username_merchant'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>{{ !empty($parser[0]['nama_kota']) ? $parser[0]['nama_kota'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Kampus</td>
                            <td>{{ !empty($parser[0]['nama_kampus']) ? $parser[0]['nama_kampus'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>{{ !empty($parser[0]['nama_kategori']) ? $parser[0]['nama_kategori'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>nama Outlate</td>
                            <td>{{ !empty($parser[0]['nama_outlate']) ? $parser[0]['nama_outlate'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pemilik Outlate</td>
                            <td>{{ !empty($parser[0]['nama_pemilik_outlate']) ? $parser[0]['nama_pemilik_outlate'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Outlate</td>
                            <td>{{ !empty($parser[0]['alamat_outlate']) ? $parser[0]['alamat_outlate'] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Hp</td>
                            <td>{{ !empty($parser[0]['hp_outlate']) ? $parser[0]['hp_outlate'] : '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card-content table-responsive">
                <table class="table table-hover listGlobal">
                    <thead class="text-warning">
                        <tr>
                            <th>Hari</th>
                            <th>Bukan Jam</th>
                            <th>Tutup Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($openCloseToko as $key => $val)
                        <tr>
                            <td>{{ $val['hari_open'] }}</td>
                            <td>{{ $val['jam_open']." ".$val['menit_open'] }}</td>
                            <td>{{ $val['jam_close']." ".$val['menit_close'] }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="3"><span class="btn btn-success btn-sm backList">Kembali</span></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<div class="col-lg-6 col-md-6">
    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title">List Produk</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table table-hover listGlobal">
                <thead class="text-warning">
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Ket</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($parser))
                        @foreach($parser as $key => $val) 
                            <tr>
                                <th>{{$val['id_produk']}}</th>
                                <th>{{$val['nama_produk']}}</th>
                                <th>{{numToRp($val['harga_produk'])}}</th>
                                <th>{{$val['ket_produk']}}</th>
                                <th><span class="btn btn-success btn-sm openImage" data-id-produk="{{$val['id_produk']}}">Image</span></th>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var urlGetImageProd = "{{route('masterMerchant.getListImageProd')}}"; 
    var urlImage = "{{ asset('/images') }}";
    $('.openImage').click(function(){
        
        var id = $(this).attr('data-id-produk');
        $.ajax({
            url: urlGetImageProd,
            type: "post",   
            data:  { id : id, _token :token } ,
            success: function(retval) {
                var html = "";
                var active = "";
                $(retval.data).each(function(index, value){
                    if (index == 0) {
                        active = "active";
                    }
                    html += '<div class="item '+active+' " ><img src="'+urlImage+"/"+value.name_image_produk+'" alt=""></div>';
                });
                $('.myPreviewImageList').html(html);
                $('#myPreviewimage').modal('show');
            },
            error: function (jqXHR, exception) {
                    var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                custom.showNotif('top','center', 4, msg)
            }            
        });
    });
    $('.backList').click(function(){
       $('.listMerchant').removeClass('hidden'); 
       $('.listDetailMerchant').addClass('hidden'); 
    });
</script>