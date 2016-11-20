function delspecial(_id) {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/special/ajax.php?ac=del&id=' + _id, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('ר�������ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('������ɾ�����˵�ר����', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('������ɾ������ר����', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('��ϲ��ר��ɾ���ɹ���', {icon: 1});
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
function addspecial() {
	var name = $('in_name').value;
	if (name == '') {
		layer.msg('����дר�����ƣ�', {icon: 2});
		$('in_name').focus();
		return;
	}
	var classid = $('in_classid').value;
	if (classid == 0) {
		layer.msg('��ѡ���������࣡', {icon: 2});
		$('in_classid').focus();
		return;
	}
	var singerid = $('in_singerid').value;
	var firm = $('in_firm').value;
	var lang = $('in_lang').value;
	var cover = $('in_cover').value;
	var intro = $('in_intro').value.replace(/[\r\n]/g, '<br />');
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/special/ajax.php?ac=add&name=' + escape(name) + '&classid=' + classid + '&singerid=' + singerid + '&firm=' + escape(firm) + '&lang=' + escape(lang) + '&cover=' + escape(cover) + '&intro=' + escape(intro), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���಻���ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���ֲ����ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('��ϲ��ר�������ɹ���', {icon: 1});
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
function editspecial(_id) {
	var name = $('in_name').value;
	if (name == '') {
		layer.msg('����дר�����ƣ�', {icon: 2});
		$('in_name').focus();
		return;
	}
	var classid = $('in_classid').value;
	if (classid == 0) {
		layer.msg('��ѡ���������࣡', {icon: 2});
		$('in_classid').focus();
		return;
	}
	var singerid = $('in_singerid').value;
	var firm = $('in_firm').value;
	var lang = $('in_lang').value;
	var cover = $('in_cover').value;
	var intro = $('in_intro').value.replace(/[\r\n]/g, '<br />');
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/special/ajax.php?ac=edit&id=' + _id + '&name=' + escape(name) + '&classid=' + classid + '&singerid=' + singerid + '&firm=' + escape(firm) + '&lang=' + escape(lang) + '&cover=' + escape(cover) + '&intro=' + escape(intro), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('ר�������ڻ��ѱ�ɾ����', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('���಻���ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('���ֲ����ڣ�����ѡ��ˢ��ҳ�棡', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('�����ܱ༭���˵�ר����', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_6') {
					layer.msg('�����ܱ༭����ר����', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_7') {
					layer.msg('��ϲ��ר���༭�ɹ���', {icon: 1});
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