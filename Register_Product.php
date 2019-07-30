<?php
 error_reporting(0);
 $USERID        = "eat591.wc" ;
 $OPENKEY       = "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY    = "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;

 //Catch Product Information
 $ITEM_CODE         =   $_POST['item_code'];
 $ITEM_NAME         =   $_POST['item_name'];


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

//function
curlPut($V20027_URL, $registerInfo);


 /*********************************************************************/
 /********************** 商品基本・詳細情報登録及び更新 ************************/
 /*********************************************************************/

$V20028_URL                 = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/basic";

$CONSUMPTION_TAX_SETTING    =   $_POST['consumption_tax_setting'];
$ITEM_PRICE                 =   $_POST['item_price'];
$REGULAR_PRICE_OPT          =   $_POST['regular_price_type'];
$ITEM_MEMO                  =   $_POST['item_memo'];
$ITEM_CATEGORY              =   $_POST['item_category'];
$ITEM_UNIT                  =   $_POST['item_unit'];

if($ITEM_UNIT == NULL){
  $ITEM_UNIT = "個";
}

//상품정보를 담기위한 기본배열
$productInfo = array
    (
    "item_name"                 => $ITEM_NAME,
    "consumption_tax_setting"   => $CONSUMPTION_TAX_SETTING,
    "item_price"                => $ITEM_PRICE,
    "regular_price_type"        => $REGULAR_PRICE_OPT,
    "item_unit"                 => $ITEM_UNIT,
    "memo"                      => $ITEM_MEMO
    );

//정가 설정(RegularPrice 일 경우 정가 값 따로 설정 必要)
if($REGULAR_PRICE_OPT == "OpenPrice")
    {
        array_push($productInfo['regular_price_name']='オープン価格');
        //$productInfo["regular_price_name"] = 'オープン価格'; (役割一緒)
    }

elseif ($REGULAR_PRICE_OPT == "RegularPrice")
    {
        $productInfo['regular_price_name']='定価';
        $productInfo['regular_price']= "$ITEM_PRICE";
    }


//배열을 문자열로 변환
$productInfo = json_encode($productInfo);

curlPut($V20028_URL, $productInfo);



 /*********************************************************************/
 /************************* 商品カテゴリ登録・更新  **********************/
 /*********************************************************************/

$V20029_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/categories";

  $CategoryInfo  =  "{";
  $CategoryInfo .=  "\"categories\":[";
  $CategoryInfo .=  "{\"category\":[\"$ITEM_CATEGORY\"]}";
  $CategoryInfo .=  "]";
  $CategoryInfo .=  "}";

curlPut($V20029_URL, $CategoryInfo);


/*********************************************************************/
/*************************** 商品配送情報登録・更新  ********************/
/*********************************************************************/
$V20052_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/shipping";


//배열 원형 정의
$DeliveryInfo   =   array();
$DELIVERY_TYPE  =   $_POST['delivery_type'];

//우편, 택배 공통적으로 받는 값
$BUNDLE_PACKING =   $_POST['bundle_packing'];
$WEIGHT         =   $_POST['weight'];

    if($WEIGHT == NULL){
        $HAS_WEIGHT_VALUE = "No";
    }
    else{
        $HAS_WEIGHT_VALUE = "Yes";
        $DeliveryInfo['weight'] = $WEIGHT;
    }

$DeliveryInfo['has_weight_value'] = $HAS_WEIGHT_VALUE;


//등록할 상품 정보
$DeliveryInfo = array(
        'bundle_packing' => "$BUNDLE_PACKING",
        "delivery_type" => "$DELIVERY_TYPE"
            );

$DELIVERY_CONVENIENCE = $_POST['delivery_to_convenience_store'];
    if($DELIVERY_CONVENIENCE == NULL){
        $DELIVERY_CONVENIENCE = "No";
    }

$DeliveryInfo['delivery_type'] = $DELIVERY_TYPE;

//우편과 택배 따로 처리
if($DELIVERY_TYPE == "Mail"){
    $DeliveryInfo['delivery_to_convenience_store'] = "$DELIVERY_CONVENIENCE";
        }

elseif ($DELIVERY_TYPE == "Standard") {

    /*********************クール便設定************************/
    $TEMPERATURE_CONTROLLED = $_POST['temperature_controlled'];

        //通常配送で冷蔵・冷凍便を利用しない場合
        if($TEMPERATURE_CONTROLLED == NULL){
            $TEMPERATURE_CONTROLLED = "NoControl";
        }
    $DeliveryInfo['temperature_controlled'] = "$TEMPERATURE_CONTROLLED";


    /*********************　特別料金設定　**********************/
    $ENABLE_SPECIFIC_SHIPPING_CHARGE = $_POST['enable_specific_shipping_charge'];

        //通常配送で特別送料を設定しない場合
        if($ENABLE_SPECIFIC_SHIPPING_CHARGE == NULL){
            $ENABLE_SPECIFIC_SHIPPING_CHARGE = "No";
            $DeliveryInfo['enable_specific_shipping_charge'] = "$ENABLE_SPECIFIC_SHIPPING_CHARGE";
        }

        //特別送料SET、優先・表示方SET
        else{ //Yesの場合
            //送料設定
            $DeliveryInfo['enable_specific_shipping_charge'] = "$ENABLE_SPECIFIC_SHIPPING_CHARGE";

            $SPECIFIC_SHIPPING_CHARGE = $_POST['specific_shipping_charge'];
            $DeliveryInfo['specific_shipping_charge'] = "$SPECIFIC_SHIPPING_CHARGE";

            $PRIOR = $_POST['prior'];
                    if($PRIOR == NULL){
                        $PRIOR = "No";
                    }
                    $DeliveryInfo['prior'] = "$PRIOR";


            $DISPLAY_TYPE = $_POST['display_type'];
                if($DISPLAY_TYPE == NULL){
                    $DISPLAY_TYPE = "Zero";
                }
                $DeliveryInfo['display_type'] = "$DISPLAY_TYPE";
        }

    $SHIP_PERIOD = $_POST['shipping_preparation_period'];
    if($SHIP_PERIOD == NULL)
    {
        $SHIP_PERIOD = 0;
    }
    $DeliveryInfo['shipping_preparation_period'] = "$SHIP_PERIOD";
}

//Changing Array to String
$DeliveryInfo = json_encode($DeliveryInfo);

curlPut($V20052_URL, $DeliveryInfo);


/*************************************************/
/**************** 商品ページ情報 *******************/
/*************************************************/

$V20059_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/control";
$DISPLAY = $_POST['display'];

//등록할 상품 정보
$PageInfo = array("display" => $DISPLAY,
                  "show_cart_area" => "Yes");


if(isset($_POST['show_stock_viewer'])){
    $PageInfo['show_stock_viewer'] = $_POST['show_stock_viewer'];
}

if(isset($_POST['show_qr_code'])){
    $PageInfo['show_qr_code'] = $_POST['show_qr_code'];
}

if(isset($_POST['show_share_form'])){
    $PageInfo['show_share_form'] = $_POST['show_share_form'];
}

if(isset($_POST['show_customer_review'])){
    $PageInfo['show_customer_review'] = $_POST['show_customer_review'];
}

if(isset($_POST['show_inquire_form'])){
    $PageInfo['show_inquire_form'] = $_POST['show_inquire_form'];
}


//배열을 문자열로 변환
$PageInfo = json_encode($PageInfo);

curlPut($V20059_URL, $PageInfo);



 /*****************************************************/
 /**************** 商品メイン画像登録 ********************/
 /*****************************************************/

$V20056_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/images";

if(isset($_POST['image_name_check']))
{
      $IMAGE_NAME = $_POST['image_name_check'];

      $img_Maininfo  =  "{";
      $img_Maininfo .=  "\"images\":[";
      $img_Maininfo .=  "{\"image_name\":\"$IMAGE_NAME\",";
      $img_Maininfo .=  "\"is_main\":\"Yes\"}";
      $img_Maininfo .=  "]";
      $img_Maininfo .=  "}";

    curlPut($V20056_URL, $img_Maininfo);
}



 /*****************************************************/
 /**************** 商品メイン画像登録 ********************/
 /*****************************************************/
$PC_MAINAREA    =   $_POST['pc_mainArea'];
$PC_SERVEAREA   =   $_POST['pc_serveArea'];

$V20031_URL     =   "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/description/pc";


//등록할 상품 정보
$DescriptInfo = array('main_description' => "$PC_MAINAREA",
                      'sub_description1' => "$PC_SERVEAREA");

$DescriptInfo = json_encode($DescriptInfo);



curlPut($V20031_URL, $DescriptInfo);


/*****************************　商品アピール情報　*****************************/

$V20098_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/presentation/appeal";
$statusInfo = array();

if(isset($_POST['new_arrival'])){
    $statusInfo['new_arrival'] = $_POST['new_arrival'];
}

if(isset($_POST['recommended'])){
    $statusInfo['recommended'] = $_POST['recommended'];
}

$statusInfo = json_encode($statusInfo);

curlPut($V20098_URL, $statusInfo);

echo "<script>alert('Register Successed!')</script>";
echo "<script>window.location.href = './Register_Form.php';</script>";


/****************************************************************************/
/*******************************ここまで***************************************/
/***************************商品登録最小条件************************************/
/****************************************************************************/

function curlPut($URL, $ArrayInfo){
  global $USERID;
  global $MANAGERKEY;

  $curl = curl_init($URL); // RESET
  curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //PUT메소드로 넘기겠다
  curl_setopt($curl, CURLOPT_POSTFIELDS, $ArrayInfo);//검색옵션(POST메소드를 통해 보낼 값)을 지정한다

 //cURL실행
  $RESULT = curl_exec($curl);

  if (!curl_errno($curl))
    {
     switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)){
       case 201:  # Register OK
       case 200:  # OK
         break;

       default:
         echo 'Unexpected HTTP code: '." / ". $http_code ."<br />";
     }
   }

  else
    {
        throw new Exception(curl_error($curl));
    }

  //cURL실행종료
  curl_close($curl);

//Return value = No specific designation

}
?>
