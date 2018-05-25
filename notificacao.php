<?php

$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

$data['token'] = '8FDC81B6A9544EAB99B706D2411CE2E4';
$data['email'] = 'thomasferreiraa@gmail.com';

$data = http_build_query($data);

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

$reference = $xml->reference;
$status = $xml->status;

if($reference && $status){
 include_once 'conecta.php';
 $conn = new conecta();

 $rs_pedido = $conn->consultarPedido($reference);

 if($rs_pedido){
 $conn->atualizaPedido($reference,$status);
 }
}

?>