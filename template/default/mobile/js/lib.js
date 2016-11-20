(function() {
        lib = {
                s_earch:function(_type) {
                        var keyword = document.getElementById("keyword").value.replace(/\//g, "");
                        keyword = keyword.replace(/\\/g, "");
                        keyword = keyword.replace(/\?/g, "");
                        var _url = search_url.replace(/table/g, _type);
                        _url = _url.replace(/target/g, keyword);
                        if (keyword == "" || keyword == "ËÑË÷ÒôÀÖ" || keyword == "ËÑË÷×¨¼­" || keyword == "ËÑË÷¸èÊÖ" || keyword == "ËÑË÷ÊÓÆµ") {
                                document.getElementById("keyword").value = "";
                                document.getElementById("keyword").focus();
                                return;
                        } else {
                                location.href = _url;
                        }
                }
        };
})();
function getpage(now, last, down) {
	if (now == last) {
		document.getElementById("loaded").style.cursor = "";
		document.getElementById("loaded").innerHTML = "ÒÑ¼ÓÔØÈ«²¿";
	} else {
		location.href = down;
	}
}
function getplay(play) {
	if (play.match(/\.(swf)/g)) {
		object = "<embed src='" + play + "' quality='high' width='100%' height='334' align='middle' allowscriptaccess='always' allowfullscreen='true' type='application/x-shockwave-flash'></embed>";
	} else {
		object = "<video autoplay='autoplay' controls='controls' width='100%' src='" + play + "'></video>";
	}
	return object;
}