$(document).ready(function () {
    var shedule_id, seat =[], price_array = [], total_price = 0, in_bound_price=0, out_bound_price=0;
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
        total_price_test = price_array.reduce(function(a, b){
            return parseFloat(a, 10) + parseFloat(b, 10);
        }, 0);


        if($(".trip_type_value").val() == "inBound") {
            $("input[name='in_bound']").val(seat);
            in_bound_price = total_price_test;
            //set inbound bussiness seat and economy price in hidden input
            $("input[name='inbound_bussiness_seat']").val($('.bussiness_price').val())
            $("input[name='inbound_economy_seat']").val($('.economy_price').val())
        } else {
            $("input[name='out_bound']").val(seat);
            out_bound_price = total_price_test
            //set outbound bussiness seat and economy price in hidden input
            $("input[name='outbound_bussiness_seat']").val($('.bussiness_price').val())
            $("input[name='outbound_economy_seat']").val($('.economy_price').val())
        }
        total_price = in_bound_price + out_bound_price
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
        } else {
            $('.booking_schedule').empty();
        }
    })
    $(".booking_schedule").on("change", function (e) { 
        $('.trip_type').hide();
        emptySection();
        $("select[name='trip_type']").val('')
        if($(this).find(":selected").val()){
            $('.trip_type').show();
        }
    })
    $("select[name='trip_type']").on('change', function(e){
        trip_type = $(this).find(":selected").val()
        emptySection();
        if(trip_type == 1){
            emptySection();
            $(".in_bound").append(in_bound_html)
            $(".out_bound").append(out_bound_html)
        } else if(trip_type == 2){
            emptySection();
            $(".out_bound").append(out_bound_html)
        } else if(trip_type == 3) {
            emptySection();
            $(".in_bound").append(in_bound_html)
        } else {
            emptySection();
        }
    })
    in_bound_html = '<div class="mb-3">' +
                        '<label class="form-label">InBound</label>' +
                        '<a href="javascript:void(0)" class="inbound_seat_map">view seat map</a>' +
                        '<input type="text" class="form-control" name="in_bound" readonly required>' +
                    '</div>'
    out_bound_html = '<div class="mb-3">' +
                        '<label class="form-label">OutBound</label>' +
                        '<a href="javascript:void(0)" class="outbound_seat_map">view seat map</a>' +
                        '<input type="text" class="form-control" name="out_bound" readonly required>' +
                    '</div>'

    $(document).on('click', '.outbound_seat_map', function(e){
        seat =[];
        price_array = [];
        out_bound_price = 0;
        $('input[name="extra_bag"]').val('');
        $("input[name='out_bound']").val('');
        $("input[name='total_price']").val(in_bound_price + out_bound_price);
        getSeatMap(shedule_id, 'outBound')
    })
    $(document).on('click', '.inbound_seat_map', function(e){
        seat =[];
        price_array = [];
        in_bound_price = 0;
        $('input[name="extra_bag"]').val('');
        $("input[name='in_bound']").val('');
        $("input[name='total_price']").val(in_bound_price + out_bound_price);
        getSeatMap(shedule_id, 'inBound')
    })
    //get baggage price
    $(".bag_number" ).change(function() {
        bag_number = $(".bag_number").val() 
        if(!bag_number){
            bag_number = 0
        }
        add_baggage = parseInt(bag_number) * parseInt($(".bag_value").val())
        
        $("input[name='total_price']").val(add_baggage + total_price);
        
    });

    //aprove_button pr save_button check
    $('.aprove_button').hide()
    $("select[name='payment_method']").on('change', function(e){
        payment_method = $(this).find(":selected").val()
        if(payment_method == 3){
            $('.aprove_button').show()
            $('.save_button').hide()
        } else {
            $('.aprove_button').hide()
            $('.save_button').show()
        }
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
        $(".out_bound").empty()
        $(".in_bound").empty()
        $('.seat_map_layout').empty();
        $('input[name="total_price"]').val('');
        seat =[];
        price_array = [];
        out_bound_price = 0;
        in_bound_price = 0;
        total_price = 0;
        $('input[name="extra_bag"]').val('');
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
        var payment_method = $('select[name="payment_method"]').find(":selected").val()

        // if payment method is cash, then store data to aprove table,
        // else store to booking table
        if(payment_method == 3 && $('.save_button').is(":visible")) {
            $.ajax({
                url: booking_store,
                method: 'post',
                data: formData,
                success: function (res) {
                    if(res.result == "exist" ){
                        toastr["error"]("There are exsing seat no. Please refresh seat map!");
                    }
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
        } else if (payment_method == 3){
            $.ajax({
                url: aprove_store,
                method: 'post',
                data: formData,
                success: function (res) {
                    if(res.result == "exist" ){
                        toastr["error"]("There are exsing seat no. Please refresh seat map!");
                    }
                    if(res.result == "success" ){
                        toastr["success"]("Success!!!");
                        $('.aprove_button').hide()
                        $('.save_button').show()
                    }
                    
                },
                error: function (errors){
                    toastr["warning"](errors);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        } 
        else {
            $.ajax({
                url: booking_store,
                method: 'post',
                data: formData,
                success: function (res) {
                    if(res.result == "exist" ){
                        toastr["error"]("There are exsing seat no. Please refresh seat map!");
                    }
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
        }
    })
})