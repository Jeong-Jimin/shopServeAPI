<?php

$USERID        = "eat591.wc" ;
$OPENKEY       = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
$MANAGERKEY    = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;

$ITEM_CODE = $_POST['item_code'];

$V2M0030   = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/basic";

echo curlPost($V2M0030);


function curlPost($URL){
  global $USERID;
  global $MANAGERKEY;

  $curl = curl_init($URL); // RESET
  curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); //PUT메소드로 넘기겠다
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Print data to String Array

 //cURL실행
  $RESULT = curl_exec($curl);

//Error Exception Processing
  if (!curl_errno($curl))
    {
     switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)){
       case 201:  # Register OK
       case 200:  # OK
         break;


         // 404Error:: Not register item
       default:
         echo 'Unexpected HTTP code: ', $http_code, "\n";
     }
   }

  else
    {
        throw new Exception(curl_error($curl));
    }

  //cURL실행종료
  curl_close($curl);


  return $http_code;
}


 ?>
