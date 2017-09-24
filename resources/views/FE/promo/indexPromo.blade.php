@extends('FEtemplate')
@section('content')
<div class="container">
    <div class="row">
        <div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="{{ url(route('fe.index')) }}"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li><a href="{{ url('/kampus/').'/'.$segment1.'/'.$segment2 }}">{{ $segment1}}</a></li>
				</ul>
			</div>
			
			<div class="row">
                @include('FE.slider.catalogFilter')
                <div class="col-xs-12 col-sm-8 col-md-9">
                    @include('FE.slider.listItemSlides')
                    <div class="listItems" style="min-height: 70vh;"></div>
                </div>
			</div>
		</div>
    </div>
</div>

    @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/config.css') }}" />
    @endsection

    @section('scripts')
        <script src="{{ asset('/plugins/jqValidate/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/plugins/jqform/jquery.form.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        <script src="{{ asset('/js/bootstrap-notify.js') }}"></script>
        <script>
            var urlGetItems = "{{ url('/get-items/promo/').'/'.$segment1.'/'.$segment2 }}";
            var csrf = "{{ csrf_token() }}";

            var page = "";
            $(document).ready(function(){
                var postData  = {
                    '_token' : csrf
                }
                getProd(postData);
                // for pagination
                $(document).on("click", ".pagination > li > a", function( event ){
                    var postData  = {
                        '_token' : csrf,
                        'page' : $(this).attr('data-page')
                    }
                    getProd(postData);
                });

                // order by 
                $(document).on("change", ".eventOrderBy", function( event ){
                    var postData  = {
                        '_token' : csrf,
                        'orderBY' : $(this).val()
                    }
                    getProd(postData);
                });

                $(document).on("click", ".getProdItem", function( event ){
                    var postData  = $('#filterForm').serialize()+"&_token="+csrf;
                    getProd(postData);
                });
                $(document).on("click", ".filterPrice", function( event ){
                    var postData  = $('#filterForm').serialize()+"&_token="+csrf;
                    getProd(postData);
                });
            });
            function getProd(postData) {
                $.ajax({
                        url: urlGetItems,
                        type: "post",
                        data: postData,
                        beforeSend: function() {
                            $('.listItems').append("<div class='loading'></loading>");
                        },
                        success: function(retval) {
                            $('.loading').fadeOut("slow");
                            page  = retval.page;
                            $('.listItems').html(retval.html);
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
