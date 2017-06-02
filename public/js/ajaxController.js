$(document).ready(function () {

    var zmienna = window.location.href.split("/");
    if (zmienna[zmienna.length - 1] === "modify" && zmienna[zmienna.length - 2] === "user") {

    } else if (zmienna[zmienna.length - 1] === "add" && zmienna[zmienna.length - 2] === "user") {

    } else if (zmienna[zmienna.length - 1] === "select" && zmienna[zmienna.length - 2] === "user") {
        alert(window.location.href);
        $("button").on("click",function () {
            alert("działczy");
            $.post("/PTW/public/API/sendSelect", function(id){
                alert("Czy ajax wlazł sobie?");
                alert(id);
            });
        });
    } else if (zmienna[zmienna.length - 1] === "delete" && zmienna[zmienna.length - 2] === "user") {

    }
});