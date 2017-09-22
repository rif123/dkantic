
<div class="card">
<div class="card-content">

<form class="form-add-merchant" action="{{ route('masterMerchant.create') }}" method="POST" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">User Merchant</label>
            <input type="text" class="form-control" name="username_merchant" value="{{ !empty($dataConfig['username_merchant']) ? $dataConfig['username_merchant'] : '' }}" data-error=".username_merchantTxt">
            <div class="username_merchantTxt"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Password Merchant</label>
            <input type="text" class="form-control" name="pass_merchant" value="{{ !empty($dataConfig['pass_merchant']) ? $dataConfig['pass_merchant'] : '' }}" data-error=".pass_merchantxt">
            <div class="pass_merchantxt"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Kota</label>
            <select class="form-control id_kota" name="id_kota" data-error=".id_kotatxt">
                @foreach($listKota as $k => $v) 
                    <option value="{{ $v['id_kota'] }}" >{{ $v['nama_kota'] }}</option>
                @endforeach
            </select>
            <div class="id_kotatxt"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Kota</label>
            <select class="form-control id_kampus" name="id_kampus" data-error=".id_kampustext">
                <option value="">Pilih Kampus</option>
            </select>
            <div class="id_kampustext"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Kampus</label>
            <select class="form-control" name="id_kategori" data-error=".id_kategoritxt">
                @foreach($listCategori as $k => $v) 
                    <option value="{{ $v['id_kategori'] }}" >{{ $v['nama_kategori'] }}</option>
                @endforeach
            </select>
            <div class="id_kategoritxt"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Nama Oulate</label>
            <input type="text" class="form-control" name="nama_outlate" value="{{ !empty($dataConfig['nama_outlate']) ? $dataConfig['nama_outlate'] : '' }}" data-error=".nama_outlateTxt">
            <div class="nama_outlatext"></div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Nama Pemilik Outlate</label>
            <input type="text" class="form-control" name="nama_pemilik_outlate" value="{{ !empty($dataConfig['nama_pemilik_outlate']) ? $dataConfig['nama_pemilik_outlate'] : '' }}" data-error=".nama_pemilik_outlatetxt">
            <div class="nama_pemilik_outlatetxt"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Alamat Outlate</label>
            <textarea name="alamat_outlate" class="form-control" data-error=".alamat_outlatetxt"></textarea>
            <div class="alamat_outlatetxt"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Hp Outlate</label>
            <input type="text" class="form-control" name="hp_outlate" value="{{ !empty($dataConfig['hp_outlate']) ? $dataConfig['hp_outlate'] : '' }}" data-error=".hp_outlatetxt">
            <div class="hp_outlatetxt"></div>
        </div>
    </div>
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}" >
<input type="hidden" name="id_promo" value="{{ !empty($dataConfig['id_promo']) ? $dataConfig['id_promo'] : '' }}" >
<div class="hiddenId"></div>
<button type="submit" class="btn btn-primary pull-right buttonGlobal">Save</button>
<button type="button" class="btn btn-green pull-right backList">Kembali</button>
<div class="clearfix"></div>
</form>
</div>
</div>
<script>
    var urlGetKampus = "{{ url(route('masterMerchant.getKampus')) }}";
    var token = "{{ csrf_token() }}";
    $('.backList').click(function(){
        var listMerchant  = $('.listMerchant');
        var listDetailMerchant  = $('.listDetailMerchant');
        listMerchant.removeClass('hidden');
        listDetailMerchant.addClass('hidden');
    });
    $('.form-add-merchant').validate({
            debug: true,
            rules: {
                username_merchant: {
                    required: true,
                },
                pass_merchant: {
                    required: true,
                },
                id_kota: {
                    required: true,
                },
                id_kampus: {
                    required: true,
                },
                id_kategori: {
                    required: true,
                },
                nama_outlate: {
                    required: true,
                },
                nama_pemilik_outlate: {
                    required: true,
                },
                alamat_outlate: {
                    required: true,
                },
                hp_outlate: {
                    required: true,
                },

            },
            messages: {
                username_merchant: {
                    required: "User Merchant wajib di isi",
                },
                pass_merchant: {
                    required: "Password wajib di isi",
                },
                id_kota: {
                    required: "Kota wajib di isi",
                },
                id_kampus: {
                    required: "Kampus wajib di isi",
                },
                id_kategori: {
                    required: "Kategori wajib di isi",
                },
                nama_outlate: {
                    required: "Nama Outlate wajib di isi",
                },
                nama_pemilik_outlate: {
                    required: "Nama Pemilik wajib di isi",
                },
                alamat_outlate: {
                    required: "Alamat wajib di isi",
                },
                hp_outlate: {
                    required: "Hp wajib di isi",
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
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(retval) {
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
        });
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
</script>