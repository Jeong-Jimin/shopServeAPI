<?php

 $USERID = "eat591.wc" ;
 $OPENKEY = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;

function get($url, $searchCondition){
    global $USERID;
    global $MANAGERKEY;
 $curl = curl_init($url); // RESET
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $searchCondition);
 $RESULT = curl_exec($curl);

 if(curl_errno($curl)){
     throw new Exception(curl_error($curl));
 }
 curl_close($curl);
 return $RESULT;
}


 $url = "https://management.api.shopserve.jp/v2/client/_search";
//$result  = get($url,"");
//$data = json_decode($result,true);
// $data = $data[0];
//
// $name = $data['name'];
// $name_kana = $data['name_kana'];
// $mail_address = $data['mail_address'];


//Add Search condition
 $query_string =array(
     'mail_address' => 'jung@estore.co.jp',
     'account'         => 'clover5745'
 );
 $query_string = json_encode($query_string);

$result2 = get($url, $query_string);



 $data = json_decode($query_string, true);

 $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
 var_dump(json_decode($json, true));

  ?>
