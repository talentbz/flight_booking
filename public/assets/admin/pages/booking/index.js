$(document).ready(function () {
    seat =[];
    price_array = [];
    $('input:checkbox').on('change', function(){
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
        $("input[name='seat_no[]']").val(seat);
        $("input[name='total_price']").val(total_price);
        $("input[name='guest']").val(seat.length);

    })

    //get shcedule data
    $(".airline").on("change", function (e) { 
        airline_id = $(this).find(":selected").val()
        if(airline_id) {
            $.ajax({
                url: schedule,
                method: 'get',
                data: {airline_id: airline_id},
                success: function (res) {
                    data = res.data 
                    console.log(data)
                    $('.booking_schedule').empty();
                    if(data.length > 0){
                        for(i=0; i<data.length; i++){
                            console.log(data[i])
                            $('.booking_schedule').append('<option value="">'+'Select'+'</option>');
                            $('.booking_schedule').append('<option value="'+data[i].id+'">'+data[i].departure_date+ ' ~ ' + data[i].return_date +'</option>');
                        }
                    } else {
                        $('.booking_schedule').append('<option value="">'+'Select'+'</option>');
                    }

                },
                error: function (res){
                    console.log(res)
                },
            })
        }
    })

    // triger booking schedule
    $(".trip_type").hide();
    $(".seat_section").hide();
    $(".booking_schedule").on("change", function (e) { 
        var schedule_val = $(this).find(":selected").val()
        if(schedule_val) {
            $(".trip_type").show();
            $(".trip_type select").on("change", function (e){
                if($(this).find(":selected").val()){
                    $(".seat_section").show();
                } else {
                    $(".seat_section").hide();
                }
            })
        } else {
            $(".trip_type").hide();
        }
    })

    $('.start_seat_map').on('click', function(e){
        getSeatMap('start')
    })

    function getSeatMap(date_type) {
        $.ajax({
            url: seat_map,
            method: 'get',
            data: {shedule_id: 1, date_type :  date_type},
            success: function (res) {
                
            },
            error: function (res){
                console.log(res)
            },
        })
    }
})