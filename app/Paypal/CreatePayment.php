<?php
namespace App\Paypal;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

class CreatePayment extends Paypal
{
    public function create()
    {
        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $payment = $this->Payment($itemList);
        
        $payment->create($this->apiContext);

        return redirect($payment->getApprovalLink());
    }

    /**
     * @return Payer
     */
    protected function Payer(): Payer
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        return $payer;
    }

    /**
     * @param ItemList $itemList
     * @return Transaction
     */
    protected function Transaction(ItemList $itemList): Transaction
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->amount())
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        return $transaction;
    }

    /**
     * @return RedirectUrls
     */
    protected function RedirectUrls(): RedirectUrls
    {
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(config('services.paypal.url.redirect'))
            ->setCancelUrl(config('services.paypal.url.cancel'));
        return $redirectUrls;
    }

    /**
     * @param ItemList $itemList
     * @return Payment
     */
    protected function Payment(ItemList $itemList):Payment
    {
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($this->Payer())
            ->setRedirectUrls($this->RedirectUrls())
            ->setTransactions([$this->Transaction($itemList)]);
        return $payment;
    }
}