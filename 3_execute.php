<?php

$token="token123";
$payer_id='548EL6EMFFCYG';//get by approval_url
$payment_id='PAY-4D083484VA173901EK6Q5J7Q';
$curl = curl_init();
$postdata=  json_encode(["payer_id"=>$payer_id]);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sandbox.paypal.com/v1/payments/payment/".$payment_id."/execute",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $postdata,
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$token,
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/sandbox_paypal.crt");

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $res=  json_decode($response);
  echo '<pre>';
  print_r($res);
}