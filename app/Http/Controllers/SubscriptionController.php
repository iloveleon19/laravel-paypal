<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal\PaypalAgreement;
use App\Paypal\SubscriptionPlan;

class SubscriptionController extends Controller
{
    public function createPlan()
    {
        $plan = new SubscriptionPlan();
        $plan->create();
    }

    public function listPlan()
    {
        $plan = new SubscriptionPlan();
        return $plan->listPlan();
    }

    public function showPlan($id)
    {
        $plan = new SubscriptionPlan();
        return $plan->planDetails($id);
    }

    public function activatePlan($id)
    {
        $plan = new SubscriptionPlan();
        return $plan->activate($id);
    }

    public function createAgreement($id)
    {
        $agreement = new PaypalAgreement();
        return  $agreement->create($id);
    }

    public function executeAgreement($status)
    {
        if ($status==='true') {
            $agreement = new PaypalAgreement();
            $agreement->execute(request('token'));
            return 'done';
        }
    }
}
