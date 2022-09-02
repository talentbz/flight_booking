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
// console.log(yourArray)
// $("input:checkbox:checked").each(function(){
//     yourArray.push($(this).val());
// });