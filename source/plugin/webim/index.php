<?php
if(!defined('IN_ROOT')){exit('Access denied');}
global $userlogined,$erduo_in_userid;
if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();}
include 'source/plugin/webim/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>��ʱͨѶ - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>source/plugin/webim/api/chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var in_time = <?php echo in_plugin_webim_time; ?>;
var in_num = <?php echo in_plugin_webim_num; ?>;
var in_sec = <?php echo in_plugin_webim_sec; ?>;
var in_uid = <?php echo $erduo_in_userid; ?>;
</script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>source/plugin/webim/api/chat.js"></script>
<script type="text/javascript">
function setDoodle(fid, oid, url, tid, from) {
	if (url.match(/^(http:\/\/)/g)){
		$("#textarea").val($("#textarea").val() + "[img]" + url + "[/img]");
		$("#textarea").focus();
		layer.closeAll();
	}else{
		lib.upload(url);
	}
}
function f_getURL() {
	return in_path + 'source/pack/upload/save.php';
}
function f_getMAX() {
	return 60;
}
function f_getMIN() {
	return 3;
}
function f_complete(filename) {
	if (filename == 'error'){
		$("#textarea").val($("#textarea").val() + "[��������ʧ��]");
	}else{
		$("#textarea").val($("#textarea").val() + "[record:" + filename.substr(9, filename.length - 13) + "]");
	}
	$("#textarea").focus();
	$(".wl_faces_box8").hide();
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>source/plugin/webim/icon.jpg">��ʱͨѶ</h2>
<?php if(in_plugin_webim_open){ ?>
<div id="content" style="width:732px">
	<div class="c_mgs">
		<div class="chatBox">
			<div class="chatLeft">
				<div class="chat01">
					<div class="chat01_title">
						<ul class="talkTo" num="0">
							<li><a uid=""></a></li>
						</ul>
						<a class="close_btn" title="����"></a>
					</div>
					<div class="chat01_content">
						<div class="message_box"></div>
					</div>
				</div>
				<div class="chat02">
					<div class="chat02_title">
						<a class="chat02_title_btn ctb01"></a>
						<a class="chat02_title_btn ctb08"></a>
						<a class="chat02_title_btn ctb02"></a>
						<a class="chat02_title_btn ctb03"></a>
						<a class="chat02_title_btn ctb04" id="_shake" title="���ڶ���"></a>
						<a class="chat02_title_btn ctb06" title="Ϳѻ��"></a>
						<div class="wl_faces_box">
							<div class="wl_faces_content">
								<div class="title">
									<ul>
										<li class="title_name">ѡ�����</li>
										<li class="wl_faces_close"><span>&nbsp;</span></li>
									</ul>
								</div>
								<div class="wl_faces_main">
									<ul>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_01.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_02.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_03.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_04.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_05.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_06.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_07.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_08.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_09.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_10.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_11.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_12.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_13.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_14.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_15.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_16.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_17.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_18.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_19.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_20.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_21.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_22.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_23.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_24.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_25.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_26.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_27.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_28.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_29.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_30.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_31.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_32.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_33.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_34.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_35.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_36.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_37.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_38.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_39.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_40.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_41.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_42.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_43.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_44.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_45.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_46.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_47.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_48.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_49.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_50.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_51.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_52.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_53.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_54.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_55.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_56.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_57.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_58.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_59.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/emo_60.gif"></a></li>
									</ul>
								</div>
							</div>
							<div class="wlf_icon">
							</div>
						</div>
						<div class="wl_faces_box8">
							<div class="wl_faces_content8">
								<div class="title">
									<ul>
										<li class="title_name">��������</li>
										<li class="wl_faces_close8"><span>&nbsp;</span></li>
									</ul>
								</div>
								<object id="as_js" type="application/x-shockwave-flash" width="100%" height="100%"><param name="movie" value="<?php echo IN_PATH; ?>static/pack/upload/record.swf" /><param name="wmode" value="transparent" /></object>
							</div>
							<div class="wlf_icon">
							</div>
						</div>
						<div class="wl_faces_box2">
							<div class="wl_faces_content2">
								<div class="title">
									<ul>
										<li class="title_name">����ͼƬ</li>
										<li class="wl_faces_close2"><span>&nbsp;</span></li>
									</ul>
								</div>
								<textarea id="_img" onkeydown="lib.press('value', this.id, 'wl_faces_box2');" onfocus="javascript:if('�� Esc ������'==this.value)this.value=''" onblur="javascript:if(''==this.value)this.value='�� Esc ������'">�� Esc ������</textarea>
							</div>
							<div class="wlf_icon">
							</div>
						</div>
						<div class="wl_faces_box3">
							<div class="wl_faces_content3">
								<div class="title">
									<ul>
										<li class="title_name">������Ƶ</li>
										<li class="wl_faces_close3"><span>&nbsp;</span></li>
									</ul>
								</div>
								<textarea id="_flash" onkeydown="lib.press('value', this.id, 'wl_faces_box3');" onfocus="javascript:if('�� Esc ������'==this.value)this.value=''" onblur="javascript:if(''==this.value)this.value='�� Esc ������'">�� Esc ������</textarea>
							</div>
							<div class="wlf_icon">
							</div>
						</div>
					</div>
					<div class="chat02_content">
						<textarea id="textarea" onkeydown="lib.press('send', 0, 0);"></textarea>
					</div>
					<div class="chat02_bar">
						<ul>
							<li id="send_tips" style="right:100px;top:10px">�� Enter ����ݷ���</li>
							<li style="right:5px;top:5px"><a onclick="listenMsg.send();" style="cursor:pointer"><img src="<?php echo IN_PATH; ?>source/plugin/webim/api/send_btn.jpg"></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="chatRight">
				<div class="chat03">
					<div class="chat03_title">
						<label class="chat03_title_t">�û��б�</label>
						<label class="chat02_title_t" title="ˢ���б�" id="list_reload" onclick="listenMsg.load();"></label>
					</div>
					<div class="chat03_content"><script type="text/javascript">listenMsg.load();</script></div>
				</div>
			</div>
			<div style="clear: both;">
			</div>
		</div>
	</div>
</div>
<?php }else{ ?>
<div class="showmessage"><div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">
<caption><h2>��Ϣ��ʾ</h2></caption>
<p>��Ǹ���ò����δ������</p>
</div></div></div></div></div>
<?php } ?>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>