<?php
    $USERID         =   "eat591.wc" ;
    $OPENKEY        =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
    $MANAGERKEY     =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
    $URL            =   "https://management.api.shopserve.jp/v2/service-setup/item-categories/_get";

    $curl = curl_init($URL); // RESET


    $Postcondition = array('top_category_path' => 'ノート');

    $Postcondition　＝ json_encode($Postcondition,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

    $curl  =  curl_init($URL); // RESET
    curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
    curl_setopt($curl, CURLOPT_POST, 1); //포스트 메소드로 넘김
     curl_setopt($curl, CURLOPT_POSTFIELDS, $Postcondition);//검색옵션(POST메소드를 통해 보낼 값)을 지정한다
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //데이터를 문자열로 직접출력

 $RESULT = curl_exec($curl);
 curl_close($curl);

$GetData  =  json_decode ( $RESULT , true );

print_r($GetData);
 ?>
