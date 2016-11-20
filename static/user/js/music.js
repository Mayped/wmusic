function delsong(_id, _table) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/music/ajax.php?ac=delete&table=' + _table + '&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				var _text = _table == 'listen' ? '����' : '�ղ�';
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg(_text + '��¼�����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵�' + _text + '��¼��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ��' + _text + '��¼ɾ���ɹ���', {icon: 1});
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
function delmusic(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/music/ajax.php?ac=del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���ֲ����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵����֣�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('������ɾ���������֣�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_5') {
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
function addmusic() {
	var name = document.getElementById('in_name').value;
	if (name == '') {
		layer.msg('����д�������ƣ�', {icon: 2});
		document.getElementById('in_name').focus();
		return;
	}
	var classid = document.getElementById('in_classid').value;
	if (classid == 0) {
		layer.msg('��ѡ���������࣡', {icon: 2});
		document.getElementById('in_classid').focus();
		return;
	}
	var audio = document.getElementById('in_audio').value;
	if (audio == '') {
		layer.msg('����д��Ƶ��ַ��', {icon: 2});
		document.getElementById('in_audio').focus();
		return;
	}
	var specialid = document.getElementById('in_specialid').value;
	var singerid = document.getElementById('in_singerid').value;
	var tag = document.getElementById('in_tag').value;
	var cover = document.getElementById('in_cover').value;
	var lyric = document.getElementById('in_lyric').value;
	var text = document.getElementById('in_text').value.replace(/[\r\n]/g, '<br />');
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/music/ajax.php?ac=add&name=' + escape(name) + '&classid=' + classid + '&audio=' + escape(audio) + '&specialid=' + specialid + '&singerid=' + singerid + '&tag=' + escape(tag) + '&cover=' + escape(cover) + '&lyric=' + escape(lyric) + '&text=' + escape(text), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���಻���ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('ר�������ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('���ֲ����ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('��ϲ�������ϴ��ɹ���', {icon: 1});
					setTimeout("location.href='" + guide_url + "';", 3000);
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
function editmusic(_id) {
	var name = document.getElementById('in_name').value;
	if (name == '') {
		layer.msg('����д�������ƣ�', {icon: 2});
		document.getElementById('in_name').focus();
		return;
	}
	var classid = document.getElementById('in_classid').value;
	if (classid == 0) {
		layer.msg('��ѡ���������࣡', {icon: 2});
		document.getElementById('in_classid').focus();
		return;
	}
	var audio = document.getElementById('in_audio').value;
	if (audio == '') {
		layer.msg('����д��Ƶ��ַ��', {icon: 2});
		document.getElementById('in_audio').focus();
		return;
	}
	var specialid = document.getElementById('in_specialid').value;
	var singerid = document.getElementById('in_singerid').value;
	var tag = document.getElementById('in_tag').value;
	var cover = document.getElementById('in_cover').value;
	var lyric = document.getElementById('in_lyric').value;
	var text = document.getElementById('in_text').value.replace(/[\r\n]/g, '<br />');
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/music/ajax.php?ac=edit&id=' + _id + '&name=' + escape(name) + '&classid=' + classid + '&audio=' + escape(audio) + '&specialid=' + specialid + '&singerid=' + singerid + '&tag=' + escape(tag) + '&cover=' + escape(cover) + '&lyric=' + escape(lyric) + '&text=' + escape(text), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���ֲ����ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���಻���ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('ר�������ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('���ֲ����ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_6') {
					layer.msg('�����ܱ༭���˵����֣�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_7') {
					layer.msg('�����ܱ༭�������֣�', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_8') {
					layer.msg('��ϲ�����ֱ༭�ɹ���', {icon: 1});
					setTimeout("location.href='" + guide_url + "';", 3000);
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