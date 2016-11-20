var createAjax = function() {
        var xhr = null;
        try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
                try {
                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                        xhr = new XMLHttpRequest();
                }
        }
        return xhr;
};
var ajax = function(conf) {
        var type = conf.type;
        var url = conf.url;
        var data = conf.data;
        var dataType = conf.dataType;
        var success = conf.success;
        if (type == null) {
                type = "get";
        }
        if (dataType == null) {
                dataType = "text";
        }
        var xhr = createAjax();
        xhr.open(type, url, true);
        if (type == "GET" || type == "get") {
                xhr.send(null);
        } else {
                if (type == "POST" || type == "post") {
                        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                        xhr.send(data);
                }
        }
        xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                        if (dataType == "text" || dataType == "TEXT") {
                                if (success != null) {
                                        success(xhr.responseText);
                                }
                        } else {
                                if (dataType == "xml" || dataType == "XML") {
                                        if (success != null) {
                                                success(xhr.responseXML);
                                        }
                                } else {
                                        if (dataType == "json" || dataType == "JSON") {
                                                if (success != null) {
                                                        success(eval("(" + xhr.responseText + ")"));
                                                }
                                        }
                                }
                        }
                } else {
                        if (xhr.readyState == 4 && xhr.status != 200) {}
                }
        };
};
var listenMsg = {
        nid:0,
        mid:0,
        gid:0,
        sleepTime:in_time,
        queryUrl:in_path + "source/plugin/webim/api/json.php",
        player:'<embed style="position:absolute;top:-100000px" width="0" height="0" type="application/x-shockwave-flash" swliveconnect="true" allowscriptaccess="sameDomain" menu="false" flashvars="sFile=' + in_path + 'source/plugin/webim/api/msg.mp3" src="' + in_path + 'source/plugin/webim/api/sound.swf" />',
        stop:function() {
                clearTimeout(listenMsg.nid);
                listenMsg.nid = 0;
                clearTimeout(listenMsg.mid);
                listenMsg.mid = 0;
                clearTimeout(listenMsg.gid);
                listenMsg.gid = 0;
                $(".message_box").text("");
        },
        start:function(_uid, _type, _do) {
                ajax({
                        type:"get",
                        url:listenMsg.queryUrl + "?ac=start&type=" + _type + "&do=" + _do + "&uid=" + _uid + "&sec=" + in_sec,
                        dataType:"json",
                        success:function(data) {
                                if (data["start"] == -1) {
                                        listenMsg.stop();
                                        $("#send_tips").text("您已下线");
                                        $(".chat03_content li b").text("");
                                        $(".chat03_content li label").removeClass("online offline").addClass("offline");
                                        if ($("#list_reload").hasClass("chat02_title_t")) {
                                                $("#list_reload").removeClass("chat02_title_t").addClass("chat002_title_t");
                                        }
                                } else {
                                        if (_type == "msg") {
                                                clearTimeout(listenMsg.mid);
                                                clearTimeout(listenMsg.gid);
                                                if (isNaN(data["start"])) {
                                                        $(".message_box").append(data["start"]);
                                                        $(".chat01_content").scrollTop($(".message_box").height());
                                                }
                                                listenMsg.mid = setTimeout("listenMsg.start(" + _uid + ", '" + _type + "', 0);", listenMsg.sleepTime);
                                        } else {
                                                if (data["status"] > 0) {
                                                        if ($("#uid_" + _uid + " label").hasClass("offline")) {
                                                                $("#uid_" + _uid + " label").removeClass("offline").addClass("online");
                                                        }
                                                } else {
                                                        if ($("#uid_" + _uid + " label").hasClass("online")) {
                                                                $("#uid_" + _uid + " label").removeClass("online").addClass("offline");
                                                        }
                                                }
                                                if (data["start"] > 0) {
                                                        $("#uid_" + _uid + " b").html(data["start"] + "<span>" + listenMsg.player + "</span>");
                                                        $(".chat03_content").animate({
                                                                scrollTop:$("#uid_" + _uid).offset().top - $(".chat03_content").offset().top
                                                        }, 100);
                                                } else {
                                                        $("#uid_" + _uid + " b").text("");
                                                }
                                                listenMsg.nid = setTimeout("listenMsg.start(" + _uid + ", '" + _type + "', 0);", listenMsg.sleepTime);
                                        }
                                }
                        }
                });
        },
        group:function(_num) {
                ajax({
                        type:"get",
                        url:listenMsg.queryUrl + "?ac=group&num=" + _num + "&nums=" + in_num,
                        dataType:"json",
                        success:function(data) {
                                if (data["group"] != -1) {
                                        clearTimeout(listenMsg.gid);
                                        if (data["num"] > _num) {
                                                $(".talkTo").attr("num", data["num"]);
                                                $(".message_box").append(data["group"]);
                                                $(".chat01_content").scrollTop($(".message_box").height());
                                        }
                                        listenMsg.gid = setTimeout("listenMsg.group(" + data["num"] + ");", listenMsg.sleepTime);
                                }
                        }
                });
        },
        load:function() {
                $(".chat03_content").html('<img src="' + in_path + 'static/user/images/loading.gif">');
                listenMsg.stop();
                listenMsg.group($(".talkTo").attr("num"));
                listenMsg.list();
                $(".talkTo a").text("公共频道");
                $(".talkTo a").attr("uid", 0);
        },
        list:function() {
                ajax({
                        type:"get",
                        url:listenMsg.queryUrl + "?ac=list&uid=" + in_uid,
                        dataType:"json",
                        success:function(data) {
                                $(".chat03_content").html(data["list"]);
                        }
                });
        },
        send:function() {
                if ($("#textarea").val() == "") {
                        $("#textarea").focus();
                        return;
                }
                ajax({
                        type:"get",
                        url:listenMsg.queryUrl + "?ac=send&text=" + escape($("#textarea").val()) + "&uname=" + escape($(".talkTo a").text()) + "&uid=" + $(".talkTo a").attr("uid"),
                        dataType:"json",
                        success:function(data) {
                                if (data["send"] == -1) {
                                        $("#send_tips").text("请先登录");
                                } else {
                                        $("#textarea").val("");
                                        if ($(".talkTo a").attr("uid") > 0) {
                                                listenMsg.start($(".talkTo a").attr("uid"), "msg", 1);
                                        } else {
                                                listenMsg.group($(".talkTo").attr("num"));
                                        }
                                }
                        }
                });
        }
};
(function() {
        lib = {
                press:function(_type, _id, _class) {
                        var key = navigator.appName == "Netscape" ? event.which :window.event.keyCode;
                        if (_type == "send" && key == 13) {
                                listenMsg.send();
                        } else if (_type == "value" && key == 27) {
                                var val = _id == "_img" ? "[img]" + $("#_img").val() + "[/img]" :"[flash]" + $("#_flash").val() + "[/flash]";
                                $("#textarea").val($("#textarea").val() + val);
                                $("#textarea").focus();
                                $("." + _class).hide();
                        }
                },
                doodle:function() {
                        $.layer({
                                type:1,
                                title:"涂鸦板",
                                area:[ "auto", "auto" ],
                                page:{
                                        html:'<embed src="' + in_path + 'source/pack/doodle/image/doodle.swf" width="438" height="304" wmode="transparent" type="application/x-shockwave-flash"></embed>'
                                }
                        });
                },
                upload:function(url) {
                        url = url.split(":");
                        ajax({
                                type:"get",
                                url:in_path + "source/plugin/" + url[0] + "/doodle_ajax.php?path=" + url[1],
                                dataType:"text",
                                success:function(data) {
                                        $("#textarea").val($("#textarea").val() + "[img]" + data + "[/img]");
                                        $("#textarea").focus();
                                        layer.closeAll();
                                }
                        });
                },
                shake:function(_size, _time, _id, _speed) {
                        var len = _size, c = _time, step = 0, shake = $("#" + _id), off = shake.offset();
                        this.step = 0;
                        timer = setInterval(function() {
                                var set = lib.pos();
                                shake.offset({
                                        top:off.top + set.y * len,
                                        left:off.left + set.x * len
                                });
                                if (step++ >= c) {
                                        shake.offset({
                                                top:off.top,
                                                left:off.left
                                        });
                                        clearInterval(timer);
                                }
                        }, _speed);
                },
                pos:function() {
                        this.step = this.step ? this.step :0;
                        this.step = this.step == 4 ? 0 :this.step;
                        var set = {
                                0:{
                                        x:0,
                                        y:-1
                                },
                                1:{
                                        x:-1,
                                        y:0
                                },
                                2:{
                                        x:0,
                                        y:1
                                },
                                3:{
                                        x:1,
                                        y:0
                                }
                        };
                        return set[this.step++];
                }
        };
})();
$(document).ready(function() {
        $("body").delegate(".chat03_content li", "mouseover", function() {
                $(this).addClass("hover").siblings().removeClass("hover");
        });
        $("body").delegate(".chat03_content li", "mouseout", function() {
                $(this).removeClass("hover").siblings().removeClass("hover");
        });
        $("body").delegate(".chat03_content li", "click", function() {
                $(this).addClass("choosed").siblings().removeClass("choosed");
                $(".talkTo a").text($(this).children(".chat03_name").text());
                $(".talkTo a").attr("uid", $(this).children(".chat03_name").attr("uid"));
                $(".message_box").text("");
                listenMsg.start($(this).children(".chat03_name").attr("uid"), "msg", 2);
        });
        $(".ctb01").mouseover(function() {
                $(".wl_faces_box").show();
        }).mouseout(function() {
                $(".wl_faces_box").hide();
        });
        $(".ctb08").mouseover(function() {
                $(".wl_faces_box8").show();
        }).mouseout(function() {
                $(".wl_faces_box8").hide();
        });
        $(".ctb02").mouseover(function() {
                $(".wl_faces_box2").show();
        }).mouseout(function() {
                $(".wl_faces_box2").hide();
        });
        $(".ctb03").mouseover(function() {
                $(".wl_faces_box3").show();
        }).mouseout(function() {
                $(".wl_faces_box3").hide();
        });
        $("#_shake").mouseover(function() {
                $("#_shake").removeClass("ctb04").addClass("ctb05");
        }).mouseout(function() {
                $("#_shake").removeClass("ctb05").addClass("ctb04");
        });
        $("#_shake").click(function() {
                $("#textarea").val($("#textarea").val() + "[event:shake]");
                $("#textarea").focus();
        });
        $(".ctb06").click(function() {
                lib.doodle();
        });
        $(".wl_faces_box").mouseover(function() {
                $(".wl_faces_box").show();
        }).mouseout(function() {
                $(".wl_faces_box").hide();
        });
        $(".wl_faces_box8").mouseover(function() {
                $(".wl_faces_box8").show();
        }).mouseout(function() {
                $(".wl_faces_box8").hide();
        });
        $(".wl_faces_box2").mouseover(function() {
                $(".wl_faces_box2").show();
        }).mouseout(function() {
                $(".wl_faces_box2").hide();
        });
        $(".wl_faces_box3").mouseover(function() {
                $(".wl_faces_box3").show();
        }).mouseout(function() {
                $(".wl_faces_box3").hide();
        });
        $(".wl_faces_close").click(function() {
                $(".wl_faces_box").hide();
        });
        $(".wl_faces_close8").click(function() {
                $(".wl_faces_box8").hide();
        });
        $(".wl_faces_close2").click(function() {
                $(".wl_faces_box2").hide();
        });
        $(".wl_faces_close3").click(function() {
                $(".wl_faces_box3").hide();
        });
        $(".close_btn").click(function() {
                $(".message_box").text("");
        });
        $(".wl_faces_main img").click(function() {
                var i = $(this).attr("src");
                $("#textarea").val($("#textarea").val() + "[emoji:" + i.substr(i.indexOf("api/") + 8, 2) + "]");
                $("#textarea").focus();
                $(".wl_faces_box").hide();
        });
});