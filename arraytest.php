<?php
error_reporting(0);

$TEST = array( );
$VALUE = "dldl";


array_push($TEST['bundle_packing']='Deny');
array_push($TEST['what']="$VALUE");
$TEST["regular_price_name"] = 'all';

$TEST = json_encode($TEST);

print_r($TEST);



$img_Maininfo = array(
                        "images"=>array(
                            "image_name" => "No",
                            "is_main"    => "Yes")
                );


//배열을 문자열로 변환
$img_Maininfo = json_encode($img_Maininfo);

print_r($img_Maininfo);
 ?>
