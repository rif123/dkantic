<link href="{{asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel='stylesheet' type='text/css'></link>
<link href="{{asset('/plugins/select2/css/select2.css')}}" rel='stylesheet' type='text/css'></link>
<div class="card">
    <div class="card-header" data-background-color="orange">
        <h4 class="title">Form Promo</h4>
    </div>
    <div class="card-content">

        <form class="form-config-website" action="{{ route('promoOrigin.doSavePromo') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Nama Promo</label>
                        <input type="text" class="form-control nama_kota" name="nama_promo" value="{{ !empty($dataConfig['nama_kota']) ? $dataConfig['nama_kota'] : '' }}" data-error=".nama_promoTxt">
                        <div class="nama_promoTxt"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="form-group">
                        <div class="col-md-2 col-sm-12">
                            <label class="input-group-btn">
                                <span class="btn btn-info btn-sm">
                                    Browse<input type="file" class="imageBanner" name="image_promo" style="display: none;"> 
                                </span>
                            </label>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <input type="text" class="form-control imageBannerName"  value=""  readonly placeholder="Banner Promo">
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Tanggal Mulai Promo</label>
                        <input type="text" class="form-control dataStart" name="date_start_promo" value="{{ !empty($dataConfig['nama_kota']) ? $dataConfig['nama_kota'] : '' }}" data-error=".date_start_promoTxt">
                        <div class="date_start_promoTxt"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Tanggal Akhir Promo</label>
                        <input type="text" class="form-control dataEnd" name="date_end_promo" value="{{ !empty($dataConfig['nama_kota']) ? $dataConfig['nama_kota'] : '' }}" data-error=".date_end_promoTxt">
                        <div class="date_end_promoTxt"></div>
                    </div>
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Outlate</label>
                        <select name="outlate" class="outlate form-control"> <option value="" > Pilih Outlate </option></select>
                        <div class="nama_kotaTxt"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Produk</label>
                        <select name="id_produk" class="productList form-control"> <option value="" > Pilih Product </option></select>
                        <div class="nama_kotaTxt"></div>
                    </div>
                </div>
            </div>
            -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <div class="hiddenId"></div>
            <button type="submit" class="btn btn-primary pull-right buttonGlobal">Simpan</button>
            <button type="button" class="btn btn-green pull-right backList">Kembali</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
<script src="{{asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/plugins/select2/js/select2.js')}}"></script>
<script>
    var urlGetOutlate = "{{ route('promoOrigin.getOutlate') }}";
    var urlGetProd = "{{ route('promoOrigin.getProduk') }}";
     $(function () {
        $('.dataStart').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $('.dataEnd').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $(".outlate").select2({
            ajax: {
                url: urlGetOutlate,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
                },
                processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                    more: (params.page * 30) < data.total_count
                    }
                };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    function formatRepo (repo) {
        var markup = repo.text
        return markup;
    }

    function formatRepoSelection (repo) {
        return repo.text;
    }

    $(".outlate").on('change', function(){
        var idMerchant = this.value;
        $.ajax({
            url: urlGetProd,
            type: "post",
            data:  { idMerchant : idMerchant, _token :token } ,
            success: function(retval) {
                if(retval.total_count > 0) {
                    var html  = "";
                    $(retval.items).each(function(index, value){
                        html += "<option value='"+value.id_produk+"'>"+value.nama_produk+"</option>";
                    })
                    $('.productList').html(html);
                } else {
                    var html = "<option value=''>Produk Di outlate Kosong</option>";
                    $('.productList').html(html);
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
    $('.imageBanner').change(function() {
        var filename = $('.imageBanner').val();
        $('.imageBannerName').val(filename);
    });
    $('.backList').click(function() {
        $('.section1').removeClass('hidden');
        $('.section2').addClass('hidden');
    });


     // for form 
     $('.form-config-website').validate({
            debug: true,
            rules: {
                nama_promo: {
                    required: true,
                },
                date_start_promo: {
                    required: true,
                },
                date_end_promo: {
                    required: true,
                }
            },
            messages: {
                nama_promo: {
                    required: "Silahkan Isi Nama Promo",
                },
                date_start_promo: {
                    required: "Silahkan Isi Taggal Mulai Promo",
                },
                date_end_promo: {
                    required: "Silahkan Isi Tanggal AKhir Promo",
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
            $('.form-config-website').ajaxSubmit({
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

    function move(percentVal) {
        var elem = document.getElementById("myBar");   
        var width = percentVal;
        elem.style.width = width + '%'; 
        elem.innerHTML =  width + '%';
    }
</script>