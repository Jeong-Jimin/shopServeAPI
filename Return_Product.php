<?php
error_reporting(0); ?>
<head>

    <!-- bootstrap CDN Code Import-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



     <style>

     table{
       table-layout: fixed;
     }

     th {
       font-size: 20px;
       text-align: center;
     }

     td {
       font-size: 15px;
       text-align: center;
     }

     </style>

</head>

<?php

 $USERID        =   "eat591.wc" ;
 $OPENKEY       =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
 $MANAGERKEY    =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
 $URL           =   "https://management.api.shopserve.jp/v2/items/_search";

//User Search Condition
 // $MAIL_ADDRESS  =   $_POST[''];
 // $ACCOUNT       =   $_POST[''];
 // $NAME          =   $_POST[''];
 // $NAME_KANA     =   $_POST[''];


//검색하고자 하는 옵션을 배열에 넣는다
 $searchCondition = array
 (
     'mail_address'     =>  '',
     'account'          =>  '',
     'name'             =>  '',
     'name_kana'        =>  ''
 );


//만든 배열을 json_encode()을 이용해 string형태로 바꾼 후 외부에 전달
$searchCondition = json_encode($searchCondition, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);


 $curl  =  curl_init($URL); // RESET
 curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여
 curl_setopt($curl, CURLOPT_POST, 1); //포스트 메소드로 넘김
 curl_setopt($curl, CURLOPT_POSTFIELDS, $searchCondition);//검색옵션(POST메소드를 통해 보낼 값)을 지정한다
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //데이터를 문자열로 직접출력


//cURL을 실행 및 화면에 출력한다
 $RESULT  =  curl_exec($curl);

//ERROR의 경우, 해당 ERROR를 반환한다
 if(curl_errno($curl))
{
     throw new Exception(curl_error($curl));
}

 //cURL실행종료
 curl_close($curl);


//json_decode()로 데이터 취득
$GetData  =  json_decode ( $RESULT , true );

//print_r($GetData);


echo "<br />";
//배열 출력・값 가공
 ?>

 <center>
 <input type="button" value="新規商品登録" onclick="Register_Product()">
 </center>


<div id="userTable" style="width:auto; height: auto; margin:0 auto;">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">商品番号</th>
          <th scope="col">商品名</th>
          <th scope="col">販売価格</th>
          <th scope="col">商品メモ</th>
          <th scope="col">商品在庫</th>
        </tr>
      </thead>

      <tbody>
     <?php

     for($i = 0 ; $i < $GetData['total_count'] ; $i++) {?>
      <tr>
      <td>
        <?=$GetData['contents'][$i]['item_code']?>
      </td>

        <td><?=$GetData['contents'][$i]['item_name']?></td>
        <td><?=$GetData['contents'][$i]['item_price']?></td>
          <td><?=$GetData['contents'][$i]['memo']?></td>
            <td><?=$GetData['contents'][$i]['stock']['quantity']?></td>

      </tr>

      <?php
      }?>
 </tbody>
      </table>
</div>



<script>
function Register_Product()
{
    window.location.href = './Register_Form.php';
}
</script>
