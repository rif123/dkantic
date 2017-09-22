@extends('FEtemplate')
@section('content')
<div class="container">
    <div class="row">
        <div class="block block-breadcrumbs">
            <ul>
                <li class="home">
                    <a href="#"><i class="fa fa-home"></i></a>
                    <span></span>
                </li>
                <li>Profile</li>
            </ul>
        </div>
        <div class="main-page">
            <h1 class="page-title">Profile</h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-6">
                    <div class="box-border">
                        <h4>Profile</h4>
                        <small>Silahkan isi data diri untuk memudahkan informasi</small>
                        <form action="{{ url(route('user.doUpdateProfile')) }}" method="post" id="formGLobal" >
                            <p>
                                <label>Nama</label>
                                <input type="text" name="nama_customer" value="{{ $data['nama_customer'] }}" class="nama_customer"  data-error=".nama_customerTxt">
                                <div class="nama_customerTxt"></div>
                            </p>

                            <p>
                                <label>Alamat</label>
                                <textarea name="alamat_customer" class="alamat_customer" data-error=".alamat_customerTxt">{{ $data['alamat_customer'] }} </textarea>
                                <div class="alamat_customerTxt"></div>
                            </p>

                            <p>
                                <label>Email</label>
                                <input name="email_customer" type="text" class="email_customer" value="{{  $data['email_customer']  }}" data-error=".email_customerTxt" />
                                <div class="email_customerTxt"></div>
                            </p>
                            
                            <p>
                                <label>Hp</label>
                                <input name="hp_customer" type="text" class="hp_customer" value="{{  $data['hp_customer']  }}"  data-error=".hp_customerTxt" />
                                <div class="hp_customerTxt"></div>
                            </p>

                            <p>
                                <label>Old Password</label>
                                <input name="old_pass_customer" type="password" value=""  data-error=".old_pass_customerTxt" />
                                <div class="old_pass_customerTxt"></div>
                            </p>

                            <p>
                                <label>New Password</label>
                                <input type="password" name="pass_customer" autocomplete="off" data-error=".pass_customerTxt">
                                <div class="pass_customerTxt"></div>
                            </p>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-user"></i> Rubah Akun
                                </button>
                            </p>
                        </form>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- content left profile -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @section('styles')
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
    @endsection

    @section('scripts')
        <script src="{{ asset('/plugins/jqValidate/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/plugins/jqform/jquery.form.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
	    <script src="{{ asset('/js/bootstrap-notify.js') }}"></script>
        <script>
            $('#formGLobal').validate({
            debug: true,
            rules: {
                nama_customer: {
                    required: true,
                },
                alamat_customer: {
                    required: true,
                },
                email_customer: {
                    required: true,
                    email: true
                },
                hp_customer: {
                    required: true,
                    number: true
                },
                pass_customer: {
                    required: true
                },
                old_pass_customer: {
                    required: true
                }
            },
            messages: {
                nama_customer: {
                    required: "Silahkan Isi Nama Customer",
                },
                alamat_customer: {
                    required: "Silahkan Isi Alamat",
                },
                email_customer: {
                    required: "Silahkan Isi Email",
                    email: "Format Email salah",
                },
                hp_customer: {
                    required: "Silahkan Isi No HP",
                    number: "Format Harus Angka",
                },
                pass_customer: {
                    required: "Silahkan Isi Password"
                },
                old_pass_customer: {
                    required: "Silahkan Isi Password"
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

        $('#login').validate({
            debug: true,
            rules: {
                nama_customer: {
                    required: true,
                },
                password: {
                    required: true,
                }

            },
            messages: {
                nama_customer: {
                    required: "Silahkan Isi Nama Customer",
                },
                password: {
                    required: "Silahkan Isi Password"
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
