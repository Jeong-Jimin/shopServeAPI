<?php
error_reporting(0);

$USERID      =  "eat591.wc" ;
$OPENKEY     =  "de6fd4b5809f583b6af49cb70b34182895de6ecd" ;
$MANAGERKEY  =  "e0c861280bb91d0ddd5893a5d696b13079ae1bc8" ;
$V2M0110     =  "https://management.api.shopserve.jp/v2/service-setup/item-categories/_get";


#1차 카테고리 뽑아냄
$Get_OrgDir      =  json_decode(curlPost($V2M0110, null),true);


//GetData안에 자식카테고리가 있으면 출력
//총 5번 loop
for($i = 0 ; $i < count($Get_OrgDir['child_categories']) ; $i++){

    if($Get_OrgDir['child_categories'][$i]['has_child_categories'] == "Yes"){

        $OrgDir = $Get_OrgDir['child_categories'][$i]['name'];

        $Ctg_Info  =  "{";
        $Ctg_Info .=  "\"top_category_path\":[";
        $Ctg_Info .=  "\"$OrgDir\"";
        $Ctg_Info .=  "]";
        $Ctg_Info .=  "}";

        #첫번째 자식 카테고리
      $First_serveDir[$i] = json_decode(curlPost($V2M0110, $Ctg_Info), true);

      // #for
      echo "First_serveDir<BR />";
      print_r($First_serveDir[$i]);
      echo"sfjlskjfldsjflk<BR />";
      echo "<BR />";




        #2차 자식 카테고리 데이터 취득
        if($First_serveDir[$i]['child_categories'][0]['has_child_categories'] == "Yes"){

          $Second_path = $First_serveDir[$i]['child_categories'][$i]['name'];

          $Ctg_Info  =  "{";
          $Ctg_Info .=  "\"top_category_path\":[";
          $Ctg_Info .=  "\"$OrgDir\",";
          $Ctg_Info .=  "\"$Second_path\"";
          $Ctg_Info .=  "]";
          $Ctg_Info .=  "}";

          $Second_serveDir[$i] = json_decode(curlPost($V2M0110, $Ctg_Info), true);

          echo $i."<br /><Br />";
          print_r($Second_serveDir[$i]);
          echo "====================================";
          echo "<BR />";
          echo "<BR />";

          if($Second_serveDir[0]['child_categories'][0]['has_child_categories'] == "Yes"){


            $Third_path = $Second_serveDir[$i]['child_categories'][$i]['name'];

            $Ctg_Info = "{";
            $Ctg_Info .=  "\"top_category_path\":[";
            $Ctg_Info .=  "\"$OrgDir\",";
            $Ctg_Info .=  "\"$Second_path\",";
            $Ctg_Info .=  "\"$Third_path\"";
            $Ctg_Info .=  "]";
            $Ctg_Info .=  "}";

            $Third_serveDir[$i] = json_decode(curlPost($V2M0110, $Ctg_Info), true);

            echo $i."<br /><Br />";
            print_r($Third_serveDir[$i]);
            echo "====================================";
            echo "<BR />";
            echo "<BR />";
          }
          else{
            break;
          }
        }

        else{
          break;
        }

        echo $First_serveDir[$i]['child_categories'][0]['full_path'][0];
        echo "<BR />";
        echo $First_serveDir[$i]['child_categories'][0]['full_path'][1];
        echo "<BR />";
        echo "<BR />";
    }

    else{ #자식카테고리가 없으면 for을 빠져나옴
      break;
    }
}


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

<br />
<br />


<!-------------------- 뽑아낸 카테고리 select함 ------------------------->


 <select name="item_category">
    <?php for($i = 0 ; $i< count($Get_OrgDir['child_categories']) ; $i++){?>
        <option value="<?=$Get_OrgDir['child_categories'][$i]['name']?>"><?=$Get_OrgDir['child_categories'][$i]['name']?></option>
        <?php } ?>


        <!-- <?php for($i = 0 ; $i < count($First_serveDir[$i]['child_categories']) ; $i++){?>
         <option>
         <?= $First_serveDir[$i]['child_categories'][$i]['full_path'][0]?>

         <?= $First_serveDir[$i]['child_categories'][$i]['full_path'][1]?>
         </option>
    <?php } ?> -->

</select>

    <br />
    <br />

<!--------------------  보내진 카테고리 curl로 전송 ------------------------->

<?php
$ITEM_CATEGORY;
$ITEM_CODE;


$V20029_URL = "https://management.api.shopserve.jp/v2/items/$ITEM_CODE/categories";

$CategoryInfo = "{";
        $CategoryInfo .=  "\"categories\":[";
        $CategoryInfo .=  "{\"category\":[\"$ITEM_CATEGORY\"]}";
        //카테고리 안 소분류도 처리 할 것
        $CategoryInfo .=  "]";
        $CategoryInfo .=  "}";

$curl = curl_init($V20029_URL); // RESET
curl_setopt($curl, CURLOPT_USERPWD, $USERID.":".$MANAGERKEY);//ACCESS KEY
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");//SEND TO PUT METHOD
curl_setopt($curl, CURLOPT_POSTFIELDS, $CategoryInfo);//SET SEARCH CONDITION


//DEFINE HEADER INFORMATION
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:　text/plain',
    'Content-Length:'.strlen($CategoryInfo))
);

echo "whiat!!!!! : ".$CategoryInfo;

//RUN cURL
$RESULT = curl_exec($curl);

//Return the error in case of an error
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

//cURL close
curl_close($curl);
 ?>
