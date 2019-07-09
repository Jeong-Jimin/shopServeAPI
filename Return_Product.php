<?php
 $USERID = "eat591.wc" ;
 $OPENKEY = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;


//Product Information Print API
 $url = "https://management.api.shopserve.jp/v2/items/_search";


    $curl = curl_init(); // RESET
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);


 $RESULT = curl_exec($curl);

 curl_close($curl);


?>
