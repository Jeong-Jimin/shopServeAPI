
function Register_Product()
{
//item_code null Exception processing
  if ($("#item_code").val().length < 1 )
  {
    alert('商品番号は必須項目です');
    $("#item_code").focus();
    return false;
  }


//item_name input null Exception processing
    else if ($("#item_name").val().length < 1)
    {
      alert('商品名は必須項目です');
      $("#item_name").focus();
      return false;
    }

//item_price input null Exception processing
    else if ($("#item_price").val().length < 1)
    {
      alert('価格は必須項目です');
      $("#item_price").focus();
      return false;
    }

//item_price input string Exception processing(item_price is only number)
    else if (isNaN($("#item_price").val()))
    {
      alert('価格は数字のみ入力可能です');
      $("#item_price").focus();
      return false;
    }

//Exception Processing for item_price input over 99,999,999
    else if ($("#item_price").val()　> 99999999)
    {
      alert('99,999,999円以内の金額のみ入力可能です');
      $("#item_price").focus();
      return false;
    }

// //item_code duplicate Exception processing
  else if ($("#item_code").val() != "" )
  {
    var check = true;

        $.ajax({
    type: "POST",
    url: "./duplicate_Codecheck.php",
    data: { item_code: $("#item_code").val()},

    async:false,

//if return value is 200 or 404
    success: function(msg) {

    if(msg == 200){
        alert('すでに登録されている商品番号です');
        $("#item_code").focus();
        check = false;
      }

    }
  });
  return check;
  }
}


$(document).ready(function(){
  $('.disabled_check').click(function(){
  })
});


function Mail_Delivery(){
console.log('Mail');
    if($("#check_mail").prop('checked'))
    {

    //document.getElementById('Std_Delivery').style.display = "none";

    $("input:checkbox[id='check_Standard']").attr({'checked':false});

    $("input:checkbox[name='temperature_controlled']").attr({'disabled':true});
    $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':true});
    $("input:text[name='specific_shipping_charge']").attr({'disabled':true});
    $("input:checkbox[name='temperature_controlled']").attr({'checked':false});
    $("input:checkbox[name='enable_specific_shipping_charge']").attr({'checked':false});
    $("input:checkbox[name='display_type']").attr({'disabled':true});
    $("input:checkbox[name='display_type']").attr({'checked':false});
    $("input:checkbox[name='prior']").attr({'disabled':true});
    $("input:checkbox[name='prior']").attr({'checked':false});
    $("input:text[name='shipping_preparation_period']").attr({'disabled':true});
    $("#specific_shipping_charge").val("");
    $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':false});
    }


    else
        {
            $("input:checkbox[name='temperature_controlled']").attr({'disabled':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
            $("input:checkbox[name='display_type']").attr({'disabled':false});
            $("input:checkbox[name='prior']").attr({'disabled':false});
            $("input:text[name='shipping_preparation_period']").attr({'disabled':false});
            }


        }


function Standard_Delivery(){
    console.log('Standard');
    if($("#check_Standard").prop('checked'))
        {

             document.getElementById('Std_Delivery').style.display = "block";
            $("input:checkbox[id='check_mail']").attr({'checked':false});
            $("input:checkbox[name='temperature_controlled']").attr({'disabled':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
            $("input:checkbox[name='display_type']").attr({'disabled':false});
            $("input:checkbox[name='prior']").attr({'disabled':false});
            $("input:text[name='shipping_preparation_period']").attr({'disabled':false});
        }

    else{
            document.getElementById('Std_Delivery').style.display = "none";
            $("input:checkbox[name='temperature_controlled']").attr({'disabled':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
            $("input:checkbox[name='temperature_controlled']").attr({'checked':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'checked':false});
            $("input:checkbox[name='display_type']").attr({'disabled':false});
            $("input:checkbox[name='display_type']").attr({'checked':false});
            $("input:checkbox[name='prior']").attr({'disabled':false});
            $("input:checkbox[name='prior']").attr({'checked':false});
            $("input:text[name='shipping_preparation_period']").attr({'disabled':false});
            $("#specific_shipping_charge").val("");
            }
        }


function enable_specific_shipping_charge_set()
{
    if($("#enable_specific_shipping_charge").prop('checked'))
    {
        $("input:checkbox[name='display_type']").attr({'disabled':false});
        $("input:checkbox[name='prior']").attr({'disabled':false});
        $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
    }

    else
        {
            $("input:checkbox[name='display_type']").attr({'disabled':true});
            $("input:checkbox[name='prior']").attr({'disabled':true});
            $("input:checkbox[name='display_type']").attr({'checked':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':true});
            $("#specific_shipping_charge").val("");
        }
}

function temperature_Exception_cold()
{
    if($("#temperature_controlled_cold").prop('checked'))
    {
          $("input:checkbox[id='temperature_controlled_freeze']").attr({'checked':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':true});
        $("input:radio[name='delivery_to_convenience_store']").attr({'checked':false});
    }

    else
    {
         $("input:checkbox[id='temperature_controlled_freeze']").attr({'disabled':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':false});
    }
}


function temperature_Exception_freeze()
{
    if($("#temperature_controlled_freeze").prop('checked'))
    {
        $("input:checkbox[id='temperature_controlled_cold']").attr({'checked':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':true});
        $("input:radio[name='delivery_to_convenience_store']").attr({'checked':false});
    }

    else
    {
        $("input:checkbox[id='temperature_controlled_cold']").attr({'disabled':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':false});
    }
}


function get_image_name(){
    $("#image_name").val("");
}
