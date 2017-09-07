<div class="content">
<div class="container-fluid" >
    <div class="row">
        @if(!empty($dataProduk))
            @php 
                $listProd = getImageProd($dataProduk['id_produk']);
                $img = "";
                if(!empty($listProd[0]['name_image_produk'])) {
                    $img = $listProd[0]['name_image_produk'];
                }
            @endphp
                <div class="col-md-12 doPreview" style="cursor:pointer" data-id-produk="{{$dataProduk['id_produk']}}">
                    <div class="card">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                            @if(!empty($listProd))
                                @foreach($listProd as $key => $val)
                                    @php $active = ""; @endphp
                                        @if($key == 0)
                                            @php $active = "active"; @endphp
                                        @endif
                                    <div class="item {{$active}}">
                                        <img src="{{asset('/images/').'/'.$val['name_image_produk']}}" alt="Produk">
                                    </div>
                                @endforeach
                            @endif
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="icon-prev fa-stack fa-lg">
                                    <i class="fa fa-angle-left fa-stack-1x"></i>
                                </span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="icon-next fa-stack fa-lg">
                                        <i class="fa fa-angle-right fa-stack-1x"></i>
                                    </span>
                            </a>
                        </div>

                        <div class="card-content">
                            <h4 class="title">{{ $dataProduk['nama_produk'] }}</h4>
                            <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> - </span> Produk sales.</p>
                        </div>
                        <div class="card-content">
                            <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> - </span> {{ numToRp($dataProduk['harga_produk']) }} </p>
                        </div>
                        <div class="card-content">
                            <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> - </span> {{ $dataProduk['ket_produk'] }} </p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated {{ date("d M Y H:i:s", strtotime($dataProduk['created'])) }}
                                </br>
                            </div>
                            <button type="button" class="btn btn-green pull-right updateProd" data-id-produk="{{ $dataProduk['id_produk'] }}">Update</button>
                            <button type="button" class="btn btn-danger pull-right deleteProd" data-id-produk="{{ $dataProduk['id_produk'] }}">Delete</button>
                        </div>
                    </div>
                </div>        
        @else
        <p class="text-info">
            Belum ada data produk.                 
        </p>
        @endif
    </div>
</div>		
</div>
<script>
    var urlUpdate = "{{ route('productMerchant.update') }}";
    var urlEdit = "{{ route('productMerchant.edit') }}";
    var urlDeleteProd = "{{ route('productMerchant.deleteProd') }}";
    var urlDeleteImage = "{{ route('productMerchant.deleteImage') }}";
    var token = "{{ csrf_token() }}";
    var pathImage = "{{ asset('/images/') }}";
    $('.updateProd').click(function(){
        var id_produk  = $(this).attr('data-id-produk');
        $.ajax({
            url: urlUpdate,
            type: "POST",
            data: {id_produk : id_produk, _token : token },
            success: function(retval) {
                if (retval.data != "") {
                    var namaProd =  $('.nama_produk');
                    var hargaProd = $('.harga_produk');
                    var ketProd =  $('.ket_produk');
                    var listFileImage =  $('.bodyList');
                    var statusHiddenIMage =  $('.listFileImage');
                    var buttonAction =   $('.buttonActionProduct');
                    var formClass =   $('.form-add-product');

                    namaProd.val(retval.data.nama_produk);
                    namaProd.parent().removeClass('is-empty');
                    hargaProd.val(retval.data.harga_produk);
                    hargaProd.parent().removeClass('is-empty');
                    ketProd.val(retval.data.ket_produk);
                    ketProd.parent().removeClass('is-empty');
                    statusHiddenIMage.removeClass('hidden');
                    listFileImage.html('');
                    $(retval.dataImage).each(function(index, value){
                        listFileImage.append('<div class="card-content list-counter-image-'+index+' "><img src="'+pathImage+'/'+value.name_image_produk+'"  style="width:100px" />  <button type="button" class="btn btn-warning btn-sm" onclick="deleteImage(\''+index+'\', \''+value.id_image_produk+'\', \''+value.name_image_produk+'\')" > <i class="material-icons">close</i> Delete</button></div>');
                    });
                    buttonAction.html('Update');
                    buttonAction.removeClass('btn-primary');
                    buttonAction.addClass('btn-success');

                    formClass.attr('action', urlEdit+"?id_produk="+id_produk);
                    $('.nav-tabs a[href="#messages"]').tab('show');
                    
                }
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
    $('.deleteProd').click(function(){
        var id_produk  = $(this).attr('data-id-produk');
        $('#myConfirmLabel').html('Konfirmasi');
        $('#myConfirmBody').html('Apakah Anda yakin hapus data Produk ini ?');
        $('#confirmOK').attr('onclick', 'removeProd("'+id_produk+'")');
        $('#myConfirm').modal('show');
    });
    function removeProd(id_produk) {
        $.ajax({
            url: urlDeleteProd,
            type: "POST",
            data: {id_produk : id_produk, _token : token },
            success: function(retval) {
                $('#myConfirm').modal('hide');
                if(retval.status) {
                    custom.showNotif('top','center', 1, retval.message);
                    setTimeout(function(){ 
                        window.location  = retval.redirect
                    }, 3000);
                } else {
                    custom.showNotif('top','center', 4, retval.message);
                }
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
    }
    function deleteImage(index, id_image_produk, name_image_produk) {
        $.ajax({
            url: urlDeleteImage,
            type: "POST",
            data: {id_image_produk : id_image_produk, name_image_produk : name_image_produk, _token : token },
            success: function(retval) {
                if (retval.status) {
                    custom.showNotif('top','center', 1, retval.message);
                        setTimeout(function(){ 
                            $('.bodyList').find('.list-counter-image-'+index).slideUp();
                        }, 1000);
                } else {
                    custom.showNotif('top','center', 4, retval.message);
                }
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
    }
</script>