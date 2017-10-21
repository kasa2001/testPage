$(document).ready(function(){
    $("form").submit(function () {
        if ($(this).children().eq(2).val()!==$(this).children().eq(3).val()){
            alert("Wrong password in repeat password input");
            return false;
        }
    });
});