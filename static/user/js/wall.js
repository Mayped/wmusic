function spaceshare(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/space/ajax.php?ac=share&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('�û������ڻ��ѱ�����Ա������', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ���û��Ƽ��ɹ���', 3, 1);
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
function spacewall(_id) {
	var wall = document.getElementById('space_wall').value;
	if (wall == '') {
		document.getElementById('space_wall').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/space/ajax.php?ac=wall&id=' + _id + '&wall=' + escape(wall), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('�û������ڻ��ѱ�����Ա������', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					document.getElementById('wall_tips').innerHTML = 'ÿ�����Լ��ʱ�䲻�ܵ���45�룡';
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ�����Ѿ����Գɹ���', 3, 10);
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
function delwall(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/space/ajax.php?ac=w_del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���Բ����ڻ��ѱ�ɾ����', 3, 11);
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('ֻ�пռ�����˲���ɾ�����ԣ�', 3, 8);
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ������ɾ���ɹ���', 3, 10);
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