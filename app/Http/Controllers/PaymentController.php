<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal\CreatePayment;
use App\Paypal\ExecutePayment;

class PaymentController extends Controller
{
    public function create()
    {
        $payment = new createPayment;
        return $payment->create();
    }

    public function execute()
    {
        $payment = new ExecutePayment;
        return $payment->execute();
    }
}
