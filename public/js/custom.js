type = ['','info','success','warning','danger'];
custom = {
    showNotif: function(from, align, color, message){
            // color = Math.floor((Math.random() * 4) + 1);
    	$.notify({
        	icon: "notifications",
        	message: message,

        },{
            type: type[color],
            timer: 1000,
            placement: {
                from: from,
                align: align
            }
        });
	}
}