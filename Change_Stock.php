<?php

 $shop_ID       = "eat591.wc" ;
 $OPENKEY       = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY    = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
 $ITEM_CODE     = "AAA00015"; //$_POST['item_code'];
// $QUANTITY      = $_POST['quantity'];
 $V2M0019       = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/stock";


$stockChange = array(
                    //'Color' => '白',
                    'unlimited' => "No", 
                    'quantity' => '40'
                    );

//change Json String array
$stockChange = json_encode($stockChange);

 $curl = curl_init(); // RESET

 curl_setopt($curl, CURLOPT_URL, $V2M0019);
 curl_setopt($curl, CURLOPT_USERPWD, $shop_ID.":".$MANAGERKEY);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $stockChange);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $RESULT = curl_exec($curl);

 //Exception
  if (!curl_errno($curl)) {
    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
      case 200:  # OK
       echo "<script>alert('Stock Change Susccess!')</script>";
       echo "<script>window.close()</script>";

      default:

        echo 'Unexpected HTTP code: ', $http_code, "\n";
    }
  }
 else {
     throw new Exception(curl_error($curl));
 }


 curl_close($curl);




 ?>
