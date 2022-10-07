<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaystackController extends Controller
{
    public function redirectToGateway()
    {
        try{
            $data = array(
                "amount" => 700 * 100,
                "reference" => Paystack::genTranxRef(),
                "email" => 'vadim.progdev@gmail.com',
                "currency" => "NGN",
                "orderID" => 23456,
            );
            dd(Paystack::getAuthorizationUrl());
            return Paystack::getAuthorizationUrl($data)->redirectNow();
            // return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
