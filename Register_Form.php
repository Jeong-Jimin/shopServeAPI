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

$USERID         =   "eat591.wc" ;
$OPENKEY        =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
$MANAGERKEY     =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
$URL            =   "https://management.api.shopserve.jp/v2/service-setup/item-categories/_get";
$CURL           =   curl_init($URL); // RESET

curl_setopt($CURL, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//Giving Access Key
curl_setopt($CURL, CURLOPT_POST, 1); //Set Method to POST
curl_setopt($CURL, CURLOPT_RETURNTRANSFER, 1); //Print data to String Array

$RESULT         =   curl_exec($CURL);
curl_close($CURL);

$GetData        =   json_decode ( $RESULT , true );

//Pull out Child category Using [for loop]
for($FirstCheck = 0 ; $FirstCheck < count($GetData['child_categories']) ; $FirstCheck++ )
{
    for($SecondCheck = 0 ; $FirstCheck < 1 ; $FirstCheck++)
{

}

}

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


<!---------------------------------------------------------------->
<!-------------------- Register Form ----------------------------->
<!---------------------------------------------------------------->
<form method="post" id="RegisterForm">
    <table class="table table-bordered">
        <thead>

<!--------------------------------------------------------------->
<!------------ Basic Information for Product Register ----------->
<!-- Product Code, Name, Detail of price, Category, Unit, Memo -->
<!--------------------------------------------------------------->
    <tr class="table-success">
        <th scope="col" style="background-color:rgb(63, 204, 136);"></th>
        <td class="bg-success" style="text-align:center; background-color:rgb(63, 204, 136);"><b>基本情報</b></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品番号</th>
        <td><input type="text" class="form-control" name="item_code"></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品名</th>
        <td> <input type="text" class="form-control" name="item_name"></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品カテゴリ</th>
        <td>
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                Select Category

                <select name="item_category" class="selectpicker">
                    <?php for($i = 0 ; $i< count($GetData['child_categories']) ; $i++){?>
                        <option value="<?=$GetData['child_categories'][$i]['name']?>"><?=$GetData['child_categories'][$i]['name']?></option>
                    <?php } ?>
                </select>
            </button>
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">価格設定</th>
        <td>
            <div class="form-check">
                <input class="form-check-input position-static" type="radio" name="consumption_tax_setting" value="Standard">税込み

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

                <input class="form-check-input position-static" type="radio" name="regular_price_type" value="None">非表示
            </div>
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">商品価格(円)</th>
        <td><input type="text" class="form-control" name="item_price" id="item_price">
        </td>
    </tr>


    <tr>
        <th scope="col" class="success" style="vertical-align:middle;">商品メモ</th>
        <td><textarea class="form-control" name="item_memo"></textarea></td>
    </tr>


    <tr>
        <th scope="col" class="success">在庫</th>
        <td><input type="text" class="form-control" name="quantity"></td>
    </tr>


    <tr>
        <th scope="col" class="success">単位</th>
        <td><input type="text" class="form-control" name="item_unit"></td>
    </tr>


    <tr>
        <th scope="col" class="success">商品公開</th>
        <td>
            <div class="form-check">
            <input class="form-check-input position-static" type="radio" name="display" value="Yes">公開する

            &nbsp;&nbsp;&nbsp;

            <input class="form-check-input position-static" type="radio" name="display" value="No">公開しない
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
        <th scope="col" class="success">コンビニ受取</th>
        <td>
                <input class="form-check-input position-static" type="radio" name="delivery_to_convenience_store" value="Allow" />利用する

                   &nbsp;&nbsp;&nbsp;

                <input class="form-check-input position-static" type="radio" name="delivery_to_convenience_store" value="Deny" />利用しない
        </td>
    </tr>


    <tr>
        <th scope="col" class="success">同梱設定</th>
        <td>
            <div class="form-check">
            <input class="form-check-input position-static" type="radio" name="bundle_packing" value="Allow">利用する

               &nbsp;&nbsp;&nbsp;

            <input class="form-check-input position-static" type="radio" name="bundle_packing" value="Deny">利用しない
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
        <th scope="col" class="success" style="vertical-align:middle;">送料</th>
        <td>
            <input type="checkbox" id="check_mail" name="delivery_type" value="Mail" onclick="Mail_Delivery()"; />メール便

            &nbsp;&nbsp;&nbsp;

            <input type="checkbox" id="check_Standard" name="delivery_type" value="Standard" onclick="Standard_Delivery()"; />通常便



        <div id="Std_Delivery" style="display:none;">
            <hr />

            <p style="background:rgb(78, 241, 163); width:300px;">
                <b>アイスパック設定</b>
            </p>

            <input type="checkbox"  name="temparature_controlled" id="temparature_controlled_cold" value="Cold" onclick="temparature_Exception_cold()"/>冷蔵便<img src="./reizou.gif"/>

            <br />

            <input type="checkbox" name="temparature_controlled" id="temparature_controlled_freeze" value="Freeze" onclick="temparature_Exception_freeze()"/>冷凍便<img src="reitou.gif"/>

            <br />
            <hr />


            <p style="background:rgb(78, 241, 163); width:300px;">
                <b>特別送料設定</b>
            </p>


            <input type="checkbox" name="enable_specific_shipping_charge" value="Yes" id="enable_specific_shipping_charge"  onclick="enable_specific_shipping_charge_set()">

            <input type="text" class="form-controller col-md-2" name="specific_shipping_charge" id="specific_shipping_charge">&nbsp;(円)　

            <br />

            <p>
                <p style="background:rgb(78, 241, 163); width:300px;">
                    <b>★送料0円の場合</b>
                </p>

            <input class="form-check-input position-static" type="radio" name="display_type" value="Free">&nbsp; "無料配送" で表示

            &nbsp;&nbsp;&nbsp;

            <input class="form-check-input position-static" type="radio" name="display_type" value="Zero">&nbsp; "送料0円" で表示
            </p>

            <p>
                <input class="form-check-input position-static" type="radio" name="prior" value="Yes">&nbsp;
                ★この送料を優先する &nbsp;&nbsp;&nbsp;
            </p>


            <p style="background:rgb(78, 241, 163); width:300px;">
                <b>配送準備期間</b>
            </p>

            <input type="text" class="form-controller col-md-2"  name="shipping_preparation_period" id="shipping_preparation_period" placeholder = "0~365">日

        </td>
        </div>
    </tr>
    </thead>
</table>

        <br />

        <input type="submit" class= "btn btn-success btn-lg" value="該当の内容で商品登録" onclick="Register_Product()">
    </form>
</center>
