function blogshare(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=share&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��־�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ����־�Ƽ��ɹ���', {icon: 1});
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
function addgroup(title) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=add&title=' + escape(title), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���Ѿ��½����÷��࣬������������ƣ�', 3, 8);
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
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���಻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵ķ��࣡', 3, 7);
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
function editgroup(_id, _title) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=edit&id=' + _id + '&title=' + escape(_title), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���಻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�������޸ı��˵ķ��࣡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('���Ѿ��½����÷��࣬������������ƣ�', 3, 8);
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
function addblog(obj) {
	uploadEdit(obj);
	var classid = document.getElementById('classid');
	var title = document.getElementById('title');
	var content = document.getElementById('uchome-ttHtmlEditor').value;
	content = content.replace(/&amp;/g, '&');
	content = content.replace(/&lt;/g, '<');
	content = content.replace(/&gt;/g, '>');
	if (classid.value < 1) {
		layer.msg('����ѡ����࣡', 3, 11);
		classid.focus();
		return;
	}
	if (title.value == '') {
		layer.msg('���ⲻ��Ϊ�գ�', 3, 11);
		title.focus();
		return;
	}
	if (content == '') {
		layer.msg('���ݲ���Ϊ�գ�', 3, 11);
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=insert&id=' + classid.value + '&t=' + escape(title.value) + '&c=' + escape(content), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���಻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ѡ����˵ķ��࣡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ����־����ɹ���', 3, 1);
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
function delblog(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=cancel&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��־�����ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵���־��', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ����־ɾ���ɹ���', 3, 1);
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
function editblog(obj, _id) {
	uploadEdit(obj);
	var classid = document.getElementById('classid');
	var title = document.getElementById('title');
	var content = document.getElementById('uchome-ttHtmlEditor').value;
	content = content.replace(/&amp;/g, '&');
	content = content.replace(/&lt;/g, '<');
	content = content.replace(/&gt;/g, '>');
	if (classid.value < 1) {
		layer.msg('����ѡ����࣡', 3, 11);
		classid.focus();
		return;
	}
	if (title.value == '') {
		layer.msg('���ⲻ��Ϊ�գ�', 3, 11);
		title.focus();
		return;
	}
	if (content == '') {
		layer.msg('���ݲ���Ϊ�գ�', 3, 11);
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=change&bid=' + _id + '&gid=' + classid.value + '&t=' + escape(title.value) + '&c=' + escape(content), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��־�����ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���಻���ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('�����ܱ༭���˵���־��', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('������ѡ����˵ķ��࣡', 3, 7);
				} else if (XMLHttpReq.responseText == 'return_6') {
					layer.msg('��ϲ����־�༭�ɹ���', 3, 1);
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
function dig_blog(_id, _field) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=dig&id=' + _id +'&field=' + _field, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��־�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('�����ܸ��Լ�����־��̬��', {icon: 5});
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
function commentblog(_id) {
	var content = $('content').value;
	if (content == '') {
		layer.msg('�������ݲ���Ϊ�գ�', {icon: 2});
		$('content').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=comment&id=' + _id + '&content=' + escape(content), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��־�����ڻ��ѱ�ɾ����', {icon: 2});
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
	XMLHttpReq.open('GET', in_path + 'source/user/blog/ajax.php?ac=c_del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���۲����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('ֻ����־�����˲���ɾ�����ۣ�', {icon: 5});
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