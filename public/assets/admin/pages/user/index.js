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
                if(res.error){
                    for(i=0; i<res.error.length; i++){
                        toastr["error"](res.error[i]);
                    }
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

    $("#wizard-picture").change(function(){
        readURL(this);
    });
    
    $('#rest-form').submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: reset_password,
            method: 'post',
            data: $(this).serialize(),
            success: function (res) {
                if(res.result == "success" ){
                    toastr["success"]("Success!!!");
                    $('#myModal').modal('hide');
                }
            },
            error: function (errors){
                toastr["warning"](errors);
            },
            cache: false,
            // contentType: false,
            processData: false
            })
        })
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}