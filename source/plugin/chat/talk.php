<?php
if(!defined('IN_ROOT')){exit('Access denied');}
include 'source/admincp/include/function.php';
Administrator(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>����վȺ</title>
<link href="<?php echo IN_PATH; ?>static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo IN_PATH; ?>source/plugin/chat/api/chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
var in_path = "<?php echo IN_PATH; ?>";
var in_info = "<?php echo str_replace(array(auth_codes('aHR0cDovL3d3dy5lYXJjbXMuY29tLz9oPQ==', 'de'), auth_codes($_SERVER['PHP_SELF'])), array('?ac=login&h=', auth_codes(IN_PATH)), $develop_auth); ?>";
var in_server = "\u0077\u0077\u0077\u002e\u0065\u0061\u0072\u0063\u006d\u0073\u002e\u0063\u006f\u006d";
var in_avatar = "?ucapi=http%3A%2F%2F" + in_server + "%2Fsource%2Fpack%2Fupload%2Favatar.php&input=uid%3D";
layer.use('confirm-ext.js');
</script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/upload/swfobject.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>source/plugin/chat/api/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>source/plugin/chat/api/chat.js"></script>
</head>
<body>
<div class="container">
	<div class="infobox">
		<div class="chatBox" id="content">
			<div class="chatLeft">
				<div class="chat01">
					<div class="chat01_title">
						<span style="display:none" uid=""></span>
						<ul class="talkTo" num="0">
							<li><a uid=""></a></li>
						</ul>
						<a class="close_btn" title="����"></a>
					</div>
					<div class="chat01_content">
						<div class="message_box">
						</div>
					</div>
				</div>
				<div class="chat02">
					<div class="chat02_title">
						<a class="chat02_title_btn ctb00" id="_emoji"></a>
						<a class="chat02_title_btn ctb07" id="_record"></a>
						<a class="chat02_title_btn ctb02"></a>
						<a class="chat02_title_btn ctb03"></a>
						<a class="chat02_title_btn ctb04" id="_shake" title="���ڶ���"></a>
						<a class="chat02_title_btn ctb09" id="_upload" title="�����ļ�"><input type="file" name="uploadify" id="uploadify" /></a>
						<a class="chat02_title_btn ctb06" title="����ͷ��"></a>
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
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_01.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_02.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_03.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_04.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_05.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_06.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_07.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_08.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_09.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_10.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_11.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_12.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_13.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_14.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_15.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_16.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_17.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_18.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_19.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_20.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_21.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_22.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_23.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_24.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_25.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_26.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_27.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_28.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_29.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_30.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_31.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_32.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_33.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_34.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_35.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_36.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_37.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_38.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_39.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_40.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_41.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_42.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_43.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_44.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_45.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_46.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_47.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_48.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_49.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_50.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_51.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_52.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_53.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_54.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_55.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_56.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_57.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_58.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_59.gif"></a></li>
										<li><a href="javascript:;"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/emo_60.gif"></a></li>
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
								<object id="as_js" type="application/x-shockwave-flash" width="100%" height="100%"><param name="movie" value="<?php echo IN_PATH; ?>static/pack/upload/record.swf" /><param name="wmode" value="transparent"/></object>
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
							<li style="right:5px;top:5px"><a onclick="listenMsg.send();" style="cursor:pointer"><img src="<?php echo IN_PATH; ?>source/plugin/chat/api/send_btn.jpg"></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="chatRight">
				<div class="chat03">
					<div class="chat03_title">
						<span class="chat03_title_t">վ���б�</span>
						<label class="chat02_title_t" title="ˢ���б�" id="list_reload"></label>
					</div>
					<div class="chat03_content">
						<script type="text/javascript">listenMsg.login();</script>
					</div>
				</div>
			</div>
			<div style="clear: both;">
			</div>
		</div>
	</div>
</div>
</body>
</html>