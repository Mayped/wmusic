function createXMLHttpRequest() {
	try {
		XMLHttpReq = new ActiveXObject('Msxml2.XMLHTTP');
	} catch(e) {
		try {
			XMLHttpReq = new ActiveXObject('Microsoft.XMLHTTP');
		} catch(e) {
			XMLHttpReq = new XMLHttpRequest();
		}
	}
}
function getHttpObject() {
	var objType = false;
	try {
		objType = new ActiveXObject('Msxml2.XMLHTTP');
	} catch(e) {
		try {
			objType = new ActiveXObject('Microsoft.XMLHTTP');
		} catch(e) {
			objType = new XMLHttpRequest();
		}
	}
	return objType;
}
function uc_syn(type) {
	var theHttpRequest = getHttpObject();
	theHttpRequest.onreadystatechange = function() {
		processAJAX();
	};
	theHttpRequest.open('GET', in_path + 'source/user/people/syn.php?uc=' + type, true);
	theHttpRequest.send(null);
	function processAJAX() {
		if (theHttpRequest.readyState == 4) {
			if (theHttpRequest.status == 200) {
				var src = theHttpRequest.responseText.match(/src=".*?"/g);
				if (src) {
					for (i = 0; i < src.length; i++) {
						theHttpRequest = getHttpObject();
						theHttpRequest.open('GET', src[i].match(/src="([^"]*)"/)[1], true);
						theHttpRequest.send(null);
					}
				}
			}
		}
	}
}
function processResponse() {
	if (XMLHttpReq.readyState == 4) {
		if (XMLHttpReq.status == 200) {
			var tips = XMLHttpReq.responseText;
			if (tips == 'return_0') {
				asyncbox.tips("�ʼ���������δ����������ϵ����Ա��", "wait", 3000);
			} else if (tips == 'return_1') {
				asyncbox.tips("��֤�벻��ȷ������ģ�", "error", 3000);
			} else if (tips == 'return_2') {
				asyncbox.tips("��¼��Ϣ�����ڻ���ʧЧ�������»�ȡ��", "error", 3000);
			} else if (tips == 'return_3') {
				asyncbox.tips("��Ǹ����QQ�����Ѿ��������ʺŰ󶨹���", "error", 3000);
			} else if (tips == 'return_4') {
				uc_syn('login');
				asyncbox.tips("����ɹ�������ɰ󶨣�", "success", 500);
				setTimeout("location.href='" + guide_url + "';", 1000);
			} else if (tips == 'return_5') {
				uc_syn('login');
				asyncbox.tips("��ϲ�����Ѿ��ɹ������ʺţ�", "success", 500);
				setTimeout("location.href='" + guide_url + "';", 1000);
			} else if (tips == 'return_6') {
				asyncbox.tips("��Ǹ�������ʺ��Ѿ���������", "wait", 3000);
			} else if (tips == 'return_7') {
				uc_syn('login');
				asyncbox.tips("�����ʺ��Ѿ��󶨹�����QQ���룬���Ƚ���󶨣�", "error", 500);
				setTimeout("location.href='" + guide_url + "';", 1000);
			} else if (tips == 'return_8') {
				uc_syn('login');
				asyncbox.tips("��ϲ�����Ѿ��ɹ���ɰ󶨣�", "success", 500);
				setTimeout("location.href='" + guide_url + "';", 1000);
			} else if (tips == 'return_9') {
				uc_syn('login');
				asyncbox.tips("��ϲ�����Ѿ��ɹ���¼��վ��", "success", 500);
				setTimeout("location.href='" + guide_url + "';", 1000);
			} else if (tips == 'return_10') {
				asyncbox.tips("�ʺŻ�������������ԣ�", "error", 3000);
			} else if (tips == 'return_11') {
				asyncbox.tips("�û����Ѿ���ע�ᣬ�����һ����", "error", 3000);
			} else if (tips == 'return_12') {
				asyncbox.tips("�����Ѿ���ռ�ã������һ����", "error", 3000);
			} else if (tips == 'return_13') {
				asyncbox.tips("UCenter API: �û������Ϸ���", "error", 3000);
			} else if (tips == 'return_14') {
				asyncbox.tips("UCenter API: ����������ע��Ĵ��", "error", 3000);
			} else if (tips == 'return_15') {
				asyncbox.tips("UCenter API: �û����Ѿ����ڣ�", "error", 3000);
			} else if (tips == 'return_16') {
				asyncbox.tips("UCenter API: Email ��ʽ����", "error", 3000);
			} else if (tips == 'return_17') {
				asyncbox.tips("UCenter API: Email ������ע�ᣡ", "error", 3000);
			} else if (tips == 'return_18') {
				asyncbox.tips("UCenter API: Email �Ѿ���ע�ᣡ", "error", 3000);
			} else if (tips == 'return_19') {
				asyncbox.tips("UCenter API: ����δ���壡", "error", 3000);
			} else if (tips == 'return_20') {
				asyncbox.tips("��ϲ�����Ѿ��ɹ�ע���ʺţ�", "success", 2500);
				setTimeout("location.href='" + guide_url + "';", 3000);
			} else if (tips == 'return_21') {
				asyncbox.tips("�û��������ڣ���������ԣ�", "error", 3000);
			} else if (tips == 'return_22') {
				asyncbox.tips("��֤��Ϣ��ƥ�䣬�����ԣ�", "error", 3000);
			} else if (tips == 'return_23') {
				lostpasswd(2);
			} else if (tips == 'return_24') {
				asyncbox.tips("�����ַ�����ڻ���ʧЧ����������֤��", "wait", 3000);
			} else if (tips == 'return_25') {
				asyncbox.tips("��ϲ�����Ѿ��ɹ��������룡", "success", 1500);
				setTimeout("location.href='" + guide_url + "';", 2000);
			} else {
				asyncbox.tips("�ڲ����ִ������Ժ����ԣ�", "error", 3000);
			}
		} else {
			asyncbox.tips("ͨѶ�쳣�������������ã�", "error", 3000);
		}
	}
}
function login(type) {
	var username = $('username').value;
	if (strLen(username) < 1) {
		if (type < 2) {
		        $('username_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;�������û�����';
		}
		$('username').focus();
		return;
	} else {
		if (type < 2) {
		        $('username_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
	}
	var password = $('password').value;
	if (strLen(password) < 1) {
		if (type < 2) {
		        $('password_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;���������룡';
		}
		$('password').focus();
		return;
	} else {
		if (type < 2) {
		        $('password_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
	}
	var seccode = $('seccode').value;
	if (strLen(seccode) < 4) {
		if (type < 2) {
		        $('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��������λ��֤�룡';
		}
		$('seccode').focus();
		return;
	} else {
		if (type < 2) {
		        $('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/people/ajax.php?ac=login&qq=' + type + '&name=' + escape(username) + '&pwd=' + escape(password) + '&code=' + seccode, true);
	XMLHttpReq.onreadystatechange = processResponse;
	XMLHttpReq.send(null);
}
function register() {
	var username = $('username').value;
	if (strLen(username) < 3 || strLen(username) > 15 || !/^([\S])*$/.test(username) || !/^([^<>'"\/\\])*$/.test(username)) {
		$('username_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;�� 3 �� 15 ���ַ���ɣ������пո�� < > \' " / \\ ���ַ���';
		$('username').focus();
		return;
	} else {
		$('username_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
	}
	var password = $('password').value;
	if (strLen(password) < 6) {
		$('password_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��С����Ϊ 6 ���ַ���';
		$('password').focus();
		return;
	} else {
		$('password_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
	}
	var password1 = $('password1').value;
	if (password1 !== password) {
		$('password1_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;������������벻һ�£�';
		$('password1').focus();
		return;
	} else {
		$('password1_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
	}
	var mail = $('mail').value;
	if (strLen(mail) < 1 || isEmail(mail) == false) {
		$('mail_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��д�� Email ��ʽ����';
		$('mail').focus();
		return;
	} else {
		$('mail_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
	}
	var seccode = $('seccode').value;
	if (strLen(seccode) < 4) {
		$('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��������λ��֤�룡';
		$('seccode').focus();
		return;
	} else {
		$('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/people/ajax.php?ac=register&name=' + escape(username) + '&pwd=' + escape(password1) + '&mail=' + escape(mail) + '&code=' + seccode, true);
	XMLHttpReq.onreadystatechange = processResponse;
	XMLHttpReq.send(null);
}
function lostpasswd(type) {
	if (type == 1) {
		var username = $('username').value;
		if (strLen(username) < 1) {
			$('username_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;�������û�����';
			$('username').focus();
			return;
		} else {
			$('username_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
		var mail = $('mail').value;
		if (strLen(mail) < 1 || isEmail(mail) == false) {
			$('mail_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��д�� Email ��ʽ����';
			$('mail').focus();
			return;
		} else {
			$('mail_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
		var seccode = $('seccode').value;
		if (strLen(seccode) < 4) {
			$('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��������λ��֤�룡';
			$('seccode').focus();
			return;
		} else {
			$('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
		createXMLHttpRequest();
		XMLHttpReq.open('GET', in_path + 'source/user/people/ajax.php?ac=lostpasswd&type=1&name=' + escape(username) + '&mail=' + escape(mail) + '&code=' + seccode, true);
		XMLHttpReq.onreadystatechange = processResponse;
		XMLHttpReq.send(null);
	} else if (type == 2) {
		$('_tips').innerHTML = '<span><img src="' + in_path + 'static/user/images/loading.gif" />&nbsp;Loading...</span>';
		createXMLHttpRequest();
		XMLHttpReq.open('GET', in_path + 'source/user/people/ajax.php?ac=lostpasswd&type=2', true);
		XMLHttpReq.onreadystatechange = function() {
			if (XMLHttpReq.readyState == 4) {
				if (XMLHttpReq.status == 200) {
					if (XMLHttpReq.responseText == 'return_26') {
						$('_tips').innerHTML = '<span style="color:#3B5998;font-weight:bold;">�ʼ��Ѿ���������ȴ� 30 ���ſ����·��ͣ�</span>';
					} else if (XMLHttpReq.responseText == 'return_28') {
						$('_tips').innerHTML = '<span style="color:green;font-weight:bold;">��ϲ���ʼ��Ѿ����ͳɹ���</span>';
					} else {
						$('_tips').innerHTML = '<span style="color:red;font-weight:bold;">��Ǹ���ʼ�δ�ܷ��ͳɹ���</span>';
					}
				} else {
					asyncbox.tips("ͨѶ�쳣�������������ã�", "error", 3000);
				}
			}
		}
		XMLHttpReq.send(null);
	} else {
		var password = $('password').value;
		if (strLen(password) < 6) {
			$('password_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��С����Ϊ 6 ���ַ���';
			$('password').focus();
			return;
		} else {
			$('password_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
		var password1 = $('password1').value;
		if (password1 !== password) {
			$('password1_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;������������벻һ�£�';
			$('password1').focus();
			return;
		} else {
			$('password1_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
		var seccode = $('seccode').value;
		if (strLen(seccode) < 4) {
			$('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_error.gif" />&nbsp;&nbsp;��������λ��֤�룡';
			$('seccode').focus();
			return;
		} else {
			$('seccode_tips').innerHTML = '&nbsp;&nbsp;<img src="' + in_path + 'static/user/images/check_right.gif" />';
		}
		var uid = $('uid').value;
		var ucode = $('ucode').value;
		createXMLHttpRequest();
		XMLHttpReq.open('GET', in_path + 'source/user/people/ajax.php?ac=lostpasswd&type=0&pwd=' + escape(password1) + '&uid=' + uid + '&ucode=' + ucode + '&code=' + seccode, true);
		XMLHttpReq.onreadystatechange = processResponse;
		XMLHttpReq.send(null);
	}
}
function strLen(str) {
	var charset = document.charset;
	var len = 0;
	for (var i = 0; i < str.length; i++) {
		len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'gbk' ? 3: 2) : 1;
	}
	return len;
}
function isEmail(input) {
	if (input.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)) {
		return true;
	}
	return false;
}