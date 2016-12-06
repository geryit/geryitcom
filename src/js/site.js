$(function () {
    geryit.ready();
})
//Namespace
var geryit = {
    /* onload*/
    ready: function () {
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
        $("#menu li").each(function () {
            $(this).prepend('<p class="p1">&nbsp;</p>').append('<p class="p2">&nbsp;</p>').css("padding", "0");
        });
        $("#menu ul li .p1").css("background-position", "16px 0px");
        $("#menu ul li .p2").css("background-position", "-16px 0px");
        $("#menu ul li").hover(function () {
            $(".p1", this).animate({
                "background-position": "4px 0px"
            }, {
                duration: 200,
                queue: false
            });
            $(".p2", this).animate({
                "background-position": "0px 0px"
            }, {
                duration: 200,
                queue: false
            });
        }, function () {
            $(this).parent().find(".p1").animate({
                "background-position": "16px 0px"
            }, {
                duration: 200,
                queue: false
            });
            $(this).parent().find(".p2").animate({
                "background-position": "-16px 0px"
            }, {
                duration: 200,
                queue: false
            });
        });
        if ($("#works,#code-samples").length) {
            $("#workList article").each(function (i) {
                if (i % 4 == 0)
                    $(this).addClass("alpha");
                if (i % 4 == 3)
                    $(this).addClass("omega");
                var ss = $(this).find(".ss");
                var im = $(this).find(".innerMask");
                var launch = $(this).find(".launch");
                var imDh = im.height();
                $(this).hover(function () {
                    ss.animate({
                        marginTop: "-=140px"
                    }, {
                        queue: false
                    });
                    im.animate({
                        height: "282px"
                    }, {
                        queue: false
                    });
                }, function () {
                    ss.animate({
                        marginTop: "0px"
                    }, {
                        queue: false
                    });
                    im.animate({
                        height: imDh + "px"
                    }, {
                        queue: false
                    });
                });
                launch.css("background-position", "60px 7px");
                launch.hover(function () {
                    $(this).animate({
                        backgroundPosition: "65px 7px"
                    }, {
                        duration: 200,
                        queue: false
                    });
                }, function () {
                    $(this).animate({
                        backgroundPosition: "60px 7px"
                    }, {
                        duration: 600,
                        queue: false
                    });
                });
            });
            $(".mask>.tags").each(function () {
                $(this).parent().find(".innerMask .tags:first").html($(this).html());
            });
            $("#workList .innerMask .tags a").click(function () {
                var text = $(this).text().toLowerCase();
                $("#workList article").each(function () {
                    var text2 = $(this).find(".tags").text().toLowerCase();
                    if (text2.indexOf(text) < 0 && !ie)
                        $(this).stop(true).animate({
                            opacity: 0.1
                        }, {
                            duration: 300
                        }).animate({
                            opacity: 0.1
                        }, {
                            duration: 5000
                        }).animate({
                            opacity: 1
                        }, {
                            duration: 300
                        });
                    else
                        $(this).stop().animate({
                            opacity: 1
                        }, {
                            duration: 300
                        });
                });
                return false;
            });
            // $(".launch").click(function () {
            //     var href = $(this).attr("href");
            //     $("#getSite").height(function () {
            //         return $(this).height() - 45;
            //     })
            //     $("#getSite").attr("src", href);
            //     $("body").addClass("oyh");
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
                $("body").removeClass("oyh");
                return false;
            });
        }
        $("#info .arr").animate({
            height: "205px"
        }, "slow");
        $("#contactForm p > *").focus(function () {
            $(this).prev().stop().fadeOut();
            if ($(this).val() == $(this).attr("title"))
                $(this).val("");
        }).blur(function () {
            if ($(this).val() == "")
                $(this).val($(this).attr("title"));
        });
        var sent = 0;
        var loader = $("#contactForm #loader");
        $("#contactForm .submit").click(function () {
            $("#contactForm").submit();
            return false;
        });
        $("#contactForm").submit(function () {
            if (!sent) {
                window.error = 0;
                window.contactData = "act=contactForm";
                loader.animate({
                    opacity: 1
                });
                $("#contactForm [name=subject]").checkField();
                $("#contactForm [name=name]").checkField();
                $("#contactForm [name=email]").checkField("email");
                $("#contactForm [name=msg]").checkField();
                if (window.error == 0) {
                    sent = 1;
                    $.ajax({
                        type: "POST",
                        url: "/ajax.php",
                        data: window.contactData,
                        success: function (msg) {
                            $("#contactForm").animate({
                                height: "60px"
                            }, function () {
                                $(this).html("<p id='sent' >Thanks for writing. I'll be in touch.</p>");
                            });
                        }
                    });
                }
                loader.animate({
                    opacity: 0
                });
                return false;
            }
        });

        if ($("#home").length) {
            /*Begin JSON */
            /* Begin get last tweet */
//			$.getJSON('http://twitter.com/statuses/user_timeline/geryit.json?callback=?', function(data) {
//				var html = "<b><a href='http://twitter.com/geryit/status/" + data[0].id_str + "'>" + geryit.relative_time(data[0].created_at) + "</a></b> " + geryit.linkify(data[0].text);
//				$("#twitterPost article").html(html);
//			});
            /* End get last tweet */
            /* Begin get posts from blog */
            $.getJSON('https://geryit.com/blog/feed/?feed=json&jsonp=?', function (data) {
                var html = "";
                for (i = 0; i < 3; i++) {
                    var title = data[i].title;
                    if (title.length > 45)
                        title = title.substr(0, 45) + "...";
                    html += '<dd><a href="/blog/?p=' + data[i].id + '">' + title + '</a></dd>';
                }
                $("#blogPosts article").html('<dl>' + html + '</dl>');
            });
            /* End get posts from blog */
            /*End JSON */
        }
        // $('#cycle_slide').cycle({
        //     fx: 'fade'
        // });
    }
    ,
    /* convert to link for twitter widget*/
    linkify: function (txt) {
        var regexp = /((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;
        return txt.replace(regexp, '<a href="$1">$1</a>');
    }
    ,
    /* time left function for twitter widget*/
    relative_time: function (time_value) {
        var values = time_value.split(" ");
        time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
        var parsed_date = Date.parse(time_value);
        var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
        var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
        delta = delta + (relative_to.getTimezoneOffset() * 60);
        var r = '';
        if (delta < 60) {
            r = 'a minute ago';
        } else if (delta < 120) {
            r = 'couple of minutes ago';
        } else if (delta < (45 * 60)) {
            r = (parseInt(delta / 60)).toString() + ' minutes ago';
        } else if (delta < (90 * 60)) {
            r = 'an hour ago';
        } else if (delta < (24 * 60 * 60)) {
            r = '' + (parseInt(delta / 3600)).toString() + ' hours ago';
        } else if (delta < (48 * 60 * 60)) {
            r = '1 day ago';
        } else {
            r = (parseInt(delta / 86400)).toString() + ' days ago';
        }
        return r;
    }
    ,
    highlight: function (tag) {
        if ($.browser.msie)
            var ie = 1;
        $("#workList article").each(function () {
            var text2 = $(this).find(".tags").text().toLowerCase();
            if (text2.indexOf(tag) < 0 && !ie)
                $(this).stop(true).animate({
                    opacity: 0.1
                }, {
                    duration: 500
                }).animate({
                    opacity: 0.1
                }, {
                    duration: 7000
                }).animate({
                    opacity: 1
                }, {
                    duration: 500
                });
            else
                $(this).stop().animate({
                    opacity: 1
                }, {
                    duration: 500
                });
        });
        return false;
    }
}
/* check fields */
jQuery.fn.checkField = function (type) {
    var error = 0;
    $(this).prev().fadeOut();
    if ($(this).val().length < 3 || $(this).val() == $(this).attr("title")) {
        error = 1;
    } else if (type == "email" && ($(this).val().length < 7 || $(this).val().indexOf("@") < 1 || ($(this).val().indexOf("@") + 2) > $(this).val().lastIndexOf(".") || $(this).val().lastIndexOf(".") > ($(this).val().length - 2))) {
        error = 1;
    }
    if (error == 1) {
        window.error = 1;
        $(this).prev().fadeIn().delay(3000).fadeOut();
    }
    window.contactData += "&" + $(this).attr("name") + "=" + $(this).val();
}

