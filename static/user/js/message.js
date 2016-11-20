function sendmessage(name, msg) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/message/ajax.php?ac=add&name=' + escape(name) + '&msg=' + escape(msg), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('�û������ڻ��ѱ�����Ա������', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�����ܸ��Լ�������Ϣ��', 3, 8);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������Ϣ���ͳɹ���', 3, 1);
				} else {
					layer.msg('�ڲ����ִ������Ժ����ԣ�', 3, 8);
				}
			} else {
				layer.msg('ͨѶ�쳣�������������ã�', 3, 3);
			}
		}
	}
	XMLHttpReq.send(null);
}
function addmessage() {
	var username = $('username').value;
	if (username == '') {
		layer.msg('�ռ��˲���Ϊ�գ�', {icon: 2});
		$('username').focus();
		return;
	}
	var message = $('message').value;
	if (message == '') {
		layer.msg('���ݲ���Ϊ�գ�', {icon: 2});
		$('message').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/message/ajax.php?ac=add&name=' + escape(username) + '&msg=' + escape(message), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('�ռ��˲����ڻ��ѱ�����Ա������', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�ռ��˲������Լ���', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������Ϣ���ͳɹ���', {icon: 1});
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
function del_message(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/message/ajax.php?ac=del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('����Ϣ�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵Ķ���Ϣ��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������Ϣɾ���ɹ���', {icon: 1});
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
function set_msg(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/message/ajax.php?ac=set&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					var _text = _id > 0 ? '�������δ����Ϣ' : '��������Ѷ���Ϣ';
					layer.msg('��ϲ��' + _text + '�ɹ���', {icon: 1});
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
function reply_message(_uid) {
	var message = $('message').value;
	if (message == '') {
		layer.msg('�ظ����ݲ���Ϊ�գ�', {icon: 2});
		$('message').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/message/ajax.php?ac=reply&uid=' + _uid + '&msg=' + escape(message), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��ϲ������Ϣ�ظ��ɹ���', {icon: 1});
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