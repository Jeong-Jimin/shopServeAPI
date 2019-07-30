<head>

    <!---------------------------------------------------------------->
    <!-------------------- bootstrap CDN Import ---------------------->
    <!---------------------------------------------------------------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!---------------------------------------------------------------->
    <!-------------------- JQuery CDN Import ------------------------->
    <!---------------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!---------------------------------------------------------------->
    <!-------------------- Own file import --------------------------->
    <!---------------------------------------------------------------->
    <link rel="stylesheet" href="./Register_css.css"/>
    <script src="./Register_js.js"></script>

</head>



<!---------------------------------------------------------------->
<!-------------------- Get Category List ------------------------->
<!---------------------------------------------------------------->
<?php
error_reporting(0);

$USERID         =   "eat591.wc" ;
$OPENKEY        =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
$MANAGERKEY     =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
$V2M0110        =   "https://management.api.shopserve.jp/v2/service-setup/item-categories/_get";

//Original Directory Fath farming
$GetData        =   json_decode(curlPost($V2M0110,null),true);

//First child directory farming
// for($i = 0 ; $i< count($GetData['child_categories']) ; $i++){
//
//     if($GetData['child_categories'][$i]['has_child_categories'] == "Yes"){
//         $First_Parents = $GetData['child_categories'][$i]['name'];
//
//         $Ctg_Info = "{";
//                 $Ctg_Info .=  "\"top_category_path\":[";
//                 $Ctg_Info .=  "\"$First_Parents\"";
//                 $Ctg_Info .=  "]";
//                 $Ctg_Info .=  "}";
//
//         $child_GetData  =   json_decode(curlPost($V2M0110,$Ctg_Info), true);
//     }
// }

 ?>


<center>

    <div class="jumbotron">
     <h1 class="display">new registration!</h1>
        <p class="lead">You can register items easily without going through the Shopserve<br />
      It is also possible to update the product information already registered
        </p>
    <hr />
      <p>for more detail, you reference Shopserve page</p>
      <a class="btn btn-success btn-lg" href="https://kanri9.shopserve.jp/index.cgi" role="button">Go Shopserve</a>
    </div>


<!---------------------------------------------------------------------------------->
<!----------------------------- Register Form -------------------------------------->
<!---------------------------------------------------------------------------------->
<form method="post" action="./Register_Product.php" id="RegisterForm" name="RegisterForm" onsubmit="return Register_Product()">
    <table class="table table-bordered">
        <thead>

<!--------------------------------------------------------------------------------->
<!--------------------- Basic Information for Product Register -------------------->
<!----------- Product Code, Name, Detail of price, Category, Unit, Memo ----------->
<!--------------------------------------------------------------------------------->
    <tr class="table-success">
        <th scope="col" style="background-color:rgb(63, 204, 136);"></th>
        <td class="bg-success" style="text-align:center; background-color:rgb(63, 204, 136);"><b>基本情報</b></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品番号<font style="Color:red;">✱</font></th>
        <td><input type="text" class="form-control" id="item_code" name="item_code"></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品名<font style="Color:red;">✱</font></th>
        <td> <input type="text" class="form-control" id="item_name" name="item_name"></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品カテゴリ<font style="Color:red;">✱</font></th>
        <td>
            <select name="item_category">
                <?php for($i = 0 ; $i< count($GetData['child_categories']) ; $i++){?>
                    <option value="<?=$GetData['child_categories'][$i]['name']?>"><?=$GetData['child_categories'][$i]['name']?></option>
                <?php } ?>
            </select>
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">価格設定</th>
        <td>
            <div class="form-check">
                <input class="form-check-input position-static" type="radio" name="consumption_tax_setting" value="Standard" checked="checked">税込み

                &nbsp;&nbsp;&nbsp;

                <input class="form-check-input position-static" type="radio" name="consumption_tax_setting" value="TaxExempt">非課税
            </div>
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">価格オプション</th>
        <td>
            <div class="form-check">
                <input class="form-check-input position-static" type="radio" name="regular_price_type" value="RegularPrice" />表示

                    &nbsp;&nbsp;&nbsp;

                <input class="form-check-input position-static" type="radio" name="regular_price_type" value="OpenPrice" />オープン価格

                    &nbsp;&nbsp;&nbsp;

                <input class="form-check-input position-static" checked type="radio" name="regular_price_type" value="None">非表示
            </div>
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">商品価格(円)<font style="Color:red;">✱</font></th>
        <td><input type="text" class="form-control" name="item_price" id="item_price">
        </td>
    </tr>


    <tr>
        <th scope="col" class="success" style="vertical-align:middle;">商品メモ</th>
        <td><textarea class="form-control" name="item_memo"></textarea></td>
    </tr>


    <tr>
        <th scope="col" class="success">単位</th>
        <td><input type="text" class="form-control" name="item_unit" placeholder="個"></td>
    </tr>

    <tr>
        <th scope="col" class="success" style="vertical-align:middle;">メイン画像登録</th>
        <td><input type="button" class="form-control" value="画像一覧から選択"
                  onclick="window.open('./return_Image.php?role=main_image','','width:200, height:200,resizable=yes, scrollbars=yes')">
            <br />
            <div id="image_insert"></div>
            <br />
            <input type="text" class="form-control" name="image_name_check" placeholder="画像名" />
        </td>
    </tr>


    <tr>
        <th scope="col" class="success" style="vertical-align:middle;">PC用紹介文</th>
        <td>
          <p style="background:rgb(78, 241, 163); width:300px;">
              <b>メイン紹介文</b>
              <input type="button" class="form-control" value="画像一覧から選択"
                onclick="window.open('./return_Image.php?role=main_discription','','width:200, height:200,resizable=yes, scrollbars=yes')">
          </p>
          <textarea rows="8" cols="70" name="pc_mainArea" onkeyup="countChar(this, 'pc_mainArea')"></textarea>
          <small><div id="charNum1"></div></small>

          <br />

          <p style="background:rgb(78, 241, 163); width:300px;">
              <b>サブ紹介文</b>
              <input type="button" class="form-control" value="画像一覧から選択"
                onclick="window.open('./return_Image.php?role=serve_discription','','width:200, height:200,resizable=yes, scrollbars=yes')">
          </p>
          <textarea rows="8" cols="70" name="pc_serveArea" onkeyup="countChar(this,'pc_serveArea')"></textarea>
          <small><div id="charNum2"></div></small>

          <br />

        </td>
    </tr>

    <tr>
        <th scope="col" class="success">商品公開</th>
        <td>
            <div class="form-check">
            <input class="form-check-input position-static" type="radio" name="display" value="Yes" checked="checked">公開する

            &nbsp;&nbsp;&nbsp;

            <input class="form-check-input position-static" type="radio" name="display" value="No">公開しない
        </td>
    </tr>

    <tr>
        <th scope="col" class="success">ページ表示オプション</th>
        <td>
            <input class="form-check-input position-static" type="checkbox" name="show_stock_viewer" value="Yes">&nbsp;「在庫を見る」

            <input class="form-check-input position-static" type="checkbox" name="show_qr_code" value="Yes">&nbsp;「QRコードを見る」

            <input class="form-check-input position-static" type="checkbox" name="show_customer_review" value="Yes">&nbsp;「顧客レビュー」

            <input class="form-check-input position-static" type="checkbox" name="show_share_form" value="Yes">&nbsp;「友達に共有する」

            <input class="form-check-input position-static" type="checkbox" name="show_inquire_form" value="Yes">&nbsp;「お問い合わせ」
        </td>
    </tr>

<tr>
  <th scope="col" class="success">商品ステータス</th>
  <td>
      <input class="form-check-input position-static" type="checkbox" name="new_arrival" value="Yes">&nbsp;「新着商品」で登録&nbsp;&nbsp;

      <input class="form-check-input position-static" type="checkbox" name="recommended" value="Yes">&nbsp;「おすすめ商品」で登録
  </td>
</tr>

    <!--------------------------------------------------------------->
    <!---------- Delivery Detail Set for Product Register ----------->
    <!-- Product Code, Name, Detail of price, Category, Unit, Memo -->
    <!--------------------------------------------------------------->

    <tr class="table-success">
        <th scope="col" style="background-color:rgb(63, 204, 136);"></th>
        <td class="bg-success" style="text-align:center; background-color:rgb(63, 204, 136);"><b>配送情報</b></td>
    </tr>


    <tr>
        <th scope="col" class="success">
            コンビニ受取
        </th>

        <td>
                <input class="form-check-input position-static" type="radio" name="delivery_to_convenience_store" value="Allow" />利用する

                   &nbsp;&nbsp;&nbsp;

                <input class="form-check-input position-static" type="radio" name="delivery_to_convenience_store" value="Deny" checked="checked"/>利用しない
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">同梱設定</th>
        <td>
            <div class="form-check">
            <input class="form-check-input position-static" type="radio" name="bundle_packing" value="Allow">利用する

               &nbsp;&nbsp;&nbsp;

            <input class="form-check-input position-static" type="radio" name="bundle_packing" value="Deny" checked="checked">利用しない
            </div>
        </td>
    </tr>


    <tr>
        <th scope="col" class="success" style="vertical-align:middle;">重量別送料設定</th>
        <td>
            <input type="text" name="weight" id="custom" placeholder="総重量" / >&nbsp;(g)
        </td>
    </tr>


<!-- Set Delivery Detail Option  -->
    <tr>
        <th scope="col" class="success" style="vertical-align:middle;">送料
            <font style="Color:red;">✱</font>
        </th>
        <td>
            <input type="radio" id="check_mail" name="delivery_type" value="Mail" onclick="Mail_Delivery()"; />メール便

            &nbsp;&nbsp;&nbsp;

            <input type="radio" id="check_Standard" name="delivery_type" value="Standard" checked="checked" onclick="Standard_Delivery()"; />通常便


<!----------------------------------------------------------------------------->
<!------------------------ Standard Delivery Set ------------------------------>
<!----------------------------------------------------------------------------->

        <div id="Std_Delivery" style="display:block;">
            <hr />

            <p style="background:rgb(78, 241, 163); width:300px;">
                <b>アイスパック設定</b>
            </p>

            <input type="checkbox"  name="temperature_controlled" id="temperature_controlled_cold" value="Cold" onclick="temperature_Exception_cold()"/>冷蔵便<img src="./reizou.gif"/>

            <br />

            <input type="checkbox" name="temperature_controlled" id="temperature_controlled_freeze" value="Freeze" onclick="temperature_Exception_freeze()"/>冷凍便<img src="reitou.gif"/>

            <br />
            <hr />


            <p style="background:rgb(78, 241, 163); width:300px;">
                <b>特別送料設定</b>
            </p>

            <p>
                    <input type="checkbox" name="enable_specific_shipping_charge" value="Yes" id="enable_specific_shipping_charge"  onclick="enable_specific_shipping_charge_set()">
                    利用する
            </p>

            <input type="text" class="form-controller col-md-2" name="specific_shipping_charge" id="specific_shipping_charge">&nbsp;(円)　

            <br /><br />

            <p>
            <input class="form-check-input position-static" type="checkbox" name="display_type" value="Free">&nbsp; 0円の場合は　"無料配送" で表示

            <p>
                <input class="form-check-input position-static" type="checkbox" name="prior" value="Yes">&nbsp;
                ★この送料を優先する &nbsp;&nbsp;&nbsp;
            </p>


            <p style="background:rgb(78, 241, 163); width:300px;">
                <b>配送準備期間</b>
            </p>

            <input type="text" class="form-controller col-md-2"  name="shipping_preparation_period" id="shipping_preparation_period" placeholder = "0~365">日

        </td>
<!----------------------------------------------------------------------------->
<!------------------------ Standard Delivery Set ------------------------------>
<!----------------------------------------------------------------------------->
        </div>
    </tr>
    </thead>
</table>

        <br />

        <input type="submit" class= "btn btn-success btn-lg" value="該当の内容で商品登録">
    </form>

    <input type="button" class= "btn btn-success btn-lg" value="商品一覧確認" onclick="window.open('./Return_Product.php');">

    <br />
    <br />
</center>


<?php

function curlPost($URL, $PutArray){

global $USERID;
global $MANAGERKEY;

  $CURL = curl_init($URL); // RESET
  curl_setopt($CURL, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//Giving Access Key
  curl_setopt($CURL, CURLOPT_POST, 1); //Set Method to POST
  curl_setopt($CURL, CURLOPT_POSTFIELDS, $PutArray);
  curl_setopt($CURL, CURLOPT_RETURNTRANSFER, 1); //Print data to String Array

  $RESULT = curl_exec($CURL);
  curl_close($CURL);

  return $RESULT;
}

 ?>


<script>
function countChar(val, name) {

if(name == 'pc_mainArea')
{
var len = val.value.length;

if (len >= 32500) {
  val.value = val.value.substring(0, 32500);
  }

else {
    $('#charNum1').text(len);
}

}

else if (name == 'pc_serveArea')
{
var len = val.value.length;
if (len >= 32500) {
 val.value = val.value.substring(0, 32500);
 }

else {
   $('#charNum2').text(len);
}
}
}
</script>
