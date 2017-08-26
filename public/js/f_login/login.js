$('.doLogin').click(function(){
    var data  = $('#formLogin').serialize();
    $.ajax({
        type: "POST",
        dataType : 'json', 
        data : data,
        url: urlLogin,
        success: function (data) {
            if(data.status) {
                custom.showNotif('top','center', 1, data.message);
                setTimeout(function(){ 
                    window.location  = data.redirect
                }, 3000);
            } else {
                custom.showNotif('top','center', 4, data.message)
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