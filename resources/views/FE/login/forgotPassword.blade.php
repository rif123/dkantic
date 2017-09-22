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
                <li>Login</li>
            </ul>
        </div>
        <div class="main-page">
            <h1 class="page-title">Login Dkantin</h1>
            <div class="page-content">
                <div class="row">
                        <div class="col-sm-6">
                            <div class="box-border">
                                <h4>Silahkan Masukan Email </h4>
                                <form action="{{url(route('user.doForgotPassword'))}}" method="post" id="loginForgot">
                                    <p>
                                        <label>Email address</label>
                                        <input type="text" name="email_customer" autocomplete="off" data-error=".email_customerTxt" autocomplete="off">
                                        <div class="email_customerTxt"></div>
                                    </p>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button" type="submit"><i class="fa fa-lock"></i>Reset Password </button>
                                    </p>
                                </form>
                            </div>
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
            $('#loginForgot').validate({
            debug: true,
            rules: {
                email_customer: {
                    required: true,
                },
                pass_customer: {
                    required: true,
                }
            },
            messages: {
                email_customer: {
                    required: "Silahkan Isi Email",
                },
                pass_customer: {
                    required: "Silahkan Isi Password",
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
