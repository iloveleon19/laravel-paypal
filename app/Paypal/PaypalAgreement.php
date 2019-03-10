<?php
namespace App\Paypal;

use PayPal\Api\Plan;
use PayPal\Api\Payer;
use PayPal\Api\Agreement;
use PayPal\Api\ShippingAddress;

class PaypalAgreement extends Paypal
{
    public function create($id)
    {
        /* Create a new instance of Agreement object
        {
            "name": "Base Agreement",
            "description": "Basic agreement",
            "start_date": "2015-06-17T9:45:04Z",
            "plan": {
            "id": "P-1WJ68935LL406420PUTENA2I"
            },
            "payer": {
            "payment_method": "paypal"
            },
            "shipping_address": {
                "line1": "111 First Street",
                "city": "Saratoga",
                "state": "CA",
                "postal_code": "95070",
                "country_code": "US"
            }
        }*/

        return redirect($this->agreement($id));
    }

    /**
     * @param String $id
     * @return String
     */
    protected function agreement(String $id): String
    {
        $agreement = new Agreement();
        $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate('2019-06-17T9:45:04Z');

        $agreement->setPlan($this->plan($id));

        $agreement->setPayer($this->payer());

        $agreement->setShippingAddress($this->shippingAddress());

        $agreement = $agreement->create($this->apiContext);

        return $agreement->getApprovalLink();
    }

    /**
     * @param String $id
     * @return Plan
     */
    protected function plan(String $id): Plan
    {
        $plan = new Plan();
        $plan->setId($id);
        return $plan;
    }

    /**
     * @return Payer
     */
    protected function payer(): Payer
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    /**
     * @return ShippingAddress
     */
    protected function shippingAddress(): ShippingAddress
    {
        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine1('111 First Street')
            ->setCity('Saratoga')
            ->setState('CA')
            ->setPostalCode('95070')
            ->setCountryCode('US');
        return $shippingAddress;
    }

    public function execute($token)
    {
        $agreement = new Agreement();
        $agreement->execute($token, $this->apiContext);
    }
}