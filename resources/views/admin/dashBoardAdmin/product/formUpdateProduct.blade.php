<div class="card">
<div class="card-content">
<form id="form-update-product" action="{{ route('ProductAdmin.formProdukUpdate') }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">List Merchant</label>
                <select class="form-control id_merchant" name="id_merchant" data-error=".id_merchanttxt">
                    @foreach($listMerchant as $k => $v) 
                        <option value="{{ $v['id_merchant'] }}" >{{ $v['username_merchant'] }}</option>
                    @endforeach
                </select>
                <div class="id_merchantxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" value="{{ !empty($dataConfig[0]['nama_produk']) ? $dataConfig[0]['nama_produk']  : '' }}" data-error=".nama_produkTxt">
                <div class="nama_produkTxt"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Harga Produk</label>
                <input type="text" class="form-control" name="harga_produk" value="{{ !empty($dataConfig[0]['harga_produk']) ? $dataConfig[0]['harga_produk'] : '' }}" data-error=".harga_produkTxt">
                <div class="harga_produktext"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Keterangan Produk</label>
                <input type="text" class="form-control" name="ket_produk" value="{{ !empty($dataConfig[0]['ket_produk']) ? $dataConfig[0]['ket_produk'] : '' }}" data-error=".ket_produkTxt">
                <div class="ket_produkTxt"></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-sm-12">
            <label class="input-group-btn">
                <span class="btn btn-info btn-sm">
                    Image 1<input type="file" name="name_image_produk[]" style="display: none;" class="imageProd" data-lit="1"> 
                </span>
            </label>
        </div>
        <div class="col-md-8 col-sm-12">
            <input type="text" class="form-control img-text"  name="namefile"  value="{{ !empty($dataConfig[0]['name_image_produk']) ?$dataConfig[0]['name_image_produk'] : '' }}"  readonly placeholder="Image 1" >
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-sm-12">
            <label class="input-group-btn">
                <span class="btn btn-info btn-sm">
                    Image 2<input type="file" name="name_image_produk[]" style="display: none;" class="imageProd" data-lit="2"> 
                </span>
            </label>
        </div>
        <div class="col-md-8 col-sm-12">
            <input type="text" class="form-control img-text"  name="namefile"  value="{{ !empty($dataConfig[1]['name_image_produk']) ? $dataConfig[1]['name_image_produk'] : '' }}"  readonly placeholder="Image 2">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-sm-12">
            <label class="input-group-btn">
                <span class="btn btn-info btn-sm">
                    Image 3<input type="file" name="name_image_produk[]" style="display: none;" class="imageProd" data-lit="3"> 
                </span>
            </label>
        </div>
        <div class="col-md-8 col-sm-12">
            <input type="text" class="form-control img-text"  name="namefile"  value="{{ !empty($dataConfig[2]['name_image_produk']) ? $dataConfig[2]['name_image_produk'] : '' }}"  readonly placeholder="Image 3">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-sm-12">
            <label class="input-group-btn">
                <span class="btn btn-info btn-sm">
                    Image 4<input type="file" name="name_image_produk[]" style="display: none;" class="imageProd" data-lit="4"> 
                </span>
            </label>
        </div>
        <div class="col-md-8 col-sm-12">
            <input type="text" class="form-control img-text"  name="namefile" value="{{ !empty($dataConfig[3]['name_image_produk']) ? $dataConfig[3]['name_image_produk'] : '' }}"  readonly placeholder="Image 4">
        </div>
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
    <input type="hidden" name="id_produk" value="{{ !empty($dataConfig[0]['id_produk']) ? $dataConfig[0]['id_produk'] : '' }}" >
    <div class="hiddenId"></div>
    <button type="submit" class="btn btn-success pull-right buttonGlobal">Update</button>
    <button type="button" class="btn btn-green pull-right backList">Kembali</button>
    <div class="clearfix"></div>
</form>
</div>
</div>

<script src="{{asset('/plugins/jqform/jquery.form.js')}}"></script>
<script>
    var urlGetKampus = "{{ url(route('masterMerchant.getKampus')) }}";
    var token = "{{ csrf_token() }}";
    $('.backList').click(function(){
        var listMerchant  = $('.listMerchant');
        var listDetailMerchant  = $('.listDetailMerchant');
        listMerchant.removeClass('hidden');
        listDetailMerchant.addClass('hidden');
    });
    $('#form-update-product').validate({
            debug: true,
            rules: {
                id_merchant: {
                    required: true,
                },
                nama_produk: {
                    required: true,
                },
                harga_produk: {
                    required: true,
                },
                ket_produk: {
                    required: true,
                }
            },
            messages: {
                id_merchant: {
                    required: "User Merchant wajib di isi",
                },
                nama_produk: {
                    required: "Nama wajib di isi",
                },
                harga_produk: {
                    required: "Harga wajib di isi",
                },
                ket_produk: {
                    required: "Keterangan wajib di isi",
                }
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                doSubmitForm();
            }
    });
    function doSubmitForm() {
        var bar = $('.bar');
            var percent = $('.percent');
            var status = $('#status');
        $('#form-update-product').ajaxSubmit({
            beforeSend: function() {
                $('#myLoading').modal('show');
                var percentVal = '0';
                move(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                move(percentComplete);
            },
            complete: function(xhr) {
                $('#myLoading').modal('hide');
                if(xhr.responseJSON.status) {
                    custom.showNotif('top','center', 1, xhr.responseJSON.message);
                    setTimeout(function(){ 
                        window.location  = xhr.responseJSON.redirect;
                    }, 3000);
                } else {
                    custom.showNotif('top','center', 4, xhr.responseJSON.message);
                }
            }
        }); 
    }

    $('.id_kota').change(function(){
        var idKota = $(this).val();
        $.ajax({
                url: urlGetKampus,
                type: "GET",
                data: { id_kota : idKota, _token:token },
                success: function(retval) {
                    var sel  = "";
                    if (retval.data != "") {
                        $(retval.data).each(function(index, value){
                            sel += "<option value='"+value.id_kampus+"'>"+value.nama_kampus+"</option>";
                        })
                    } else {
                        sel = "<option value=''> Pilih kampus </option>";
                    }
                    $('.id_kampus').html(sel);
                  
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

    $('.imageProd').change(function(e){
        var fileName = e.target.files[0].name;
        var lit = $(this).attr('data-lit');
        $('.img-text').eq(Number(lit) - Number(1)).val(fileName);
        
    });
    function move(percentVal) {
        var elem = document.getElementById("myBar");   
        var width = percentVal;
        elem.style.width = width + '%'; 
        elem.innerHTML =  width + '%';
    }
</script>