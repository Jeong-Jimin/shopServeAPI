<?php
$shop_ID = "eat591.wc" ;
 $OPENKEY = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;


$product_code = "AAA00016";

$query_string = array(
    'Color' => '白',
    'quantity' => '40'
);

$query_string = json_encode($query_string);

$url = "https://management.api.shopserve.jp/v2/items/$product_code/stock";


 $curl = curl_init(); // RESET


 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
 curl_setopt($curl, CURLOPT_USERPWD, $shop_ID.":".$MANAGERKEY);



 $RESULT = curl_exec($curl);

 curl_close($curl);


 ?>
