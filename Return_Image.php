<header>
    <!-- bootstrap CDN Code Import-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</header>
<?php
    error_reporting(0);

    $USERID         =   "eat591.wc" ;
    $OPENKEY        =   "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
    $MANAGERKEY     =   "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
    $URL            =   "https://management.api.shopserve.jp/v2/images?size=100";

    $curl = curl_init($URL); // RESET
    $curl  =  curl_init($URL); // RESET
    curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//접속 권한을 가진 키 부여

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); //포스트 메소드로 넘김
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //데이터를 문자열로 직접출력
    curl_setopt($curl, CURLOPT_HTTPHEADER, 'Content-Type:application/json');

 $RESULT = curl_exec($curl);
 curl_close($curl);

$GetData  =  json_decode ( $RESULT , true );
?>


<center>
<table class="table table-striped">
    <tr>
        <th>
            画像
        </th>
        <th>
            画像名
        </th>
        <th>
            選択
        </th>
    </tr>
    <?php
    for($i = 0 ; $i < $GetData['total_count'] ; $i++ ){
        $img = $GetData['images'][$i]['image_name'];
        ?>

    <tr>
        <td>
            <img src = 'http://eat591.wc.shopserve.jp/pic-labo/<?=$img?>' style='width:50px;height:50px;'>
        </td>

        <td>
            <?=$img?>
        </td>

        <td>
            <button name="'<?=$img?>'" id="img_button" onclick="image_submit('<?=$img?>')">挿入</button>
        </td>
    </tr>
<?php } ?>

</table>


</center>

<script>

function image_submit(name){

    var text = "<img src='http://eat591.wc.shopserve.jp/pic-labo/"+name+"'style='width:50px; height:50px;'>";


             $("#image_insert", opener.document).empty();
             $("#image_insert", opener.document).append(text);


             // $("#image_name_check", opener.document).empty();
             // $("#image_name_check", opener.document).append(name);

             window.opener.document.RegisterForm.image_name_check.value=name;
             window.close();
}

</script>
