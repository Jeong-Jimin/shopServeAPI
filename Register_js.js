
$(document).ready(function(){
  $('.disabled_check').click(function(){

  })
});

function Register_Product()
{
    $("#RegisterForm").attr("action", "./Register_Product.php");
}



function Mail_Delivery(){
console.log('Mail');
    if($("#check_mail").prop('checked'))
    {

     document.getElementById('Std_Delivery').style.display = "none";

    $("input:checkbox[id='check_Standard']").attr({'checked':false});

    $("input:checkbox[name='temparature_controlled']").attr({'disabled':true});
    $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':true});
    $("input:text[name='specific_shipping_charge']").attr({'disabled':true});
    $("input:checkbox[name='temparature_controlled']").attr({'checked':false});
    $("input:checkbox[name='enable_specific_shipping_charge']").attr({'checked':false});
    $("input:radio[name='display_type']").attr({'disabled':true});
    $("input:radio[name='display_type']").attr({'checked':false});
    $("input:radio[name='prior']").attr({'disabled':true});
    $("input:radio[name='prior']").attr({'checked':false});
    $("input:text[name='shipping_preparation_period']").attr({'disabled':true});
    $("#specific_shipping_charge").val("");
    }


    else
        {

            console.log('Mail unchecked');
            $("input:checkbox[name='temparature_controlled']").attr({'disabled':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
            $("input:radio[name='display_type']").attr({'disabled':false});
            $("input:radio[name='prior']").attr({'disabled':false});
            $("input:text[name='shipping_preparation_period']").attr({'disabled':false});
            }


        }


function Standard_Delivery(){
    console.log('Standard');
    if($("#check_Standard").prop('checked'))
        {

             document.getElementById('Std_Delivery').style.display = "block";
            $("input:checkbox[id='check_mail']").attr({'checked':false});
            $("input:checkbox[name='temparature_controlled']").attr({'disabled':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
            $("input:radio[name='display_type']").attr({'disabled':false});
            $("input:radio[name='prior']").attr({'disabled':false});
            $("input:text[name='shipping_preparation_period']").attr({'disabled':false});
        }

    else{
            // document.getElementById('Std_Delivery').style.display = "none";
            $("input:checkbox[name='temparature_controlled']").attr({'disabled':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'disabled':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
            $("input:checkbox[name='temparature_controlled']").attr({'checked':false});
            $("input:checkbox[name='enable_specific_shipping_charge']").attr({'checked':false});
            $("input:radio[name='display_type']").attr({'disabled':false});
            $("input:radio[name='display_type']").attr({'checked':false});
            $("input:radio[name='prior']").attr({'disabled':false});
            $("input:radio[name='prior']").attr({'checked':false});
            $("input:text[name='shipping_preparation_period']").attr({'disabled':false});
            $("#specific_shipping_charge").val("");
            }
        }


function enable_specific_shipping_charge_set()
{
    if($("#enable_specific_shipping_charge").prop('checked'))
    {
        $("input:radio[name='display_type']").attr({'disabled':false});
        $("input:radio[name='prior']").attr({'disabled':false});
        $("input:text[name='specific_shipping_charge']").attr({'disabled':false});
    }

    else
        {
            $("input:radio[name='display_type']").attr({'disabled':true});
            $("input:radio[name='prior']").attr({'disabled':true});
            $("input:radio[name='display_type']").attr({'checked':false});
            $("input:text[name='specific_shipping_charge']").attr({'disabled':true});
            $("#specific_shipping_charge").val("");
        }
}

function temparature_Exception_cold()
{
    if($("#temparature_controlled_cold").prop('checked'))
    {
          $("input:checkbox[id='temparature_controlled_freeze']").attr({'checked':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':true});
        $("input:radio[name='delivery_to_convenience_store']").attr({'checked':false});
    }

    else
    {
         $("input:checkbox[id='temparature_controlled_freeze']").attr({'disabled':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':false});
    }
}


function temparature_Exception_freeze()
{
    if($("#temparature_controlled_freeze").prop('checked'))
    {
        $("input:checkbox[id='temparature_controlled_cold']").attr({'checked':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':true});
        $("input:radio[name='delivery_to_convenience_store']").attr({'checked':false});
    }

    else
    {
        $("input:checkbox[id='temparature_controlled_cold']").attr({'disabled':false});
        $("input:radio[name='delivery_to_convenience_store']").attr({'disabled':false});
    }
}
