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
                    $('#editModal').modal('hide');
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

    $('table').on('click', '.edit',function (e) {
        var tr = e.target.parentNode.parentNode;
        var id =  $(this).attr('data-id')
        var name = tr.cells[1].textContent;
        var percentage = tr.cells[2].textContent;
        $('input[name="id"]').val(id)
        $('#price-name').val(name);
        $('#percentage').val(percentage);
    })
});