$(document).ready(function(){
    $('.price-status').change(function(){
		$(this).prop('disabled', true);
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