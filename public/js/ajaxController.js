$(document).ready(function () {
    var zmienna = window.location.href.split("/");
    $("form").submit(function(){
        return false;
    });
    if (zmienna[zmienna.length - 1] === "modify" && zmienna[zmienna.length - 2] === "user") {
        $("button").on("click",function () {
            if ($(this).html()==="Edit"){
                replace(this);
            }else{
                revert(this);
                var here=$(this).parent().parent().children();
                $.post("/PTW/public/api/sendModify", {id: here.eq(0).text(),content:here.eq(1).text()}, function(data, status){
                    alert(data);
                });
            }
        });
    } else if (zmienna[zmienna.length - 1] === "add" && zmienna[zmienna.length - 2] === "user") {
        $("button").on("click",function () {
            $.post("/PTW/public/api/sendInsert",{text: $("#text").val()}, function(data, status){
                alert(status+"! Data is sent to database");
            });
        });
    } else if (zmienna[zmienna.length - 1] === "delete" && zmienna[zmienna.length - 2] === "user") {
        $("button").on("click",function () {
            $(this).parent().parent().remove();
            $.post("/PTW/public/api/sendDelete", {id: $(this).data("id")},function (data, status) {
                alert(status+"! Data deleted from database");
            });
        });
    }
    function replace(object) {
        var here=$(object).parent().parent().children();
        var inThis = here.eq(1);
        var template = inThis.html();
        inThis.html("<input value='"+ template +"'>");
        here.last().children().html("Save");
    }
    function revert(object){
        var here=$(object).parent().parent().children();
        var inThis = here.eq(1);
        var template = inThis.children().val();
        inThis.html(template);
        here.last().children().html("Edit");
    }
});