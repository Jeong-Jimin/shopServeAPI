<?php

$USERID         =   "eat591.wc" ;
$OPENKEY        =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
$MANAGERKEY     =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
$V2M0110        =   "https://management.api.shopserve.jp/v2/service-setup/item-categories/_get";


$Ctg_Info = "{";
        $Ctg_Info .=  "\"top_category_path\":[";
        $Ctg_Info .=  "\"ポストイット\"";
        $Ctg_Info .=  "]";
        $Ctg_Info .=  "}";


$CURL = curl_init($V2M0110); // RESET
curl_setopt($CURL, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//Giving Access Key
curl_setopt($CURL, CURLOPT_POST, 1); //Set Method to POST
curl_setopt($CURL, CURLOPT_POSTFIELDS, $Ctg_Info);
curl_setopt($CURL, CURLOPT_RETURNTRANSFER, 1); //Print data to String Array

$RESULT         =   curl_exec($CURL);
curl_close($CURL);

$GetData        =   json_decode ( $RESULT , true );

echo "CHILD_CATEGORIES : ". $GetData['child_categories'][0]['name']."<br />";
print_r($GetData);

  ?>
