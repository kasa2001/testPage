$(document).ready(function () {
    var zmienna = window.location.href.split("/");
    $("form").submit(function () {
        return false;
    });
    if (zmienna[zmienna.length - 1] === "modify" && zmienna[zmienna.length - 2] === "user") {
        $("td > button").on("click", function () {
            if ($(this).html() === "Edit") {
                replace(this);
            } else {
                revert(this);
                var here = $(this).parent().parent().children();
                $.post("/PTW/api/sendModify", {
                    id: here.eq(0).text(),
                    data: here.eq(1).text(),
                    title: here.eq(5).text(),
                    alias: here.eq(4).text()
                }, function (data, status) {
                    alert(status + "! Data is modified");
                    here.eq(3).load("/PTW/api/sendSelect", {id: here.eq(0).text()});
                });
            }
        });
    } else if (zmienna[zmienna.length - 1] === "add" && zmienna[zmienna.length - 2] === "user") {
        $("form > button").on("click", function () {
            $.post("/PTW/api/sendInsert", {text: $("#text").val()}, function (data, status) {
                alert(status + "! Data is sent to database");
            });
        });
    } else if (zmienna[zmienna.length - 1] === "delete" && zmienna[zmienna.length - 2] === "user") {
        $("td > button").on("click", function () {
            var temporary = $(this).parent().parent();
            $.post("/PTW/api/sendDelete", {id: $(this).data("id")}, function (data, status) {
                alert(status + "! Data deleted from database");
                if (temporary.parent().children().length === 1) {
                    temporary.parent().parent().parent().html("<p>No data</p>");
                } else {
                    temporary.remove();
                }

            });
        });
    }

    function replace(object) {
        var here = $(object).parent().parent().children();
        var inThis = here.eq(1);
        var title = here.eq(4);
        var alias = here.eq(5);
        var template = inThis.html();
        inThis.html("<input value='" + template + "'>");
        template = title.html();
        title.html("<input value='" + template + "'>");
        template = alias.html();
        alias.html("<input value='" + template + "'>");
        here.last().children().html("Save");
    }

    function revert(object) {
        var here = $(object).parent().parent().children();
        var inThis = here.eq(1)
        ;var title = here.eq(4);
        var alias = here.eq(5);
        var template = inThis.children().val();
        inThis.html(template);
        template = title.children().val();
        title.html(template);
        template = alias.children().val();
        alias.html(template);
        here.last().children().html("Edit");
    }
});