$(document).ready(function(){
    $('#custom-form').submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: store,
            method: 'post',
            data: formData,
            success: function (res) {
                if(res.result == "success" ){
                    toastr["success"]("Success!!!");
                    setInterval(function(){ 
                        location.href = list_url; 
                    }, 2000);
                } 
            },
            error: function (errors){
                toastr["warning"](errors);
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })

    $('.price-status').change(function(){
    	var status= $(this).prop('checked');
    	var id=$(this).val();
    	$.ajax({
    		type:'GET',
    		dataType:'JSON',
    		url:status_change,
          	data:{status:status, id:id},
          	success:function(res){
                if(res.result == "success" ){
                    toastr["success"]("Success!!!");
                }
	        }
    	})
    })
});