function UserSearch(){
    $.ajax({
        url:"./test4.php",
        type: "POST",
        data:{},
        dataType: "json",
        success : function(data){
            alert('yea!');
            console.log(data);
        }
    });
}
