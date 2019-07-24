<?php

$ITEM_CODE = $_GET['item_code'];

$USERID        =   "eat591.wc" ;
$OPENKEY       =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
$MANAGERKEY    =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
$V2M0107       =   "https://management.api.shopserve.jp/v2/items/$ITEM_CODE";


 $curl = curl_init($V2M0107); // RESET
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//giving Accesskey
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); //PUT메소드로 넘기겠다
 //curl_setopt($curl, CURLOPT_POSTFIELDS, $DeliveryInfo);//검색옵션
 curl_setopt($curl, CURLOPT_HEADER, 0);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


//cURL실행
 $RESULT = curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
 if(!curl_errno($curl)){
     echo "<script>alert('Delete Success')</script>";
     echo "<script>window.close()</script>";
 }
 else{
     throw new Exception(curl_error($curl));
 }

 //cURL실행종료
 curl_close($curl);

 ?>
