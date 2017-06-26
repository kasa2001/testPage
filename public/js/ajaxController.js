$(document).ready(function () {
    var zmienna = window.location.href.split("/");
    $("form").submit(function(){
        return false;
    });
    if (zmienna[zmienna.length - 1] === "modify" && zmienna[zmienna.length - 2] === "user") {
        $("button").on("click",function () {
            $.post("/PTW/public/api/sendModify", function(data){
                alert("Prawdopodobnie udało się");
            });
        });
    } else if (zmienna[zmienna.length - 1] === "add" && zmienna[zmienna.length - 2] === "user") {
        $("button").on("click",function () {
            $.post("/PTW/public/api/sendInsert",{text: $("#text").val()}, function(data, status){
                alert(status+"! Data is sent to database");
            });
        });
    } else if (zmienna[zmienna.length - 1] === "delete" && zmienna[zmienna.length - 2] === "user") {
        $("button").on("click",function () {
            $.post("/PTW/public/api/sendDelete", function (data, status) {
                alert(status);
            });
        });
    }
});