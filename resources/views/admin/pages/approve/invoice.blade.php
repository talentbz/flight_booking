<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ URL::asset('/assets/admin/pages/approve/pdf.css') }}"> -->
    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 500px;
            background: #fff;
        }
        #invoice-POS ::selection {
            background: #f31544;
            color: #fff;
        }
        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #fff;
        }
        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }
        #invoice-POS h2 {
            font-size: 0.9em;
        }
        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        #invoice-POS p {
            font-size: 0.7em;
            color: #666;
            line-height: 1.2em;
        }
        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
        /* Targets all id with 'col-' */
            border-bottom: 1px solid #eee;
        }
        #invoice-POS #top {
            min-height: 100px;
        }
        #invoice-POS #mid {
            min-height: 80px;
        }
        #invoice-POS #bot {
            min-height: 50px;
        }
        #invoice-POS #top .logo {
            
        }
        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }
        #invoice-POS .title {
            float: right;
        }
        #invoice-POS .title p {
            text-align: right;
        }
        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }
        #invoice-POS .tabletitle {
            font-size: 0.5em;
            background: #eee;
        }
        #invoice-POS .service {
            border-bottom: 1px solid #eee;
        }
        #invoice-POS .item {
            width: 24mm;
        }
        #invoice-POS .itemtext {
            font-size: 0.5em;
        }
        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

    </style>
    <title>Document</title>
</head>
<body>
    
  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo">
        <img src="{{public_path().'/images/admin/logo.png'}}" alt="" width="50">
      </div>
      <div class="info"> 
        <h2>SBISTechs Inc</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : street city, state 0000</br>
            Email   : sales@numerounconsultancy.com</br>
            Phone   : 555-555-5555</br>
            Agent No   : {{$user_id}}</br>
            Agent Name   : {{$user_name}}</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">
        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item"><h2>Item</h2></td>
                    <td class="Hours"><h2>Qty</h2></td>
                    <td class="Rate"><h2>Sub Total</h2></td>
                    <td class="Rate"><h2>Description</h2></td>
                </tr>

                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Bussiness Seat</p></td>
                    <td class="tableitem"><p class="itemtext">{{$bussiness_seat_count}}</p></td>
                    <td class="tableitem"><p class="itemtext">${{$bussiness_seat_price}}</p></td>
                    <td class="tableitem"><p class="itemtext">6G, 7G</p></td>
                </tr>

                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Economy Seat</p></td>
                    <td class="tableitem"><p class="itemtext">{{$economy_seat_count}}</p></td>
                    <td class="tableitem"><p class="itemtext">${{$economy_seat_price}}</p></td>
                    <td class="tableitem"><p class="itemtext">6G, 7G</p></td>
                </tr>

                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Extra Baggage</p></td>
                    <td class="tableitem"><p class="itemtext">{{$extra_bag}}</p></td>
                    <td class="tableitem"><p class="itemtext">5</p></td>
                    <td class="tableitem"></td>
                </tr>

                <tr class="tabletitle">
                    <td class="Rate"><h2>Total</h2></td>
                    <td></td>
                    <td class="payment"><h2>${{$total_cost}}</h2></td>
                    <td></td>
                </tr>

            </table>
        </div><!--End Table-->

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</body>
</html>