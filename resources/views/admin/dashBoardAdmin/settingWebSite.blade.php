@extends('index')
@section('content')
@include('_part/menuLeftAdmin')
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
														Under Development
													<div class="ripple-container"></div></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-content">
									<div class="tab-content">
										<div class="tab-pane active" id="profile">
                                            @include('admin.dashBoardAdmin.settingWebSite.config')
										</div>
										<div class="tab-pane" id="messages">
                                            - 
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Preview</h4>
	                                <p class="category">Config</p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="card-content table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>#</th>
                                                </tr>
                                                <tr>
                                                    <td>Logo</td>
                                                    <td><img  src="{{ !empty($dataConfig['logo_config']) ? asset('/imageConfig').'/'.$dataConfig['logo_config'] : '' }}" style="width: 50px;"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Copy Right</td>
                                                    <td>{{ !empty($dataConfig['copy_right']) ? $dataConfig['copy_right'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Telepon</td>
                                                    <td>{{ !empty($dataConfig['telp_config']) ? $dataConfig['telp_config'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Favicon</td>
                                                    <td><img  src="{{ !empty($dataConfig['favicon_config']) ? asset('/imageConfig').'/'.$dataConfig['favicon_config'] : '' }}" style="width: 50px;"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Facebook</td>
                                                    <td>{{ !empty($dataConfig['fb_config']) ? $dataConfig['fb_config'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Facebook Icon</td>
                                                    <td><img  src="{{ !empty($dataConfig['logo_fb_config']) ? asset('/imageConfig').'/'.$dataConfig['logo_fb_config'] : '' }}" style="width: 50px;"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Twiiter</td>
                                                    <td>{{ !empty($dataConfig['twit_config']) ? $dataConfig['twit_config'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Twiiter Icon</td>
                                                    <td><img  src="{{ !empty($dataConfig['logo_twit_config']) ? asset('/imageConfig').'/'.$dataConfig['logo_twit_config'] : '' }}" style="width: 50px;"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Google + </td>
                                                    <td>{{ !empty($dataConfig['twit_config']) ? $dataConfig['twit_config'] : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Google +  Icon</td>
                                                    <td><img  src="{{ !empty($dataConfig['logo_gp_config']) ? asset('/imageConfig').'/'.$dataConfig['logo_gp_config'] : '' }}" style="width: 50px;"/></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="card-content table-responsive">
                                       
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
    <script src="{{asset('/plugins/jqform/jquery.form.js')}}"></script>
   
    
    
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
    $('.form-config-website').validate({
            debug: true,
            rules: {
                telp_config: {
                    required: true,
                    number: true
                },
                favicon_config: {
                    required: true,
                }
            },
            messages: {
                telp_config: {
                    required: "Silahkan Isi No telepon",
                    number : "Silahkan Masukan Angka"
                },
                favicon_config: {
                    required: "Silahkan Isi Favicon",
                },          
                fb_config: {
                    required: "Silahkan Isi Facebook",
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
        // for add file on product
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
    @endsection
 
@endsection