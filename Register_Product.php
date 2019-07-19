<?php

 $USERID        = "eat591.wc" ;
 $OPENKEY       = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY    = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;

 //Catch Product Information
  $ITEM_CODE         =   $_POST['item_code'];
  $ITEM_NAME         =   $_POST['item_name'];

  $ITEM_PRICE        =   $_POST['item_price'];
  $REGULAR_PRICE_OPT =   $_POST['regular_price_type'];
  $CONSUMPTION_TAX_SETTING    =   $_POST['consumption_tax_setting'];

  $ITEM_MEMO         =   $_POST['item_memo'];
  $ITEM_CATEGORY     =   $_POST['item_category'];
  $QUANTITY          =   $_POST['quantity'];
  $ITEM_UNIT         =   $_POST['item_unit'];


/**********************************************************************/
/************************* アジャイルテスト *****************************/
/*********************************************************************/
/******/    echo $ITEM_CODE."<br />";                   /***********/
/******/    echo $ITEM_NAME."<br />";                   /***********/
/******/                                                /***********/
/******/    echo $ITEM_PRICE."<br />";                  /***********/
/******/    echo $REGULAR_PRICE_OPT."<br />";           /***********/
/******/    echo $CONSUMPTION_TAX_SETTING."<br />";     /***********/
/******/    echo $ITEM_UNIT."<br />";                   /***********/
/******/    echo $ITEM_MEMO."<br />";                   /***********/
/******/    echo $ITEM_CATEGORY."<br />";               /***********/
/******/    echo $QUANTITY."<br />";                    /***********/
/**********************************************************************/
/************************* アジャイルテスト *****************************/
/*********************************************************************/





/*********************************************************************/
/************************* 商品基本情報登録 **************************/
/*********************************************************************/
$V20027_URL     = "https://management.api.shopserve.jp/v2/items";

//상품기본 옵션을 배열에 넣는다
 $registerInfo = array(
     "item_code"        =>  $ITEM_CODE,
     "item_name"        =>  $ITEM_NAME
 );


//만든 배열을 json_encode()을 이용해 string형태로 바꾼 후 외부에 전달
$registerInfo = json_encode($registerInfo);


 $curl = curl_init($V20027_URL); // RESET
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
 curl_setopt($curl, CURLOPT_POSTFIELDS, $registerInfo);//검색옵션(POST메소드를 통해 보낼 값)을 지정한다
 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
     'Content-Type:application/json',
     'Content-Length:'.strlen($registerInfo))
 );

//cURL실행
 $RESULT = curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
 if(curl_errno($curl)){
     throw new Exception(curl_error($curl));
 }

 //cURL실행종료
 curl_close($curl);




 /*********************************************************************/
 /********************** 商品基本・詳細情報登録及び更新 ************************/
 /*********************************************************************/

$V20028_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/basic";


if($REGULAR_PRICE_OPT == "OpenPrice"){
    $REGULAR_PRICE_NAME = "オープン価格";
}
elseif ($REGULAR_PRICE_OPT == "RegularPrice") {
    $REGULAR_PRICE_NAME = "定価";
    $REGULAR_PRICE = $ITEM_PRICE;
}
elseif ($REGULAR_PRICE_OPT == "None") {
    $REGULAR_PRICE_NAME = "";
}

//등록할 상품 정보
$productInfo = array(
"item_name" => $ITEM_NAME,
"consumption_tax_setting" => $CONSUMPTION_TAX_SETTING,
"item_price" => $ITEM_PRICE,
"regular_price_type" => $REGULAR_PRICE_OPT,
"regular_price_name" => $REGULAR_PRICE_NAME,
"regular_price"      => $REGULAR_PRICE,
"item_unit"          => $ITEM_UNIT,
"memo"               => $ITEM_MEMO
);

//배열을 문자열로 변환
$productInfo = json_encode($productInfo);


 $curl = curl_init($V20028_URL); // RESET
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
 curl_setopt($curl, CURLOPT_POSTFIELDS, $productInfo);//검색옵션(메소드를 통해 보낼 값)을 지정

 //헤더 정보 정의
 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
     'Content-Type:application/json',
     'Content-Length:'.strlen($productInfo))
 );

//cURL실행
 $RESULT = curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
 if(curl_errno($curl)){
     throw new Exception(curl_error($curl));
 }

 //cURL실행종료
 curl_close($curl);



 /*********************************************************************/
 /************************* 商品カテゴリ登録・更新  **********************/
 /*********************************************************************/

$V20029_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/categories";


$CategoryInfo = "{";
        $CategoryInfo .=  "\"categories\":[";
        $CategoryInfo .=  "{\"category\":[\"$ITEM_CATEGORY\"]}";
        $CategoryInfo .=  "]";
        $CategoryInfo .=  "}";

$curl = curl_init($V20029_URL); // RESET
curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
curl_setopt($curl, CURLOPT_POSTFIELDS, $CategoryInfo);//검색옵션(메소드를 통해 보낼 값)을 지정

//헤더 정보 정의
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:　text/plain',
    'Content-Length:'.strlen($CategoryInfo))
);

//cURL실행
$RESULT = curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

//cURL실행종료
curl_close($curl);



// /*********************************************************************/
// /*************************** 商品画像登録・更新  ************************/
// /*********************************************************************/
//
//
// $V20056_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/images";
//
//   $cfile = new CURLFile($ITEM_IMAGE_NAME,'image/png','temporary_name');
//
// $ImageInfo = array('images' =>
//                     array(
//                         'image_name' => $ITEM_IMAGE_NAME,
//                         'is_main' => "Yes")
//                         );
//
// $curl = curl_init($V20029_URL); // RESET
// curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
// curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
// curl_setopt($curl, CURLOPT_POSTFIELDS, $ImageInfo);//검색옵션(메소드를 통해 보낼 값)을 지정
//
// //헤더 정보 정의
// curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//     'Content-Type:　multipart/form-data',
//     'Content-Length:'.strlen($ImageInfo))
// );
//
// //cURL실행
// $RESULT = curl_exec($curl);
//
// //ERROR의 경우, 해당 ERROR를 반환한다
// if(curl_errno($curl)){
//     throw new Exception(curl_error($curl));
// }
//
// //cURL실행종료
// curl_close($curl);



/*********************************************************************/
/*************************** 商品配送情報登録・更新  ********************/
/*********************************************************************/
$V20052_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/shipping";


$BUNDLE_PACKING = $_POST['bundle_packing'];
$DELIVERY_TYPE = $_POST['delivery_type'];

$WEIGHT = $_POST['weight'];
    if($WEIGHT == ""){
        $HAS_WEIGHT_VALUE = "No";
    }
    else{
        $HAS_WEIGHT_VALUE = "Yes";
    }

$DELIVERY_CONVENIENCE = $_POST['delivery_to_convenience_store'];

    if($DELIVERY_CONVENIENCE == NULL)
        {
        $DELIVERY_CONVENIENCE = "Deny";
            }

if($DELIVERY_TYPE == "Mail"){

    $TEMPARATURE_CONTROLLED = "NoControl";
    $ENABLE_SPECIFIC_SHIPPING_CHARGE = "No";

        }

elseif ($DELIVERY_TYPE == "Standard") {
    $TEMPARATURE_CONTROLLED = $_POST['temparature_controlled'];

        //通常配送で冷蔵・冷凍便を利用しない場合
        if($TEMPARATURE_CONTROLLED == NULL){
            $TEMPARATURE_CONTROLLED = "NoControl";
        }

    $ENABLE_SPECIFIC_SHIPPING_CHARGE = $_POST['enable_specific_shipping_charge'];

        //通常配送で特別送料を設定しない場合
        if($ENABLE_SPECIFIC_SHIPPING_CHARGE == NULL){
            $ENABLE_SPECIFIC_SHIPPING_CHARGE == "No";
        }

        else{
            $SPECIFIC_SHIPPING_CHARGE = $_POST['specific_shipping_charge'];
            $PRIOR = $_POST['prior'];
                if($PRIOR == NULL){
                    $PRIOR = "No";
                }
            $DISPLAY_TYPE = $_POST['display_type'];
        }
    $SHIP_PERIOD = $_POST['shipping_preparation_period'];
}

//
// echo "bundle :".$BUNDLE_PACKING."<br />";
// echo "DELIVERY_TYPE :".$DELIVERY_TYPE."<br />";
// echo "ENABLE_SPECIFIC_SHIPPING_CHARGE :".$ENABLE_SPECIFIC_SHIPPING_CHARGE."<br />";
// echo "SPECIFIC_SHIPPING_CHARGE :".$SPECIFIC_SHIPPING_CHARGE."<br />";
// echo "PRIOR :".$PRIOR."<br />";
// echo "DISPLAY_TYPE :".$DISPLAY_TYPE."<br />";
// echo "TEMPARATURE_CONTROLLED :".$TEMPARATURE_CONTROLLED."<br />";
// echo "HAS_WEIGHT_VALUE :".$HAS_WEIGHT_VALUE."<br />";
// echo "WEIGHT :".$WEIGHT."<br />";
// echo "SHIP_PERIOD :".$SHIP_PERIOD."<br />";
// echo "DELIVERY_CONVENIENCE :".$DELIVERY_CONVENIENCE."<br />";


//등록할 상품 정보
$DeliveryInfo = array(
        "bundle_packing" => "Deny",
        "delivery_type" => "Standard",
        "enable_specific_shipping_charge" => "Yes",
        "specific_shipping_charge" => 512,
        "display_type" => "Free",
        "prior" => "Yes",
        "temparature_controlled" => "NoControl",
        "has_weight_value" => "Yes",
        "weight" => 95,
        "shipping_preparation_period" => 3,
        "delivery_to_convenience_store" => "Allow"
            );


//Changing Array to String
$DeliveryInfo = json_encode($DeliveryInfo);


 $curl = curl_init($V20052_URL); // RESET
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//giving Accesskey
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
 curl_setopt($curl, CURLOPT_POSTFIELDS, $DeliveryInfo);//검색옵션(메소드를 통해 보낼 값)을 지정

 //헤더 정보 정의
 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
     'Content-Type:application/json',
     'Content-Length:'.strlen($DeliveryInfo))
 );


//cURL실행
 $RESULT = curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
 if(curl_errno($curl)){
     throw new Exception(curl_error($curl));
 }

 //cURL실행종료
 curl_close($curl);



/*************************************************/
/**************** 商品ページ情報 *******************/
/*************************************************/



$V20059_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/control";


$DISPLAY = $_POST['display'];


//등록할 상품 정보
$PageInfo = array("display" => $DISPLAY);

//배열을 문자열로 변환
$PageInfo = json_encode($PageInfo);


 $curl = curl_init($V20059_URL); // RESET
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
 curl_setopt($curl, CURLOPT_POSTFIELDS, $PageInfo);//검색옵션(메소드를 통해 보낼 값)을 지정

 //헤더 정보 정의
 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
     'Content-Type:application/json',
     'Content-Length:'.strlen($PageInfo))
 );

//cURL실행
 $RESULT = curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
 if(curl_errno($curl)){
     throw new Exception(curl_error($curl));
 }

 //cURL실행종료
 curl_close($curl);


 ?>
