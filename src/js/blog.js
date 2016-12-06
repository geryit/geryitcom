$( document ).ready(function() {
    $(".rotating").prepend("<span />").each(function () {

        var img = $(this).css("background-image");

        var span = $(">span", this).css("background-image", img).width($(this).width()).height($(this).height());

        $(this).hover(function () {

            span.stop().animate({
                opacity: 0
            }, 400);

        }, function () {

            span.stop().animate({
                opacity: 1
            }, 1000);

        });
    });
    $("#searchForm input[type=text]").focus(function () {
        if ($(this).val() == $(this).attr("title"))
            $(this).val("");
    }).blur(function () {
        if ($(this).val() == "")
            $(this).val($(this).attr("title"));
    });
    $("#searchForm a").click(function () {
        $("#searchForm").submit();
        return false;
    });

    var w = "4px";

    $("#blog .prev").hover(function () {
        $(this).animate({
            "background-position": "-=" + w
        }, "fast");
    }, function () {
        $(this).animate({
            "background-position": "+=" + w
        });
    });
    $("#blog .next").hover(function () {
        $(this).animate({
            "background-position": "+=" + w
        }, "fast");
    }, function () {
        $(this).animate({
            "background-position": "-=" + w
        });
    });

    //$("#blog h1").click(function(){window.location="/blog"});

    $("#single img").each(function () {
        if ($(this).width() == 120)
            $(this).parent("p").hide();
    });
    // $(".launch").click(function () {
    //     var href = $(this).attr("href");
    //     $("#getSite").height(function () {
    //         return $(this).height() - 45;
    //     })
    //     $("#getSite").attr("src", href);
    //     $("body,html").addClass("oyh");
    //     $("#back").fadeIn();
    //     $("#getSite").fadeIn();
    //     return false;
    // });
    $("#back a").click(function () {
        $("#getSite").fadeOut(function () {
            $(this).attr("src", "/loading.php");
            $(this).height(function () {
                return $(this).height() + 45;
            })
        });
        $("#back").fadeOut();
        $("body,html").removeClass("oyh");

        return false;
    });
})

