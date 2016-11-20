function get_week() {
	var objDate = new Date();
	var week = objDate.getDay();
	switch (week) {
	case 0:
		week = '����';
		break;
	case 1:
		week = '��һ';
		break;
	case 2:
		week = '�ܶ�';
		break;
	case 3:
		week = '����';
		break;
	case 4:
		week = '����';
		break;
	case 5:
		week = '����';
		break;
	case 6:
		week = '����';
		break;
	}
	return week;
}
function clock_sign() {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=sign', true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('������ǩ����������������', {icon: 4});
				} else if (XMLHttpReq.responseText == 'return_3') {
					var in_sign = Number($('in_sign').innerHTML) + 1;
					$('in_sign').innerHTML = in_sign;
					$('day_' + new Date().getDate()).innerHTML = '<ul><li class="dayeventsli">����[' + in_points + '][' + in_rank + ']</li></ul>';
					$('day_' + new Date().getDate()).style.display = 'block';
					$('a_' + new Date().getDate()).style.background = '#F7EEB8';
					$('a_' + new Date().getDate()).style.border = '1px solid #E0D486';
					layer.msg('ǩ���ɹ�����������' + in_sign + '�죡', {icon: 1});
				} else {
					layer.msg('�ڲ����ִ������Ժ����ԣ�', {icon: 5});
				}
			} else {
				layer.msg('ͨѶ�쳣�������������ã�', {icon: 3});
			}
		}
	}
	XMLHttpReq.send(null);
}
function share_flash() {
	var play = $('share_play').value;
	var intro = $('share_intro').value;
	var format = play.match(/\.(swf)/g);
	if (!format) {
		layer.msg('��Ǹ��Flash��ַ����ʧ�ܣ�', {icon: 5});
		$('share_play').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=share&p=' + escape(play) + '&i=' + escape(intro), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					location.href = guide_url;
				} else {
					layer.msg('�ڲ����ִ������Ժ����ԣ�', {icon: 5});
				}
			} else {
				layer.msg('ͨѶ�쳣�������������ã�', {icon: 3});
			}
		}
	}
	XMLHttpReq.send(null);
}
function invisible(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=invisible&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					var _text = _id > 0 ? '����' : '����';
					layer.msg('��ϲ���л���' + _text + '״̬�ɹ���', {icon: 1});
					setTimeout("location.reload();", 3000);
				} else {
					layer.msg('�ڲ����ִ������Ժ����ԣ�', {icon: 5});
				}
			} else {
				layer.msg('ͨѶ�쳣�������������ã�', {icon: 3});
			}
		}
	}
	XMLHttpReq.send(null);
}
function doing() {
	var message = $('message').value;
	if (message == '') {
		$('message').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=do&c=' + escape(message), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					location.href = guide_url;
				} else {
					layer.msg('�ڲ����ִ������Ժ����ԣ�', {icon: 5});
				}
			} else {
				layer.msg('ͨѶ�쳣�������������ã�', {icon: 3});
			}
		}
	}
	XMLHttpReq.send(null);
}
function deldoing(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=f_del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					asyncbox.tips("���ȵ�¼�û����ģ�", "wait", 3000);
				} else if (XMLHttpReq.responseText == 'return_2') {
					asyncbox.tips("˵˵�����ڻ��ѱ�ɾ����", "error", 3000);
				} else if (XMLHttpReq.responseText == 'return_3') {
					asyncbox.tips("������ɾ�����˵�˵˵��", "error", 3000);
				} else if (XMLHttpReq.responseText == 'return_4') {
					asyncbox.tips("��ϲ��˵˵ɾ���ɹ���", "success", 3000);
					setTimeout("location.reload();", 3000);
				} else {
					asyncbox.tips("�ڲ����ִ������Ժ����ԣ�", "error", 3000);
				}
			} else {
				asyncbox.tips("ͨѶ�쳣�������������ã�", "error", 3000);
			}
		}
	}
	XMLHttpReq.send(null);
}
function reply(_id) {
	var message = document.getElementById('do_message_' + _id).value;
	if (message == '') {
		document.getElementById('do_message_' + _id).focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=re&id=' + _id + '&c=' + escape(message), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					asyncbox.tips("���ȵ�¼�û����ģ�", "wait", 3000);
				} else if (XMLHttpReq.responseText == 'return_2') {
					asyncbox.tips("˵˵�����ڻ��ѱ�ɾ����", "error", 3000);
				} else if (XMLHttpReq.responseText == 'return_3') {
					getreply(_id);
					asyncbox.tips("��ϲ����ӻظ��ɹ���", "success", 3000);
				} else {
					asyncbox.tips("�ڲ����ִ������Ժ����ԣ�", "error", 3000);
				}
			} else {
				asyncbox.tips("ͨѶ�쳣�������������ã�", "error", 3000);
			}
		}
	}
	XMLHttpReq.send(null);
}
function delreply(_id, _fid) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/feed/ajax.php?ac=r_del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					asyncbox.tips("���ȵ�¼�û����ģ�", "wait", 3000);
				} else if (XMLHttpReq.responseText == 'return_2') {
					asyncbox.tips("�ظ������ڻ��ѱ�ɾ����", "error", 3000);
				} else if (XMLHttpReq.responseText == 'return_3') {
					asyncbox.tips("ֻ��˵˵�����˲���ɾ���ظ���", "error", 3000);
				} else if (XMLHttpReq.responseText == 'return_4') {
					getreply(_fid);
					asyncbox.tips("��ϲ���ظ�ɾ���ɹ���", "success", 3000);
				} else {
					asyncbox.tips("�ڲ����ִ������Ժ����ԣ�", "error", 3000);
				}
			} else {
				asyncbox.tips("ͨѶ�쳣�������������ã�", "error", 3000);
			}
		}
	}
	XMLHttpReq.send(null);
}
function getreply(_id) {
	var theHttpRequest = getHttpObject();
	theHttpRequest.onreadystatechange = function() {
		processAJAX();
	};
	theHttpRequest.open('GET', in_path + 'source/user/feed/ajax.php?ac=get&id=' + _id, true);
	theHttpRequest.send(null);
	function processAJAX() {
		if (theHttpRequest.readyState == 4) {
			if (theHttpRequest.status == 200) {
				document.getElementById('doreply' + _id).innerHTML = theHttpRequest.responseText;
			} else {
				document.getElementById('doreply' + _id).innerHTML = '����ʧ��...';
			}
		}
	}
}