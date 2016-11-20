function groupshare(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=share&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��᲻���ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ������Ƽ��ɹ���', {icon: 1});
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
function addgroup() {
	var photo = $('photo').value;
	if (photo == '') {
		layer.msg('������Ʋ���Ϊ�գ�', {icon: 2});
		$('photo').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=add&photo=' + escape(photo), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���Ѿ��½�������ᣬ�����������ƣ�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ���½����ɹ���', {icon: 1});
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
function delgroup(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��᲻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵���ᣡ', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ�����ɾ���ɹ���', 3, 1);
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
function editgroup(_id, _title) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=edit&id=' + _id + '&title=' + escape(_title), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��᲻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�������޸ı��˵���ᣡ', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('���Ѿ��½�������ᣬ�����������ƣ�', 3, 8);
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('��ϲ���������ɹ���', 3, 1);
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
function coverphoto(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=cover&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��Ƭ�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���������ñ��˵���Ƭ��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ����Ƭ��Ϊ����ɹ���', {icon: 1});
					setTimeout("location.href='" + cover_url + "';", 3000);
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
function delphoto(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=cancel&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��Ƭ�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵���Ƭ��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ����Ƭɾ���ɹ���', {icon: 1});
					setTimeout("location.href='" + del_url + "';", 3000);
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
function editphoto(_id) {
	var gid = $('groupid').value;
	if (gid < 1) {
		$('groupid').focus();
		return;
	}
	var title = $('title').value;
	if (title == '') {
		$('title').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=change&pid=' + _id + '&gid=' + gid + '&title=' + escape(title), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��Ƭ�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��᲻���ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('�����ܱ༭���˵���Ƭ��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('������ѡ����˵���ᣡ', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_6') {
					layer.msg('��ϲ����Ƭ�༭�ɹ���', {icon: 1});
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
function dig_photo(_id, _field) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=dig&id=' + _id +'&field=' + _field, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��Ƭ�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�����ܸ��Լ�����Ƭ��̬��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('���ո��Ѿ����̬�ˣ�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('��ϲ�����Ѿ���̬�ɹ���', {icon: 1});
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
function commentphoto(_id) {
	var content = $('content').value;
	if (content == '') {
		layer.msg('�������ݲ���Ϊ�գ�', {icon: 2});
		$('content').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=comment&id=' + _id + '&content=' + escape(content), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��Ƭ�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					$('comment_tips').innerHTML = 'ÿ�����ۼ��ʱ�䲻�ܵ���30�룡';
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ�����Ѿ����۳ɹ���', {icon: 1});
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
function delcomment(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/photo/ajax.php?ac=c_del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���۲����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('ֻ����Ƭ�����˲���ɾ�����ۣ�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������ɾ���ɹ���', {icon: 1});
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