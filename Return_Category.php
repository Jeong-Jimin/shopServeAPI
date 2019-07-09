<?php
$shop_ID = "eat591.wc" ;
 $OPENKEY = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;

 $product_code = "AAA00018";
 $url = "https://management.api.shopserve.jp/v2/items/$product_code/categories";

 $curl = curl_init($url); // RESET

 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_USERPWD, $shop_ID.":".$MANAGERKEY);

 $RESULT = curl_exec($curl);
curl_error($curl);

 //curl_close($curl);



 ?>
