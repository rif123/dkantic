@extends('index')
@section('content')
@include('_part/menuLeft')
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
						<div class="col-lg-6 col-md-12">
							<div class="card card-nav-tabs">
								<div class="card-header" data-background-color="purple">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<span class="nav-tabs-title">Tasks:</span>
											<ul class="nav nav-tabs" data-tabs="tabs">
												<li class="active">
													<a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">settings</i>
														Config
													<div class="ripple-container"></div></a>
												</li>
												<li class="">
													<a href="#messages" data-toggle="tab">
														<i class="material-icons">code</i>
														Buka/Tutup Toko
													<div class="ripple-container"></div></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-content">
									<div class="tab-content">
										<div class="tab-pane active" id="profile">
										<form class="form-config" action="{{ route('setting.doSaveConfig') }}" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <select name="id_kota" class="form-control idKota" data-error=".id_kotaTxt">
                                                            <option value=""> Pilih Kota </option>
                                                            @foreach($listKota as $key => $val)
                                                                @php $checked = "";  @endphp
                                                                    @if(!empty($dataConfig['nama_outlate']))
                                                                        @if($dataConfig['id_kota'] == $val['id_kota'])
                                                                            @php  $checked = "selected='selected'"  @endphp
                                                                        @endif
                                                                    @endif
                                                                <option  {{$checked}} value="{{$val['id_kota']}}">{{$val['nama_kota']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="id_kotaTxt"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <select name="id_kampus" class="form-control id_kampus" data-error=".id_kampusTxt">
                                                            <option value=""> Pilih Kampus </option>
                                                        </select>
                                                        <div class="id_kampusTxt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <select name="id_kategori" class="form-control" data-error=".id_kategoriTxt">
                                                            <option value=""> Pilih Kategori </option>
                                                            @foreach($listKategori as $key => $val)
                                                                @php $checked = "";  @endphp
                                                                    @if(!empty($dataConfig['nama_outlate']))
                                                                        @if($dataConfig['id_kategori'] == $val['id_kategori'])
                                                                            @php  $checked = "selected='selected'"  @endphp
                                                                        @endif
                                                                    @endif
                                                                <option  {{$checked}} value="{{$val['id_kategori']}}"> {{$val['nama_kategori']}} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="id_kategoriTxt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nama Outlate</label>
                                                        <input type="text" class="form-control" name="nama_outlate" value="{{ !empty($dataConfig['nama_outlate']) ? $dataConfig['nama_outlate'] : '' }}" data-error=".nama_outlateTxt">
                                                        <div class="nama_outlateTxt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nama Pemilik</label>
                                                        <input type="text" class="form-control" name="nama_pemilik"  data-error=".nama_pemilikTxt" value="{{ !empty($dataConfig['nama_pemilik_outlate']) ? $dataConfig['nama_pemilik_outlate'] : '' }}" >
                                                        <div class="nama_pemilikTxt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Alamat Outlate</label>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Masukan Alamat Outlate lengkat d& detail </label>
                                                        <textarea class="form-control" rows="5" name="alamat_outlate" data-error=".alamat_outlateTxt">{{ !empty($dataConfig['alamat_outlate']) ? $dataConfig['alamat_outlate'] : '' }}</textarea>
                                                        <div class="alamat_outlateTxt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">No Hp (Handphone)</label>
                                                        <input type="text" class="form-control" name="hp_outlate" data-error=".hp_outlateTxt" value="{{ !empty($dataConfig['hp_outlate']) ? $dataConfig['hp_outlate'] : '' }}">
                                                        <div class="hp_outlateTxt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                            <div class="clearfix"></div>
                                        </form>
										</div>
										<div class="tab-pane" id="messages">
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-lg-6 col-md-12">
							<div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Preview</h4>
	                                <p class="category">Toko</p>
	                            </div>
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
        </style>
    @section('script')
    <script src="{{asset('/plugins/jqValidate/jquery.mockjax.js')}}"></script>
    <script src="{{asset('/plugins/jqValidate/jquery.validate.min.js')}}"></script>
    <script>
    var urlGetKampus = "{{route('setting.getKampus')}}";
    var checkIdKota = "{{ !empty($dataConfig['id_kampus']) ?  $dataConfig['id_kampus'] : '' }}";
    
    // check id kota
    if (checkIdKota != ""){
        var id_kota = checkIdKota;
        getKampus(urlGetKampus, id_kota);
    }
    // for event get kampus
    var eventKota = $('.idKota').change(function(){
        var id_kota = $(this).val();
        getKampus(urlGetKampus, id_kota);
    });

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
    function getKampus(urlGetKampus, id_kota){
        $.ajax({
            url: urlGetKampus,
            type: "POST",
            dataType: 'json',
            data: {id_kota : id_kota, '_token' : $('meta[name="csrf-token"]').attr('content') },
            success: function(retval) {
                var $selKampus = $(".id_kampus");
                if (id_kota != ""){
                    if (retval.status){
                        $selKampus.empty(); 
                        $.each(retval.data, function(key,value) {
                        $selKampus.append($("<option></option>")
                            .attr("value", value.id_kampus).text(value.nama_kampus));
                        });
                    } else {
                        $selKampus.empty(); 
                        $selKampus.append($("<option></option>")
                            .attr("value", "").text("Pilih Kampus"));
                        custom.showNotif('top','center', 4, retval.message);
                    }
                } else {
                    $selKampus.empty(); 
                        $selKampus.append($("<option></option>")
                            .attr("value", "").text("Pilih Kampus"));
                }   
            }    
        });
    }
    </script>
    @endsection
 
@endsection