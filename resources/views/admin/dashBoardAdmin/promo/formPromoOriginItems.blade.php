<link href="{{asset('/plugins/select2/css/select2.css')}}" rel='stylesheet' type='text/css'></link>
<div class="card">
    <div class="card-header" data-background-color="orange">
        <h4 class="title">Form Tambah Item</h4>
    </div>
    <div class="card-content">

        <form class="form-promo-items" action="{{ route('promoOrigin.doSaveRoleItems') }}" method="POST" enctype="multipart/form-data">
             <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Promo</label>
                        <select name="id_promo" class="getPromo form-control" data-error=".promoTxt"> 
                            <option value="" > Pilih Promo </option>
                        </select>
                        <div class="promoTxt"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Outlate</label>
                        <select name="outlate" class="outlate form-control" data-error=".outlateTxt"> <option value="" > Pilih Outlate </option></select>
                        <div class="outlateTxt"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Produk</label>
                        <div class="listProdukMerchant"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <div class="hiddenId"></div>
            <button type="submit" class="btn btn-primary pull-right buttonGlobal">Simpan</button>
            <button type="button" class="btn btn-green pull-right backList">Kembali</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
<script src="{{asset('/plugins/select2/js/select2.js')}}"></script>
<script>
    var urlGetOutlate = "{{ route('promoOrigin.getOutlate') }}";
    var urlGetProd = "{{ route('promoOrigin.getProduk') }}";
    var urlGetPromoList = "{{ route('promoOrigin.getPromoList') }}";
     $(function () {
        $(".getPromo").select2({
            ajax: {
                url: urlGetPromoList,
                dataType: 'json',
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
            minimumInputLength: 2,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        $(".outlate").select2({
            ajax: {
                url: urlGetOutlate,
                dataType: 'json',
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
            allowClear: true,
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
    $(".getPromo").on('change', function(){
        $('.outlate').val(null).trigger("change");
        $('.listProdukMerchant').html('');
    });

    $(".outlate").on('change', function(){
        var idMerchant = this.value;
        if (idMerchant != "") {
            $.ajax({
                url: urlGetProd,
                type: "post",
                data:  { idMerchant : idMerchant, _token :token } ,
                success: function(retval) {
                    if(retval.total_count > 0) {
                        var html  = "";
                        $(retval.items).each(function(index, value){
                            html += "<input type='checkbox' value='"+value.id_produk+"' name='id_produk[]'> "+value.nama_produk+"</br>";
                        })
                        $('.listProdukMerchant').html(html);
                    } else {
                        $('.listProdukMerchant').html(html);
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
    $('.backList').click(function() {
        $('.section1').removeClass('hidden');
        $('.section2').addClass('hidden');
    });
     // for form 
     $('.form-promo-items').validate({
            debug: true,
            rules: {
                outlate: {
                    required: true,
                }
            },
            messages: {
                outlate: {
                    required: "Silahkan Isi Outlate",
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
</script>