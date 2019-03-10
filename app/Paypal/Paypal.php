<?php
namespace App\Paypal;

use PayPal\Api\Details;
use PayPal\Api\Amount;

class Paypal
{
    protected $apiContext;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.id'),     // ClientID
                config('services.paypal.secret')  // ClientSecret
            )
        );
    }

    /**
     * @return Details
     */
    protected function details(): Details
    {
        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);
        return $details;
    }

    /**
     * @return Amount
     */
    protected function amount(): Amount
    {
        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal(20);
        $amount->setDetails($this->details());
        return $amount;
    }
}