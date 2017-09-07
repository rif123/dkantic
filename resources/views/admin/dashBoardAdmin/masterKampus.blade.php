@extends('index')
@section('content')
@include('_part/menuLeftAdmin')
<link href="{{asset('/plugins/jqDatatable/jquery-datatable.css')}}" rel='stylesheet' type='text/css'></link>
<div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">{{ $label }}</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">dashboard</i>
									<p class="hidden-lg hidden-md">Dashboard</p>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">notifications</i>
									<span class="notification">5</span>
									<p class="hidden-lg hidden-md">Notifications</p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Mike John responded to your email</a></li>
									<li><a href="#">You have 5 new tasks</a></li>
									<li><a href="#">You're now friend with Andrew</a></li>
									<li><a href="#">Another Notification</a></li>
									<li><a href="#">Another One</a></li>
								</ul>
							</li>
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
	 							   <i class="material-icons">person</i>
	 							   <p class="hidden-lg hidden-md">Profile</p>
		 						</a>
							</li>
						</ul>

						<form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form>
					</div>
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 col-md-12">
                            @include('admin.dashBoardAdmin.master.menu')
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="purple">
                                <h4 class="title">List Master Kampus</h4>
                                <a href="#profile" data-toggle="tab" class="showFilter">
                                    <i class="material-icons">find_in_page</i>
                                    Filter
                                    <div class="ripple-container"></div>
                                </a>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table table-hover listGlobal">
                                    <thead class="text-warning">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama kampus</th>
                                            <th>Kota</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama kampus</th>
                                            <th>Kota</th>
                                            <th>#</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="orange">
                                <h4 class="title">Form Kampus</h4>
                            </div>
                            <div class="card-content">

                                <form class="form-global" action="{{ route('masterKampus.create') }}" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nama Kampus</label>
                                                <input type="text" class="form-control nama_kampus" name="nama_kampus" value="{{ !empty($dataConfig['nama_kampus']) ? $dataConfig['nama_kampus'] : '' }}" data-error=".nama_kotaTxt">
                                                <div class="nama_kotaTxt"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nama Kampus</label>
                                                    <select name="id_kota" class="form-control id_kota">
                                                        @foreach($listKota as $key => $val)
                                                            <option value="{{$val['id_kota']}}">{{$val['nama_kota']}}</option>
                                                        @endforeach
                                                    </select>
                                                <div class="nama_kotaTxt"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <div class="hiddenId"></div>
                                    <button type="submit" class="btn btn-primary pull-right buttonGlobal">Simpan</button>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
                        </div>
                    </div>


				</div>
            </div>
            <style>
                .card-stats {
                    cursor:pointer;
                }
                div.error{
                    position: relative;
                    top: -1rem;
                    left: 0rem;
                    font-size: 10px;
                    color: #FF4081;
                    -webkit-transform: translateY(0%);
                    -ms-transform: translateY(0%);
                    -o-transform: translateY(0%);
                    transform: translateY(0%);
                }
            </style>
         
            @include('_part.footer_menu')
        </div>
    @section('script')
    <script src="{{asset('/plugins/jqValidate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/plugins/jqform/jquery.form.js')}}"></script>
    <script src="{{asset('/plugins/jqDatatable/jquery-datatable.js')}}"></script>
    <script>
    var urlAjaxTable  = "{{ route('masterKampus.getkampus') }}";
    var urlUpdate  = "{{ route('masterKampus.update') }}";
    var urlDelete  = "{{ route('masterKampus.delete') }}";
    var token  = "{{ csrf_token() }}";
    var selDialog = $('#myConfirm');
    var perPage = 10;
    // jquery datatables
    var listTable = $('.listGlobal').DataTable( {
                        "processing": true,
                        "bFilter": true,
                        "bInfo": false,
                        "bLengthChange": false,
                        "serverSide": true,
                        "pageLength": perPage,
                        "ajax": {
                            "url": urlAjaxTable,
                            "type": "GET"
                        },
                        "columns": [
                            { "data": "id_kampus" },
                            { "data": "nama_kampus" },
                            { "data": "nama_kota" },
                            { "render": function (data, type, row, meta) {
                                var edit = $('<a><button>')
                                            .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                            .attr('onclick','setForm(\''+row.id_kampus+'\', \''+row.nama_kampus+'\', \''+row.id_kota+'\', \''+row.nama_kota+'\' )')
                                            .text('Edit')
                                            .wrap('<div></div>')
                                            .parent()
                                            .html();
                                var del = $('<button>')
                                            .attr('class', "btn btn-danger waves-effect delete-menu")
                                            .attr('onclick','showConfirm(\''+row.id_kampus+'\')')
                                            .text('Delete')
                                            .wrap('<div></div>')
                                            .parent()
                                            .html();
                                return edit+" | "+del;
                                }
                            },
                         ],
                         aoColumnDefs: [
                            {
                                bSortable: false,
                                aTargets: [ 3 ]
                            }
                        ]
                    });
    function setForm(id, kampus, id_kota, nama_kota) {
        var nama_kampus = $('.nama_kampus');
        var idKota = $('.id_kota');
        var buttonGlobal = $('.buttonGlobal');
        var formGlobal = $('.form-global');
        var hiddenId = $('.hiddenId');
        
        nama_kampus.parent().removeClass('is-empty');
        nama_kampus.val(kampus);
        $('.id_kota option').each(function(index, val){
            var idK = $(this).attr('value');
            if (idK == id_kota) {
                $(this).prop("selected", true);
            }
        });

        buttonGlobal.removeClass('btn-primary');
        buttonGlobal.addClass('btn-success');
        buttonGlobal.html('Update');

        formGlobal.attr('action', urlUpdate+"?id="+id);

    }
    function showConfirm(id) {
       
        var selDialogTitle = $('#myConfirmLabel');
        var selDialogBody = $('#myConfirmBody');
        var selDialogButton = $('#confirmOK');
        selDialogTitle.html('Peringatan');
        selDialogBody.html('Anda Yakin Hapus Data ini ?');
        selDialogButton.attr('onclick','deleteData(\''+id+'\')');
        selDialog.modal('show');

    }
    function deleteData(id) {
        selDialog.modal('hide');
        $.ajax({
            url: urlDelete,
            type: "post",
            data:  { id : id, _token :token } ,
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

    $('.showFilter').click(function(){
        $('#myFilterDashboard').modal('show');
    });
    // for form 
    $('.form-global').validate({
            debug: true,
            rules: {
                nama_kota: {
                    required: true,
                }
            },
            messages: {
                nama_kota: {
                    required: "Silahkan Isi Nama Kota",
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
        </script>
    @endsection
@endsection
