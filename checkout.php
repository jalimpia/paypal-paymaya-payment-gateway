<?php
/*Accept POST data*/
$cart_items = $_POST['data_cart'];

require __DIR__  . '/vendor/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AaRaCzB8H5LrUiqUEaGE1M0gBF1RMpT2IDpBRqbXw2mX9QaY3F-XSiw8kk6TZTMaQSxrsr5BzoV6LVr8',     // ClientID
        'EDWTZxrFBMnfRokiSOM-77X_MteateOMiYkWFduIy0RxieM6zv_vQAKs6XJF0HVbYTy3MhJ0l4tPVfQm'      // ClientSecret
    )
);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');


$items = [];
$totalAmount = 0;
foreach ($cart_items as $cart_item) {
 $totalAmount+=$cart_item['price'] * $cart_item['qty'];
 $item = new \PayPal\Api\Item();
 $item->setName(strval($cart_item['name']))
     ->setCurrency('PHP')
     ->setQuantity($cart_item['qty'])
     ->setSku(strval($cart_item['sku']))
     ->setPrice($cart_item['price']);
     array_push($items, (object) $item);
}
$totalAmount = number_format((float)$totalAmount, 2, '.', '');

$itemList = new \PayPal\Api\ItemList();
$itemList->setItems($items);

$details = new \PayPal\Api\Details();
$details->setShipping(0.0)
    ->setTax(0.0)
    ->setSubtotal($totalAmount);

$amount = new \PayPal\Api\Amount();
$amount->setCurrency("PHP")
    ->setTotal($totalAmount)
    ->setDetails($details);

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://" . $_SERVER['HTTP_HOST'] . "/paypal-maya/payment-success.php")
    ->setCancelUrl("http://" . $_SERVER['HTTP_HOST'] . "/paypal-maya/");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    //echo $payment;
    // "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
    if($payment->getApprovalLink()){
        echo $payment->getApprovalLink();
    }

}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    //echo $ex->getData();
    echo 0;
}
