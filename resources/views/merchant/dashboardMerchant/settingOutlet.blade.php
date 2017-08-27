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
                                        <form class="form-config-days" action="{{ route('setting.doSaveConfig') }}" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="allDays" class="allDays"> 
                                                            Buka Setiap Hari
                                                        </label>
                                                     </div>
                                                     @php 
                                                        $listDays = get_list_days();  
                                                        $jamOpenCLose = !empty($listOpenCloseToko[0]) ? $listOpenCloseToko[0]['jam_open'] : "";
                                                        $menitOpenCLose = !empty($listOpenCloseToko[0]) ? $listOpenCloseToko[0]['menit_open'] : "";
                                                        $jamCLose = !empty($listOpenCloseToko[0]) ? $listOpenCloseToko[0]['jam_close'] : "";
                                                        $menitCLose = !empty($listOpenCloseToko[0]) ? $listOpenCloseToko[0]['menit_open'] : "";
                                                     @endphp
                                                     
                                                     @foreach($listDays as $key => $val)
                                                        @php $checked = ""  @endphp
                                                        @foreach($listOpenCloseToko as $k => $v)
                                                            @if(strtolower($val) == strtolower($v['hari_open']))
                                                                @php $checked = "checked"  @endphp
                                                            @endif
                                                        @endforeach
                                                     <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="optionsCheckboxes[]" value="{{$val}}" class="openDay" {{$checked}}> 
                                                        </label>
                                                        {{$val}}
                                                     </div>
                                                     @endforeach
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <div class="col-md-2">
                                                            <select name="open_jam_toko" class="form-control">
                                                                <option value=""> JAM</option>
                                                                @php
                                                                    $x = 1; 
                                                                    while($x <= 24) {
                                                                        $n = $x;
                                                                        if (strlen($n) <= 1){
                                                                            $n = '0'.$x;
                                                                        }
                                                                        $selected = "";
                                                                        if(!empty($jamOpenCLose)) {
                                                                            if ($jamOpenCLose == $n) {
                                                                                $selected = "selected='selected'";
                                                                            }
                                                                        }
                                                                        echo "<option ".$selected."  value='".$n."' >".$n."</option>";
                                                                        $x++;
                                                                    } 
                                                                @endphp
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select name="open_menit_toko" class="form-control">
                                                                <option value=""> Menit </option>
                                                                @php
                                                                    $x = 1; 
                                                                    while($x <= 59) {  
                                                                        $num = $x;
                                                                        if (strlen($num) <= 1){
                                                                            $num = '0'.$x;
                                                                        }
                                                                        $selected = "";
                                                                        if(!empty($menitOpenCLose)) {
                                                                            if ($menitOpenCLose == $num) {
                                                                                $selected = "selected='selected'";
                                                                            }
                                                                        }
                                                                        echo "<option  ".$selected."  value='".$num."' >".$num."</option>";
                                                                        $x++;
                                                                    } 
                                                                @endphp
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            S/d
                                                        </div>
                                                        <div class="col-md-2">
                                                         
                                                            <select name="close_jam_toko" class="form-control">
                                                                <option value=""> JAM</option>
                                                                @php
                                                                    $x = 1; 
                                                                    while($x <= 24) {
                                                                        $n = $x;
                                                                        if (strlen($n) <= 1){
                                                                            $n = '0'.$x;
                                                                        }
                                                                        $selected = "";
                                                                        if(!empty($jamCLose)) {
                                                                            if ($jamCLose == $n) {
                                                                                $selected = "selected='selected'";
                                                                            }
                                                                        }
                                                                        echo "<option  ".$selected." value='".$n."' >".$n."</option>";
                                                                        $x++;
                                                                    } 
                                                                @endphp
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select name="close_menit_toko" class="form-control">
                                                                <option value=""> Menit </option>
                                                                @php
                                                                    $x = 1; 
                                                                    while($x <= 59) {  
                                                                        $num = $x;
                                                                        if (strlen($num) <= 1){
                                                                            $num = '0'.$x;
                                                                        }
                                                                        $selected = "";
                                                                        if(!empty($menitCLose)) {
                                                                            if ($menitCLose == $num) {
                                                                                $selected = "selected='selected'";
                                                                            }
                                                                        }

                                                                        echo "<option ".$selected." value='".$num."' >".$num."</option>";
                                                                        $x++;
                                                                    } 
                                                                @endphp
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    @php 
                                                        $checked = "";
                                                        if(!empty($dataConfig['status_open_outlate'])) {
                                                            if($dataConfig['status_open_outlate'] == 1) {
                                                                $checked  = "checked";
                                                            }
                                                        }
                                                    @endphp
                                                    <input id="toggle-one" {{$checked}}  type="checkbox" data-on="Buka Toko" data-off="Tutup Toko" data-toggle="toggle" >
                                                </div>
                                            </div>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                        </form>
                                        <button type="button" class="btn btn-primary doSaveDays">Simpan </button>
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
    
    // check id kota
    if (checkIdKota != ""){
        var id_kota = checkIdKota;
        getKampus(urlGetKampus, id_kota);
    }

    // for toggle 
    $(function() {
        $('#toggle-one').change(function() {
           if($(this).prop('checked')) {
            updateToko(1);
           } else {
            updateToko(2); 
           }
        })
    })

    // for event get kampus
    var eventKota = $('.idKota').change(function(){
        var id_kota = $(this).val();
        getKampus(urlGetKampus, id_kota);
    });
    // for event select days
    $('.allDays').change(function() {
        if (this.checked) {
            $('.openDay').prop('checked', true);
        } else {
            $('.openDay').prop('checked', false);
        } 
    });
    $('.doSaveDays').click(function(){
        var formDyas  = $('.form-config-days');
        $.ajax({
            url: urlSetDays,
            type: 'post',
            data: formDyas.serialize(),
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
    function updateToko(status){
        $.ajax({
            url: urlUpdateOpenToko,
            type: "POST",
            dataType: 'json',
            data: {status_open_outlate : status, '_token' : $('meta[name="csrf-token"]').attr('content') },
            success: function(retval) {
                if (retval.status) {
                    custom.showNotif('top', 'center', 1, retval.message);
                } else {
                    custom.showNotif('top', 'center', 4, retval.message);
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
    @endsection
 
@endsection