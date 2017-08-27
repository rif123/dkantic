@extends('index')
@section('content')
@include('_part/menuLeft')
<link href="{{asset('/plugins/boostraptoggle/bootstrap-toggle.min.css')}}" rel='stylesheet' type='text/css'></link>
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
						<div class="col-lg-8 col-md-12">
							<div class="card card-nav-tabs">
								<div class="card-header" data-background-color="purple">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<span class="nav-tabs-title">Items:</span>
											<ul class="nav nav-tabs" data-tabs="tabs">
												<li class="active">
													<a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">content_copy</i>
														List Product
													<div class="ripple-container"></div></a>
												</li>
												<li class="">
													<a href="#messages" data-toggle="tab">
                                                    <i class="material-icons">add_to_queue</i>
														Tambah Produk
													<div class="ripple-container"></div></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-content">
									<div class="tab-content">
										<div class="tab-pane active" id="profile">
                                        @include('merchant.dashboardMerchant.product.addProduct')
										</div>
										<div class="tab-pane" id="messages">
                                        @include('merchant.dashboardMerchant.product.listProduct')
                                         <button type="button" class="btn btn-primary doSaveDays">Simpan </button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Preview</h4>
	                                <p class="category">Produk</p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="card-content table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Outlate</th>
                                                    <td>{{ !empty($dataConfig['nama_outlate']) ? $dataConfig['nama_outlate'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pemilik</th>
                                                    <td>{{ !empty($dataConfig['nama_pemilik_outlate']) ? $dataConfig['nama_pemilik_outlate'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ !empty($dataConfig['alamat_outlate']) ? $dataConfig['alamat_outlate'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Hp</th>
                                                    <td>{{ !empty($dataConfig['hp_outlate']) ? $dataConfig['hp_outlate'] : '' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="card-content table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th rowspan="7">Jam Buka</th>
                                                    <th>Hari</th>
                                                    <th>Jam</th>
                                                </tr>
                                                @if(!empty($listOpenCloseToko))
                                                    @foreach($listOpenCloseToko as $k => $val)
                                                    <tr>
                                                        <td>{{$val['hari_open']}}</td>
                                                        <td>{{$val['jam_open'].":".$val['menit_open']."-".$val['jam_close'].":".$val['menit_close']}}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

	                        </div>
						</div>
					</div>
				</div>
			</div>
            @include('_part.footer_menu')
        </div>
        <style>
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
        .toggle.btn{
            min-width: 140px;
        }
        .toggle-handle {
            padding : auto;
            height:40px;
            background-color: #fff !important;
            border-color: #fff !important;
        }
        .toggle-on.btn {
            padding-right: 100px;
        }
        .toggle-off.btn {
            padding-left : 50px;
        }
        td[rowspan] {
            vertical-align: top;
            text-align: left;
        }
        </style>
  
    @section('script')

    <script src="{{asset('/plugins/jqValidate/jquery.mockjax.js')}}"></script>
    <script src="{{asset('/plugins/jqValidate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/plugins/boostraptoggle/bootstrap-toggle.min.js')}}"></script>
    <script>
    var urlGetKampus = "{{route('setting.getKampus')}}";
    var checkIdKota = "{{ !empty($dataConfig['id_kampus']) ?  $dataConfig['id_kampus'] : '' }}";
    var urlSetDays = "{{ url(route('setting.doSaveOpenClose')) }}";
    var urlUpdateOpenToko = "{{ url(route('setting.doUpdateOpenToko')) }}";
    

    // for form 
    $('.form-config').validate({
            debug: true,
            rules: {
                nama_outlate: {
                    required: true,
                },
                nama_pemilik: {
                    required: true,
                },          
                alamat_outlate: {
                    required: true,
                },
                hp_outlate: {
                    required: true,
                    number: true
                },
                id_kategori:{
                    required: true,
                },
                id_kota:{
                    required: true,
                },
                id_kampus:{
                    required: true,
                }
            },
            messages: {
                nama_outlate: {
                    required: "Silahkan Isi Nama Outlate",
                },
                nama_pemilik: {
                    required: "Silahkan Isi Nama Pemilik",
                },          
                alamat_outlate: {
                    required: "Silahkan Isi Alamat",
                },
                hp_outlate: {
                    required: "Silahkan Isi No Handphone",
                    number : "Silahkan Masukan Angka"
                },
                id_kategori: {
                    required: "Silahkan Pilih Kategori",
                },
                id_kota: {
                    required: "Silahkan Pilih Kota",
                },
                id_kampus: {
                    required: "Silahkan Pilih Kampus",
                },
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
    <script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {
          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
      });
  });
});
</script>
    @endsection
 
@endsection