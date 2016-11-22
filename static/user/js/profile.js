function unconnect() {
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=unconnect', true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��ϲ�����Ѿ��ɹ����QQ��', {icon: 1});
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
function editprofile() {
	var sex = $('sex').value;
	var province = $('province').value;
	if (province == '') {
		layer.msg('��ѡ�����[ʡ]��', {icon: 2});
		$('province').focus();
		return;
	}
	var city = $('city').value;
	if (city == '') {
		layer.msg('��ѡ�����[��]��', {icon: 2});
		$('city').focus();
		return;
	}
	var year = $('year').value;
	if (year == '') {
		layer.msg('��ѡ������[��]��', {icon: 2});
		$('year').focus();
		return;
	}
	var month = $('month').value;
	if (month == '') {
		layer.msg('��ѡ������[��]��', {icon: 2});
		$('month').focus();
		return;
	}
	var day = $('day').value;
	if (day == '') {
		layer.msg('��ѡ������[��]��', {icon: 2});
		$('day').focus();
		return;
	}
	var introduce = $('introduce').value;
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=editprofile&sex=' + sex + '&province=' + escape(province) + '&city=' + escape(city) + '&year=' + year + '&month=' + month + '&day=' + day + '&introduce=' + escape(introduce), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��ϲ���������ϱ���ɹ���', {icon: 1});
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
function editpassword() {
	var _old = $('_old').value;
	if (_old == '') {
		layer.msg('�����벻��Ϊ�գ�', {icon: 2});
		$('_old').focus();
		return;
	}
	var _new = $('_new').value;
	if (strLen(_new) < 6) {
		layer.msg('��������С����Ϊ 6 ���ַ���', {icon: 2});
		$('_new').focus();
		return;
	}
	var _news = $('_news').value;
	if (_news !== _new) {
		layer.msg('������������벻һ�£�', {icon: 2});
		$('_news').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=editpassword&old=' + escape(_old) + '&new=' + escape(_news), true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('���������������ԣ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ����¼�����޸ĳɹ���', {icon: 1});
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
function editmail(type) {
	if (type == 1) {
		var mail = $('mail').value;
		if (strLen(mail) < 1 || isEmail(mail) == false) {
			layer.msg('����ĸ�ʽ����', {icon: 2});
			$('mail').focus();
			return;
		}
		createXMLHttpRequest();
		XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=editmail&type=1&mail=' + escape(mail), true);
		XMLHttpReq.onreadystatechange = function() {
			if (XMLHttpReq.readyState == 4) {
				if (XMLHttpReq.status == 200) {
					if (XMLHttpReq.responseText == 'return_0') {
						layer.msg('�ʼ���������δ����������ϵ����Ա��', {icon: 5});
					} else if (XMLHttpReq.responseText == 'return_1') {
						layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
					} else if (XMLHttpReq.responseText == 'return_2') {
						layer.msg('�ʼ��Ѿ���������ȴ� 30 ���ſ����·��ͣ�', {icon: 4});
					} else if (XMLHttpReq.responseText == 'return_4') {
						layer.msg('��ϲ���ʼ��Ѿ����ͳɹ���', {icon: 1});
					} else {
						layer.msg('��Ǹ���ʼ�δ�ܷ��ͳɹ���', {icon: 5});
					}
				} else {
					layer.msg('ͨѶ�쳣�������������ã�', {icon: 3});
				}
			}
		}
		XMLHttpReq.send(null);
	} else {
		var password = $('password').value;
		if (password == '') {
			layer.msg('��¼���벻��Ϊ�գ�', {icon: 2});
			$('password').focus();
			return;
		}
		var mail = $('mail').value;
		if (strLen(mail) < 1 || isEmail(mail) == false) {
			layer.msg('����ĸ�ʽ����', {icon: 2});
			$('mail').focus();
			return;
		}
		var _code = $('_code').value;
		if (_code == '') {
			layer.msg('�ʼ���֤�벻��Ϊ�գ�', {icon: 2});
			$('_code').focus();
			return;
		}
		createXMLHttpRequest();
		XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=editmail&type=0&pwd=' + escape(password) + '&mail=' + escape(mail) + '&code=' + _code, true);
		XMLHttpReq.onreadystatechange = function() {
			if (XMLHttpReq.readyState == 4) {
				if (XMLHttpReq.status == 200) {
					if (XMLHttpReq.responseText == 'return_1') {
						layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
					} else if (XMLHttpReq.responseText == 'return_2') {
						layer.msg('��¼�������������ԣ�', {icon: 2});
					} else if (XMLHttpReq.responseText == 'return_3') {
						layer.msg('�����Ѿ���ռ�ã������һ����', {icon: 5});
					} else if (XMLHttpReq.responseText == 'return_4') {
						layer.msg('�ʼ���֤����Ч�������ԣ�', {icon: 2});
					} else if (XMLHttpReq.responseText == 'return_5') {
						layer.msg('��ϲ��������֤�ɹ���', {icon: 1});
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
}
function editverify() {
	var password = $('password').value;
	if (password == '') {
		layer.msg('��¼���벻��Ϊ�գ�', {icon: 2});
		$('password').focus();
		return;
	}
	var _name = $('_name').value;
	if (_name == '') {
		layer.msg('��ʵ��������Ϊ�գ�', {icon: 2});
		$('_name').focus();
		return;
	}
	var _cardtype = $('_cardtype').value;
	var _cardnum = $('_cardnum').value;
	if (_cardnum == '') {
		layer.msg('֤�����벻��Ϊ�գ�', {icon: 2});
		$('_cardnum').focus();
		return;
	}
	var _address = $('_address').value;
	if (_address == '') {
		layer.msg('��ϵ��ַ����Ϊ�գ�', {icon: 2});
		$('_address').focus();
		return;
	}
	var _mobile = $('_mobile').value;
	if (_mobile == '') {
		layer.msg('�ֻ����벻��Ϊ�գ�', {icon: 2});
		$('_mobile').focus();
		return;
	}
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=editverify&pwd=' + escape(password) + '&name=' + escape(_name) + '&type=' + escape(_cardtype) + '&num=' + _cardnum + '&address=' + escape(_address) + '&mobile=' + _mobile, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��¼�������������ԣ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��ϲ����֤�����ύ�ɹ���', {icon: 1});
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
function getvip() {
	var password = $('password').value;
	if (password == '') {
		layer.msg('��¼���벻��Ϊ�գ�', {icon: 2});
		$('password').focus();
		return;
	}
	var uname = $('uname').value;
	if (uname == '') {
		layer.msg('�û�������Ϊ�գ�', {icon: 2});
		$('uname').focus();
		return;
	}
	var vipnum = $('vipnum').value;
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=vip&pwd=' + escape(password) + '&name=' + escape(uname) + '&num=' + vipnum, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_2') {
					layer.msg('��¼�������������ԣ�', {icon: 2});
				} else if (XMLHttpReq.responseText == 'return_3') {
					layer.msg('��Ҳ��㣬���ȳ�ֵ��', {icon: 5});
				} else if (XMLHttpReq.responseText == 'return_4') {
					layer.msg('�û��������ڣ�����ģ�', {icon: 3});
				} else if (XMLHttpReq.responseText == 'return_5') {
					layer.msg('��ϲ����Ա��ͨ�ɹ���', {icon: 6});
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
function getpay() {
	var _rmb = $('_rmb').value;
	if (_rmb == '') {
		layer.msg('��ֵ����Ϊ�գ�', {icon: 2});
		$('_rmb').focus();
		return;
	}
	if (_rmb == 0) {
		layer.msg('��ֵ����Ϊ0��', {icon: 2});
		$('_rmb').focus();
		return;
	}
	var _type = $('_type').value;
	var pay = layer.open({
		type: 2,
		maxmin: true,
		title: '��ֵ���',
		content: [in_path + 'source/pack/' + _type + '/pay.php', 'yes'],
		area: ['700px', '430px'],
		offset: '100px',
		shade: false
	});
	createXMLHttpRequest();
	XMLHttpReq.open('GET', in_path + 'source/user/profile/ajax.php?ac=pay&rmb=' + _rmb + '&type=' + _type, true);
	XMLHttpReq.onreadystatechange = function() {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == 'return_1') {
					layer.msg('���ȵ�¼�û����ģ�', {icon: 2});
				} else if (XMLHttpReq.responseText == _type) {
					layer.full(pay);
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