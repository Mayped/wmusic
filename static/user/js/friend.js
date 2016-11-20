function addfriend(name) {
	var msg = document.getElementById('message').value;
	var gid = document.getElementById('groupid');
	if (gid.value < 1) {
		gid.focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/friend/ajax.php?ac=insert&name=' + escape(name) + '&msg=' + escape(msg) + '&gid=' + gid.value, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('�û������ڻ��ѱ�����Ա������', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���鲻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('����������Լ�Ϊ���ѣ�', 3, 8);
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('������ѡ����˵ķ��飡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_6') {
					layer.closeAll();
					layer.msg('��ϲ����Ϊ���ѳɹ���', 3, 1);
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
function delfriend(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/friend/ajax.php?ac=f_del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���Ѳ����ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵ĺ��ѣ�', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������ɾ���ɹ���', 3, 1);
					setTimeout("location.reload();", 3000);
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
function changefriend(_id) {
	var gid = document.getElementById('groupid');
	if (gid.value < 1) {
		gid.focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/friend/ajax.php?ac=change&fid=' + _id + '&gid=' + gid.value, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���Ѳ����ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���鲻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('�������ƶ����˵ĺ��ѣ�', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('������ѡ����˵ķ��飡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_6') {
					layer.closeAll();
					layer.msg('��ϲ�������ƶ��ɹ���', 3, 1);
					setTimeout("location.reload();", 3000);
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
function addgroup(title) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/friend/ajax.php?ac=add&title=' + escape(title), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���Ѿ��½����÷��飬������������ƣ�', 3, 8);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ���½�����ɹ���', 3, 1);
					setTimeout("location.reload();", 3000);
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
function delgroup(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/friend/ajax.php?ac=del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���鲻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵ķ��飡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������ɾ���ɹ���', 3, 1);
					setTimeout("location.href='" + guide_url + "';", 3000);
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
function edigroup(_id, _title) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/friend/ajax.php?ac=edi&id=' + _id + '&title=' + escape(_title), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���鲻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�������޸ı��˵ķ��飡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('���Ѿ��½����÷��飬������������ƣ�', 3, 8);
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('��ϲ�������޸ĳɹ���', 3, 1);
					setTimeout("location.reload();", 3000);
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