$(document).ready(function () {
    var shedule_id, seat =[], price_array = [];
    $('.trip_type').hide();
    emptySection();
    // get schedule id after selected option
    $(".booking_schedule").on("change", function (e) { 
        shedule_id = $(this).find(":selected").val()
    })

    $(document).on('change', ':checkbox', function(){
        seat_no = $(this).attr('id')
        seat_price = $(this).val()
        if($(this).filter(':checked').prop('checked') == true){
            seat.push(seat_no);
            price_array.push(seat_price)
        } else {
            seat.splice($.inArray(seat_no, seat), 1);
            price_array.splice($.inArray(seat_price, price_array), 1)
        }
        
        var total_price = price_array.reduce(function(a, b){
            return parseInt(a, 10) + parseInt(b, 10);
        }, 0);

        if($(".trip_type_value").val() == "inRound") {
            $("input[name='in_round[]']").val(seat);
        } else {
            $("input[name='out_round[]']").val(seat);
        }
        $("input[name='total_price']").val(total_price);
    })

    //get shcedule data
    $(".airline").on("change", function (e) { 
        airline_id = $(this).find(":selected").val()
        $('.trip_type').hide();
        emptySection();
        if(airline_id) {
            $.ajax({
                url: schedule,
                method: 'get',
                data: {airline_id: airline_id},
                success: function (res) {
                    data = res.data 
                    //display Booking schedule 
                    $('.booking_schedule').empty();
                    $('.booking_schedule').append('<option value="">'+'Select'+'</option>');
                    if(data.length > 0){
                        for(i=0; i<data.length; i++){
                            $('.booking_schedule').append('<option value="'+data[i].id+'">'+data[i].departure_date+ ' ~ ' + data[i].return_date +'</option>');
                        }
                    }

                },
                error: function (res){
                    console.log(res)
                },
            })
        }
    })
    $(".booking_schedule").on("change", function (e) { 
        $('.trip_type').hide();
        emptySection();
        if($(this).find(":selected").val()){
            $('.trip_type').show();
        }
    })
    $("select[name='trip_type']").on('change', function(e){
        trip_type = $(this).find(":selected").val()
        emptySection();
        if(trip_type == 1){
            emptySection();
            $(".in_round").append(in_round_html)
            $(".out_round").append(out_round_html)
        } else if(trip_type == 2){
            emptySection();
            $(".in_round").append(in_round_html)
        } else if(trip_type == 3) {
            emptySection();
            $(".out_round").append(out_round_html)
        } else {
            emptySection();
        }
    })
    in_round_html = '<div class="mb-3">' +
                        '<label class="form-label">InRound</label>' +
                        '<a href="javascript:void(0)" class="inround_seat_map">view seat map</a>' +
                        '<input type="text" class="form-control" name="in_round[]" readonly required>' +
                    '</div>'
    out_round_html = '<div class="mb-3">' +
                        '<label class="form-label">InRound</label>' +
                        '<a href="javascript:void(0)" class="outround_seat_map">view seat map</a>' +
                        '<input type="text" class="form-control" name="out_round[]" readonly required>' +
                    '</div>'

    $(document).on('click', '.inround_seat_map', function(e){
        getSeatMap(shedule_id, 'inRound')
    })

    $(document).on('click', '.outround_seat_map', function(e){
        getSeatMap(shedule_id, 'outRound')
    })
    function getSeatMap(shedule_id, trip_type) {
        $.ajax({
            url: seat_map,
            method: 'get',
            data: {shedule_id: shedule_id, trip_type : trip_type},
            success: function (res) {
                $('.seat_map_layout').html(res);
            },
            error: function (res){
                console.log(res)
            },
        })
    }

    function emptySection(){
        $(".out_round").empty()
        $(".in_round").empty()
        $('.seat_map_layout').empty();
    }
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
})