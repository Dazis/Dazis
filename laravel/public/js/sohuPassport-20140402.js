/**
 * passport utf-8 date 2013-08 sohu sce support
 */
;
(function(window, undefined) {
	// ���
	if (window['PassportSC']) {
		alert('ȫ�ֱ���PassportSC�ѱ�ռ�ã�');
		return false;
	}
	// �ṩһ�������޸�ȫ�ֶ������Ƶķ���
	// update �÷��������ṩ
	window['passportSetGlobalName'] = function(name, flag) {
		if (window[name]) {
			alert('ȫ�ֱ���' + name + '�ѱ�ռ�ã�');
			return false;
		}
		window[name] = window['PassportSC'];
		if (flag) {
			window['PassportSC'] = null;
			delete window['PassportSC'];
		}
	};
	// ΪFunction���캯������bindFunc����
	Function.prototype.bindFunc = function(pObject) {
		if (typeof (pObject) != "object") {
			return false;
		}
		var __method = this;
		return function() {
			return __method.apply(pObject, arguments);
		};
	};
	// Ϊ��֧��document.getElementsByClassName���������Ӹ÷���
	if (!document.getElementsByClassName) {
		document.getElementsByClassName = function(cname, ele) {
			if (!cname)
				return [];
			var arr = (ele || document).getElementsByTagName('*');
			var temp, result = [];
			for ( var i = 0, l = arr.length; i < l; i++) {
				temp = arr[i].getAttribute('class') ? arr[i].getAttribute(
						'class').split(' ') : [];
				if (temp.length === 0)
					break;
				for ( var j = 0, k = temp.length; j < k; j++) {
					if (temp[j] === cname) {
						result.push(arr[i]);
						break;
					}
				}
			}
			return result;
		};
	}
	/** *************��̬���������������ʼ���������հ��ڲ�ʹ��**************** */
	// �õ��ַ����ĳ��ȣ�һ��������2���ֽ�
	function getStringLen(str) {
		var cArr = str.match(/[^\x00-\xff]/ig);
		return str.length + (cArr == null ? 0 : cArr.length);
	}
	function getBrowserType() {
		if (window.ActiveXObject) {// IE��trident�Ű�����
			if (window.XMLHttpRequest && !window.XDomainRequest) {
				return 5;// ie7
			} else if (window.XDomainRequest) {
				return 6;// ie8
			} else {
				return 1;// ie6
			}
		} else if (navigator.userAgent.toLowerCase().indexOf("firefox") >= 0) {
			return 2;// FireFox
		} else if (typeof (window.opera) == "object") {
			return 3;// Opera
		} else if (window.MessageEvent && !document.getBoxObjectFor) {
			return 7;// chrome
		} else if (navigator.appVersion.indexOf("Safari") >= 0) {
			return 4;// Safari
		}
	}
	function GetXmlHttpObject() {
		var xmlHttp = null;
		try {
			// Firefox, Opera 8.0+, Safari
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			// Internet Explorer
			try {
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		return xmlHttp;
	}
	// ����url�Ի��get����url��ַ�а����Ĳ����������ظ���key�����е�ȡֵ��ϲ�Ϊһ������
	function parseUrl(url) {
		var par = {};
		var parStr = unescape(url).split('?').length >= 2 ? unescape(url)
				.split('?')[1] : '';
		if (parStr.length === 0)
			return par;
		var parArr = parStr.split('&');
		var key, value;
		for ( var i = 0, l = parArr.length; i < l; i++) {
			key = parArr[i].split('=')[0];
			value = parArr[i].split('=').length == 2 ? parArr[i].split('=')[1]
					: '';
			if (typeof par[key] === 'undefined') {
				par[key] = value;
			} else if (typeof par[key] === 'string') {
				par[key] = [].concat(par[key]).concat(value);
			} else {
				par[key] = par[key].concat(value);
			}
		}
		return par;
	}
	// �ж�������Ƿ�֧��cookie
	function checkCookieEnabled() {
		try {
			if (navigator.cookieEnabled === false) {
				return false;
			}
			// ���һ�����Ե�cookie
			var date = new Date();
			var cString = 'testCookie=yes;expires='
					+ new Date(date.getTime() + 5 * 1000).toGMTString() + ';';
			document.cookie = cString;
			if (!document.cookie) {
				return false;
			}
			// ɾ��������cookie
			cString = 'testCookie=yes;expires='
					+ new Date(date.getTime() - 5 * 1000).toGMTString() + ';';
			document.cookie = cString;
		} catch (e) {
			return false;
		}
		return true;
	}
	var Base64 = {
		_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",// private
		// property
		encode : function(input) {// public method for encoding
			var output = "";
			var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			var i = 0;
			input = this.encodeURL(input);// make url safe
			input = Base64._utf8_encode(input);
			while (i < input.length) {
				chr1 = input.charCodeAt(i++);
				chr2 = input.charCodeAt(i++);
				chr3 = input.charCodeAt(i++);

				enc1 = chr1 >> 2;
				enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
				enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
				enc4 = chr3 & 63;

				if (isNaN(chr2)) {
					enc3 = enc4 = 64;
				} else if (isNaN(chr3)) {
					enc4 = 64;
				}
				output = output + this._keyStr.charAt(enc1)
						+ this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3)
						+ this._keyStr.charAt(enc4);
			}
			return output;
		},
		decode : function(input) {// public method for decoding
			var output = "";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			input = this.decodeUrl(input);// make url safe
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

			while (i < input.length) {
				enc1 = this._keyStr.indexOf(input.charAt(i++));
				enc2 = this._keyStr.indexOf(input.charAt(i++));
				enc3 = this._keyStr.indexOf(input.charAt(i++));
				enc4 = this._keyStr.indexOf(input.charAt(i++));

				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;

				output = output + String.fromCharCode(chr1);

				if (enc3 != 64) {
					output = output + String.fromCharCode(chr2);
				}
				if (enc4 != 64) {
					output = output + String.fromCharCode(chr3);
				}
			}
			output = Base64._utf8_decode(output);
			return output;
		},
		_utf8_encode : function(string) {// private method for UTF-8 encoding
			string = string.replace(/\r\n/g, "\n");
			var utftext = "";

			for ( var n = 0; n < string.length; n++) {
				var c = string.charCodeAt(n);
				if (c < 128) {
					utftext += String.fromCharCode(c);
				} else if ((c > 127) && (c < 2048)) {
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				} else {
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}
			}
			return utftext;
		},
		_utf8_decode : function(utftext) {// private method for UTF-8 decoding
			var string = "";
			var i = 0;
			var c = 0, c1 = 0, c2 = 0;
			while (i < utftext.length) {
				c = utftext.charCodeAt(i);
				if (c < 128) {
					string += String.fromCharCode(c);
					i++;
				} else if ((c > 191) && (c < 224)) {
					c2 = utftext.charCodeAt(i + 1);
					string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
					i += 2;
				} else {
					c2 = utftext.charCodeAt(i + 1);
					c3 = utftext.charCodeAt(i + 2);
					string += String.fromCharCode(((c & 15) << 12)
							| ((c2 & 63) << 6) | (c3 & 63));
					i += 3;
				}
			}
			return string;
		},
		encodeURL : function(str) {// the following method make the Base64
			// method url safe
			return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/,
					'');
		},
		// make the string url safe (str % 4 = 0)
		decodeUrl : function(str) {
			// str = (str + '===').slice(0, str.length + (str.length % 4));
			// return str.replace(/-/g, '+').replace(/_/g, '/');
			var temp, a;
			if (str.length % 4 === 0) {
				temp = str;
			} else {
				a = str.length % 4;
				temp = (str + '===').slice(0, str.length + 4 - a);
			}
			return temp.replace(/-/g, '+').replace(/_/g, '/');
		}
	};
	var MD5 = function(args) {
		var hexcase = 0;
		var b64pad = "";
		var chrsz = 8;
		function hex_md5(s) {
			return binl2hex(core_md5(str2binl(s), s.length * chrsz));
		}
		function b64_md5(s) {
			return binl2b64(core_md5(str2binl(s), s.length * chrsz));
		}
		function hex_hmac_md5(key, data) {
			return binl2hex(core_hmac_md5(key, data));
		}
		function b64_hmac_md5(key, data) {
			return binl2b64(core_hmac_md5(key, data));
		}
		function calcMD5(s) {
			return binl2hex(core_md5(str2binl(s), s.length * chrsz));
		}

		function core_md5(x, len) {
			x[len >> 5] |= 0x80 << ((len) % 32);
			x[(((len + 64) >>> 9) << 4) + 14] = len;
			var a = 1732584193;
			var b = -271733879;
			var c = -1732584194;
			var d = 271733878;
			for ( var i = 0; i < x.length; i += 16) {
				var olda = a;
				var oldb = b;
				var oldc = c;
				var oldd = d;

				a = md5_ff(a, b, c, d, x[i + 0], 7, -680876936);
				d = md5_ff(d, a, b, c, x[i + 1], 12, -389564586);
				c = md5_ff(c, d, a, b, x[i + 2], 17, 606105819);
				b = md5_ff(b, c, d, a, x[i + 3], 22, -1044525330);
				a = md5_ff(a, b, c, d, x[i + 4], 7, -176418897);
				d = md5_ff(d, a, b, c, x[i + 5], 12, 1200080426);
				c = md5_ff(c, d, a, b, x[i + 6], 17, -1473231341);
				b = md5_ff(b, c, d, a, x[i + 7], 22, -45705983);
				a = md5_ff(a, b, c, d, x[i + 8], 7, 1770035416);
				d = md5_ff(d, a, b, c, x[i + 9], 12, -1958414417);
				c = md5_ff(c, d, a, b, x[i + 10], 17, -42063);
				b = md5_ff(b, c, d, a, x[i + 11], 22, -1990404162);
				a = md5_ff(a, b, c, d, x[i + 12], 7, 1804603682);
				d = md5_ff(d, a, b, c, x[i + 13], 12, -40341101);
				c = md5_ff(c, d, a, b, x[i + 14], 17, -1502002290);
				b = md5_ff(b, c, d, a, x[i + 15], 22, 1236535329);
				a = md5_gg(a, b, c, d, x[i + 1], 5, -165796510);
				d = md5_gg(d, a, b, c, x[i + 6], 9, -1069501632);
				c = md5_gg(c, d, a, b, x[i + 11], 14, 643717713);
				b = md5_gg(b, c, d, a, x[i + 0], 20, -373897302);
				a = md5_gg(a, b, c, d, x[i + 5], 5, -701558691);
				d = md5_gg(d, a, b, c, x[i + 10], 9, 38016083);
				c = md5_gg(c, d, a, b, x[i + 15], 14, -660478335);
				b = md5_gg(b, c, d, a, x[i + 4], 20, -405537848);
				a = md5_gg(a, b, c, d, x[i + 9], 5, 568446438);
				d = md5_gg(d, a, b, c, x[i + 14], 9, -1019803690);
				c = md5_gg(c, d, a, b, x[i + 3], 14, -187363961);
				b = md5_gg(b, c, d, a, x[i + 8], 20, 1163531501);
				a = md5_gg(a, b, c, d, x[i + 13], 5, -1444681467);
				d = md5_gg(d, a, b, c, x[i + 2], 9, -51403784);
				c = md5_gg(c, d, a, b, x[i + 7], 14, 1735328473);
				b = md5_gg(b, c, d, a, x[i + 12], 20, -1926607734);
				a = md5_hh(a, b, c, d, x[i + 5], 4, -378558);
				d = md5_hh(d, a, b, c, x[i + 8], 11, -2022574463);
				c = md5_hh(c, d, a, b, x[i + 11], 16, 1839030562);
				b = md5_hh(b, c, d, a, x[i + 14], 23, -35309556);
				a = md5_hh(a, b, c, d, x[i + 1], 4, -1530992060);
				d = md5_hh(d, a, b, c, x[i + 4], 11, 1272893353);
				c = md5_hh(c, d, a, b, x[i + 7], 16, -155497632);
				b = md5_hh(b, c, d, a, x[i + 10], 23, -1094730640);
				a = md5_hh(a, b, c, d, x[i + 13], 4, 681279174);
				d = md5_hh(d, a, b, c, x[i + 0], 11, -358537222);
				c = md5_hh(c, d, a, b, x[i + 3], 16, -722521979);
				b = md5_hh(b, c, d, a, x[i + 6], 23, 76029189);
				a = md5_hh(a, b, c, d, x[i + 9], 4, -640364487);
				d = md5_hh(d, a, b, c, x[i + 12], 11, -421815835);
				c = md5_hh(c, d, a, b, x[i + 15], 16, 530742520);
				b = md5_hh(b, c, d, a, x[i + 2], 23, -995338651);
				a = md5_ii(a, b, c, d, x[i + 0], 6, -198630844);
				d = md5_ii(d, a, b, c, x[i + 7], 10, 1126891415);
				c = md5_ii(c, d, a, b, x[i + 14], 15, -1416354905);
				b = md5_ii(b, c, d, a, x[i + 5], 21, -57434055);
				a = md5_ii(a, b, c, d, x[i + 12], 6, 1700485571);
				d = md5_ii(d, a, b, c, x[i + 3], 10, -1894986606);
				c = md5_ii(c, d, a, b, x[i + 10], 15, -1051523);
				b = md5_ii(b, c, d, a, x[i + 1], 21, -2054922799);
				a = md5_ii(a, b, c, d, x[i + 8], 6, 1873313359);
				d = md5_ii(d, a, b, c, x[i + 15], 10, -30611744);
				c = md5_ii(c, d, a, b, x[i + 6], 15, -1560198380);
				b = md5_ii(b, c, d, a, x[i + 13], 21, 1309151649);
				a = md5_ii(a, b, c, d, x[i + 4], 6, -145523070);
				d = md5_ii(d, a, b, c, x[i + 11], 10, -1120210379);
				c = md5_ii(c, d, a, b, x[i + 2], 15, 718787259);
				b = md5_ii(b, c, d, a, x[i + 9], 21, -343485551);

				a = safe_add(a, olda);
				b = safe_add(b, oldb);
				c = safe_add(c, oldc);
				d = safe_add(d, oldd);
			}
			return Array(a, b, c, d);
		}
		function md5_cmn(q, a, b, x, s, t) {
			return safe_add(
					bit_rol(safe_add(safe_add(a, q), safe_add(x, t)), s), b);
		}
		function md5_ff(a, b, c, d, x, s, t) {
			return md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
		}
		function md5_gg(a, b, c, d, x, s, t) {
			return md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
		}
		function md5_hh(a, b, c, d, x, s, t) {
			return md5_cmn(b ^ c ^ d, a, b, x, s, t);
		}
		function md5_ii(a, b, c, d, x, s, t) {
			return md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
		}

		function core_hmac_md5(key, data) {
			var bkey = str2binl(key);
			if (bkey.length > 16)
				bkey = core_md5(bkey, key.length * chrsz);

			var ipad = Array(16), opad = Array(16);
			for ( var i = 0; i < 16; i++) {
				ipad[i] = bkey[i] ^ 0x36363636;
				opad[i] = bkey[i] ^ 0x5C5C5C5C;
			}
			var hash = core_md5(ipad.concat(str2binl(data)), 512 + data.length
					* chrsz);
			return core_md5(opad.concat(hash), 512 + 128);
		}

		function safe_add(x, y) {
			var lsw = (x & 0xFFFF) + (y & 0xFFFF);
			var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
			return (msw << 16) | (lsw & 0xFFFF);
		}

		function bit_rol(num, cnt) {
			return (num << cnt) | (num >>> (32 - cnt));
		}

		function str2binl(str) {
			var bin = Array();
			var mask = (1 << chrsz) - 1;
			for ( var i = 0; i < str.length * chrsz; i += chrsz)
				bin[i >> 5] |= (str.charCodeAt(i / chrsz) & mask) << (i % 32);
			return bin;
		}

		function binl2hex(binarray) {
			var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
			var str = "";
			for ( var i = 0; i < binarray.length * 4; i++) {
				str += hex_tab
						.charAt((binarray[i >> 2] >> ((i % 4) * 8 + 4)) & 0xF)
						+ hex_tab
								.charAt((binarray[i >> 2] >> ((i % 4) * 8)) & 0xF);
			}
			return str;
		}

		function binl2b64(binarray) {
			var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
			var str = "";
			for ( var i = 0; i < binarray.length * 4; i += 3) {
				var triplet = (((binarray[i >> 2] >> 8 * (i % 4)) & 0xFF) << 16)
						| (((binarray[i + 1 >> 2] >> 8 * ((i + 1) % 4)) & 0xFF) << 8)
						| ((binarray[i + 2 >> 2] >> 8 * ((i + 2) % 4)) & 0xFF);
				for ( var j = 0; j < 4; j++) {
					if (i * 8 + j * 6 > binarray.length * 32)
						str += b64pad;
					else
						str += tab.charAt((triplet >> 6 * (3 - j)) & 0x3F);
				}
			}
			return str;
		}
		return hex_md5(args);
	};
	/** *************��̬�������������**************** */
	/*
	 * ȫ�ֶ���PassportSC���� + ��ֵ PassportSC�Ǳ�js��¶��ȫ��window�µ�Ψһ���󣨻���һ��ȫ�ֵ�
	 * passportSetGlobalName �����������������ռ���Ⱦ �����������һ��ע�����ϣ��±ߵļ�������Ҫ��ȫ�ֱ���
	 */
	window['login_status'] = "";
	window['logout_status'] = "";
	window['renew_status'] = "";
	window['PassportCardList'] = [];
	window['PassportSC'] = {
		version : 27,
		versionDetail : 'New edition between 2013-08 to 2013-10 sohu passport team',
		appid : 9999,
		// һ��������2���ֽ�
		max_line_length : 30,
		domain : "",
		cookie : false,
		email : "",
		bindDomainSelector : true, /* �������б�ѡ��� */
		autopad : "", /* �Զ���д��������׺����չΪ��������м��Զ��ŷָ� */
		autoRedirectUrl : "", /* ��ĵط���½��ˢ�±�ҳ��ʱ�Ƿ��Զ���ת */
		loginRedirectUrl : "", /* �ڱ�ҳ���¼���Ƿ��Զ���ת */
		logoutRedirectUrl : "", /* �ڱ�ҳ���˳����Ƿ��Զ���ת */
		selectorTitle : "��ѡ�������û��˺�����",
		registerUrl : "https://passport.sohu.com/web/signup.jsp", /* ����ͨ��֤��URL */
		recoverUrl : "https://passport.sohu.com/web/recover.jsp", /* ���������URL */
		postru : "",
		emailPostfix : false,
		curDSindex : -1,
		usePost : 1, // �ؼ�������������ҳ����ʹ��post��ʽ(1)�ύ����get��ʽ(0)��Ĭ����post����Ʒ�߿��Զ���
		successCalledFunc : false, /* ��¼�ɹ���Ļص����� */
		curCardIndex : 0,

		loginSuccCallbackName : 'loginSuccessCallFunction',
		loginFailCallbackName : 'loginFailCallFunction',
		returnUrl : '',

		oElement : false,
		rootElement : false,
		dsElement : false,
		sElement : false,
		cElement : false,
		dsAnchor : false,
		emailInput : false,
		passwdInput : false,
		pcInput : false,
		loginMsg : false,
		iElement : false,
		isSetFocus : true, /* �Ƿ��Զ����������Ľ��� */
		showEmailInit : true, /* ��ʼ��ʱ�Ƿ����û���������lastdomain��cookie�����û��� */

		loginProtocol : window.location.protocol === 'https:' ? 'https' : 'http',
		setCookieProtocol : window.location.protocol === 'https:' ? 'https' : 'http',
		http_url : false,
		loginUrl : '://passport.sohu.com/user/login',

		eInterval : false,
		maxIntervalCount : 100,
		intervalCount : 0,
		state : "0000", // Э��|�ڶ���Э��|��һ�γɹ�����ʧ��|�ڶ��γɹ�����ʧ�� https:1 http:2 ,ʧ�ܣ�1,�ɹ�2
		
		postLoginClicked : false, //for post login clicked
		postLoginTimeout : false, //for post login time out
		postLoginTimeoutTime : 10 * 1000, //post login time out time by ms

		defualtRemPwd : "", /* checkedΪĬ��ѡ�м�ס���� */
		isShowRemPwdMsg : 0, /* 1Ϊalert��ʾȷ��Ҫ��ס���� */
		campImg : "http://js.sohu.com/passport/images/pic007.gif", /* ���ƴ�Ӫ��ͼƬ */
		campImgAlt : "��Ӫ", /* ���ƴ�Ӫ��alt���� */
		campUrl : "http://blog.sohu.com/camp?from=", /* ���ƴ�Ӫ�����ӵ�ַ */
		cardTitle : "���Ѻ���֪����", /* ���ƿ�Ƭ����ı��� */
		firstDomain : "", /* ��Ʒ���Ƶ�����������ʾ�ĵ�һ������ */

		defaultApp : "",
		domainPool : [ "chinaren.com", "sogou.com" ],
		// �Զ���ʾ�������������б�
		domainList : [ "sohu.com", "uniqname", "chinaren.com", "sogou.com",
				"vip.sohu.com", "17173.com", "focus.cn", "game.sohu.com",
				"37wanwan.com" ],
		appList : {
			"1051" : "news_say",
			"1017" : "pp",
			"1019" : "blog",
			"1073" : "t",
			"1074" : "tv",
			"1000" : "mail",
			"1001" : "club",
			"1062" : "bai",
			"1005" : "alumni",
			"10050" : "chinaren",
			"1038" : "crclub",
			"1039" : "group",
			"1021" : "music",
			"1010" : "say",
			"1042" : "cbbs",
			"1028" : "focus",
			"1029" : "17173",
			"1013" : "vip",
			"1035" : "rpggame",
			"1044" : "pinyin",
			"1022" : "relaxgame"
		},
		appName : {
			"news_say" : "����˵����",
			"pp" : "���",
			"blog" : "����",
			"t" : "΢��",
			"tv" : "��Ƶ",
			"mail" : "�ʼ�",
			"club" : "����",
			"bai" : "�����",
			"alumni" : "У��¼",
			"chinaren" : "ChinaRen",
			"crclub" : "CR����",
			"group" : "Ⱥ��",
			"music" : "���ֺ�",
			"say" : "˵��",
			"cbbs" : "У����̳",
			"focus" : "���㷿��",
			"17173" : "��Ϸ��̳",
			"vip" : "vip����",
			"rpggame" : "RPG��Ϸ",
			"pinyin" : "���뷨",
			"relaxgame" : "������Ϸ"
		},
		appUrl : {
			"news_say" : "http://i.sohu.com/scomment/home/all/",
			"pp" : "http://pp.sohu.com/",
			"blog" : "http://blog.sohu.com/",
			"t" : "http://t.sohu.com",
			"tv" : "http://tv.sohu.com",
			"mail" : "http://mail.sohu.com/",
			"club" : "http://club.sohu.com",
			"bai" : "http://bai.sohu.com",
			"alumni" : "http://class.chinaren.com",
			"chinaren" : "",
			"crclub" : "http://club.chinaren.com",
			"group" : "http://i.chinaren.com/group",
			"say" : "http://s.sogou.com",
			"music" : "http://mbox.sogou.com/",
			"cbbs" : "http://cbbs.chinaren.com",
			"focus" : "http://www.focus.cn",
			"17173" : "http://bbs.17173.com",
			"vip" : "http://vip.sohu.com",
			"rpggame" : "http://game.sohu.com",
			"pinyin" : "http://pinyin.sogou.com",
			"relaxgame" : "http://game.sohu.com/index2.htm"
		},
		appPool : false,
		bottomRow : [],
		recomServ : [], /* Passport�Ƽ���ķ��� */
		reverseFirstDomain : false, // �����������ֻ��ţ�firstdomain��ʾΪsohu.com
		// ,����firstdomain����ԭ����
		showEmailInputTip : true,
		usePostFix : true,
		gotohref : function(url) {
			var a;
			a = document.createElement('a');
			a.setAttribute("href", url);
			document.body.appendChild(a);
			a.click();
			/*
			if (getBrowserType() == 1) {
				// IE6���⴦��
				a = document.createElement('a');
				a.setAttribute("href", url);
				document.body.appendChild(a);
				a.click();
			} else {
				window.location = url;
				return;
			}
			*/
		},
		getDomain : function() {
			// ֻ֧�� focus.cn/sohu.com/chinaren.com/17173.com/sogou.com �͹���
			return document.domain.split('.').slice(-2).join('.');
		},
		addCookie : function(name, value, expireHours, domain) {
			if (this.domain === "")
				this.domain = this.getDomain();
			var cookieString = name + "=" + escape(value)
					+ "; path=/; domain=." + (domain ? domain : this.domain)
					+ ";";
			// �ж��Ƿ����ù���ʱ��
			if (expireHours > 0) {
				var date = new Date();
				date.setTime(date.getTime() + expireHours * 3600 * 1000);
				cookieString += "expires=" + date.toGMTString() + ";";
			}
			document.cookie = cookieString;
		},
		getCookie : function(name) {
			if (!name)
				return "";
			var cookies = document.cookie.split('; ');
			for ( var i = 0; i < cookies.length; i++) {
				if (cookies[i].indexOf(name + '=') === 0) {
					return cookies[i].substr(name.length + 1);
				}
			}
			return "";
		},
		deleteCookie : function(name) {
			if (this.domain === "")
				this.domain = this.getDomain();
			var date = new Date();
			date.setTime(date.getTime() - 100000);
			var cval = this.getCookie(name);
			document.cookie = name + "=" + cval + "; expires="
					+ date.toGMTString() + "; path=/; domain=." + this.domain
					+ ";";
		},
		preventEvent : function(e) {
			try {
				e.cancelBubble = true;
				e.returnValue = false;
				e.preventDefault && e.preventDefault();
				e.stopPropagation && e.stopPropagation();
			} catch (ee) {
			}
		},
		getPosition : function(ele, name) {
			var pos = 0;
			while (ele) {
				pos += ele[name];
				ele = ele.offsetParent;
			}
			return pos;
		},
		getTime : function() {
			return new Date().getTime();
		},
		getHead : function() {
			return document.getElementsByTagName('head')[0];
		},
		getBody : function() {
			return document.getElementsByTagName('body')[0];
		},
		strip : function(s) {
			return s.replace(/^\s+/, '').replace(/\s+$/, '');
		},
		reportMsg : function(code) {
			var msg = '';
			//���ݲ���Ϊ���ֵ����
			switch ( code.toString() ) {
			case '1':
				msg = '������ͨ��֤�˺�';
				break;
			case '2':
				msg = 'ͨ��֤�˺�Ϊ�ʼ���ַ��ʽ';
				break;
			case '3':
				msg = '�˺ź�׺����Ϊ' + arguments[1];
				break;
			case '4':
				msg = '������ͨ��֤����';
				break;
			case '5':
				var email = this.strip(this.emailInput.value);
				if (email.lastIndexOf("@focus.cn") > 0) {
					msg = '�˺Ż��������!��ѯ�绰:010-58511234';
				} else {
					msg = '�˺Ż��������';
				}
				break;
			case '6':
				msg = '��¼��ʱ�����Ժ�����';
				break;
			case '7':
				msg = '��¼ʧ�ܣ�������';
				break;
			case '8':
				msg = '������ϣ��˳�ʧ�ܣ��������˳�';
				break;
			case '9':
				msg = '��¼ʧ�ܣ����Ժ�����';
				break;
			case '10':
				// msg += '��ʱ���ɵ�¼�����Ժ�����';
				msg = '����¼����Ƶ������24Сʱ������';
				break;
			case '11':
				msg = '��⵽�����cookie�����ã�������cookie������';
				break;
			case '12':
				msg = '���������ϣ����Ժ�����';
				break;
			case '13':
				msg = '�˺��ѱ����������ȵ�<a href="http://hudun.sohu.com/help/help9.html" target="blank">����</a>����';
				break;
			case '14':
				msg = '��̬�����������������';
				break;
			case '15':
				msg = '�����붯̬����';
				break;
			case '16':
				msg = '�˺�δ������Ƚ������伤���˺�';
				break;
			case '17':
				msg = '�˺��ѱ�����������ϵ�ͷ�';
				break;
			case '18':
				msg = '��֤�����';
				break;
			case '19':
				msg = '�û�IP�ѱ�����';
				break;
			case '20':
				msg = '�˺Ż��������';
				break;
			case '21':
				msg = '�˺ű������������������ܽ�����';
				break;
			default:
				msg = '��¼�������Ժ�����';
				break;
			}
			this.showMsg(msg);
		},
		showMsg : function(msg) {
			if (!this.loginMsg)
				return;
			this.loginMsg.innerHTML = msg;
		},
		// �������ⲿ�Ĳ�Ʒ�����øú���������userid
		cookieHandle : function() {
			if (!this.cookie) {
				this.parsePassportCookie();
			}
			if (this.cookie && this.cookie['userid'] !== '') {
				return this.cookie['userid'];
			}
			return "";
		},
		getDisplayName : function() {
			var userid = this.cookieHandle();
			var userid_prefix = userid.split("@")[0];
			var pattern = /^1\d{10}$/;
			if (pattern.test(userid_prefix)) {
				return userid_prefix.substring(0, 3) + "****"
						+ userid_prefix.substring(7);
			} else {
				return userid;
			}
		},
		// ����lastdomain��cookieֵ������ emailPostfix
		parseLastDomain : function(list) {
			this.emailPostfix = [];
			var entiredomain = "", specDomain = "";
			var lastdomain_ar = [];
			var cookies = document.cookie.split('; ');
			for ( var i = 0; i < cookies.length; i++) {
				if (cookies[i].indexOf('lastdomain=') === 0) {
					try {
						lastdomain_ar = unescape(cookies[i].substr(11)).split('|');
						/*
						if (lastdomain_ar.length == 4) {
							var isnotSLogin = lastdomain_ar[3];
							if (isnotSLogin !== null && isnotSLogin == "1") {
								this.loginProtocol = "http";
								this.setCookieProtocol = "http";
							}
						}
						*/
					} catch (e) {
					}
					break;
				}
			}
			var j = 0;
			// ����cookie�б���ĵ�¼�û�����������ǰ��
			var lastAccount = '';
			if (lastdomain_ar.length >= 3) {
				var userid_raw_info = Base64.decode(lastdomain_ar[1]);
				var userid_ar = userid_raw_info.split("|");
				for ( var i = userid_ar.length - 1; i >= 0 ; i--) {
					if (userid_ar[i] !== "") {
						this.emailPostfix[j] = userid_ar[i];
						j++;
						lastAccount = userid_ar[i];
					}
				}
				if( /^.*@.{1,}\.sohu\.com$/.test(lastAccount) ){
					lastAccount = '';
				}
				if( this.showEmailInit && this.emailInput ){
					this.emailInput.value = lastAccount;
				}
			}
			// ���ָ����firstDomain,�����ȷ�ǰ��
			if (this.firstDomain !== "") {
				for ( var m in list) {
					if (this.firstDomain == list[m]) {
						specDomain = list[m];
						break;
					}
				}
				if (specDomain !== "") {
					this.emailPostfix[j] = specDomain;
					j++;
				}
			}
			// �����ǰ��game.sohu.com����Ҳ��������ǰ��
			if (document.domain.indexOf("game.sohu.com") >= 0) {
				entiredomain = "game.sohu.com";
				this.emailPostfix[j] = entiredomain;
				j++;
			}
			// Ȼ����ñ����domain
			this.emailPostfix[j] = this.domain;
			j++;
			// ������������domain
			for ( var n in list) {
				if (typeof list[n] != 'string')
					continue;
				if (list[n] != this.domain && list[n] != entiredomain
						&& list[n] != specDomain) {
					this.emailPostfix[j] = list[n];
					j++;
				}
			}
		},
		drawPassport : function(element) {
			if (typeof (element) != "object") {
				return;
			}
			// ��ֻ֤����PassportSC.drawPassport����ʱ��д���һ��Ԫ��
			if (PassportCardList.length == 0) {
				PassportCardList[0] = this;
			}
			// ȱʡ��һ����Ƭ�Ļص�����
			if (!this.successCalledFunc) {
				try {
					this.successCalledFunc = eval("drawAppInfo");
				} catch (e) {
					this.successCalledFunc = this.drawPassportInfo;
				}
			}
			this.init(element);

			if (this.cookie
					&& (this.cookie['userid'] != '' || this.relationHandle() != '')) {
				if (this.autopad != "") {
					// ���������autopad����ô��ʹ��ǰ��¼�ˣ����û�����autopad������Ҳ����ʾ��¼��,
					// edit by jiangyan@20100720 ���˻�����ʱӦ�ÿ���relationHandle
					var userid = this.relationHandle() != '' ? this
							.relationHandle() : this.cookie['userid'];
					var at = userid.lastIndexOf("@");
					if (at > 0) {
						if (this.autopad.lastIndexOf(userid.substr(at + 1)) < 0) {
							this.drawLoginForm();
							return;
						}
					}
				}
				// �ж���ҳ�Ƿ��Զ���ת
				if (this.autoRedirectUrl != "") {
					PassportSC.gotohref(this.autoRedirectUrl);
				}
				// ����Ҫ�Զ���ת����ֱ�ӻ���Ƭ
				else {
					this.drawPassportCard();
				}
			} else {
				this.drawLoginForm();
			}
		},
		init : function(element) {
			this.rootElement = element;
			var noTitle = this.selectorTitle === null
					|| this.selectorTitle.length === 0;
			this.rootElement.innerHTML = '<div class="ppselecter" style="display: none;border:1px solid #B6D3FC; border-top:0 none;">'
					+ '<table width="100%" cellspacing="0" cellpadding="0" style="table-layout:fixed;">'
					+ '<tbody>'
					+ '<tr>'
					+ (noTitle ? ''
							: ('<td style="" class="ppseltit" id="ppseltitId">'
									+ this.selectorTitle + '</td>'))
					+ '</tr>'
					+ '<tr>'
					+ (noTitle ? '<td height="0"></td>'
							: '<td height="2"></td>')
					+ '</tr>'
					+ '<tr>'
					+ '<td></td>'
					+ '</tr>'
					+ '</tbody>'
					+ '</table>'
					+ '</div>'
					+ '<div style="display: none;">'
					+ '</div>'
					+ '<div class="passportc">' + '</div>';
			this.dsElement = this.rootElement.childNodes[0];
			this.sElement = this.rootElement.childNodes[1];
			this.cElement = this.rootElement.childNodes[2];
			this.dsAnchor = this.dsElement.firstChild.rows[2].firstChild;
			// �õ���ǰ�������domain
			this.domain = this.getDomain();
			// ����domanselect list
			this.parseLastDomain(this.domainList);
			this.parseAppid();
			// ����ִ�� parseAppid ����� parsePassportCookie
			this.parsePassportCookie();
			// ������Cookie������������ķ�������
			// this.getBottomRow();
			// ���ﻹ��һЩ����.. ��Ҫ���� URL�������ǲ��� http post ʧ����ת������ҳ��
			if (this.postru == "") {
				this.postru = document.location.href;
			}
		},
		parseAppid : function() {
			var id = this.appid.toString();
			var i = 0;
			this.appPool = new Array();
			for ( var j in this.appList) {
				var x = this.appList[j];
				if (typeof (x) != 'string')
					continue;
				if (j == id) {
					this.defaultApp = this.appName[x];
				} else {
					// Focus�ĵ�������ʹ��2������
					if (j == "1028") {
						this.appPool[i] = {
							"app" : "focus",
							"name" : "����ҵ����̳",
							"url" : "http://house.focus.cn/group/yezhu.php"
						};
						i++;
						this.appPool[i] = {
							"app" : "focus",
							"name" : "װ����̳",
							"url" : "http://home.focus.cn/group/group_forum.php"
						};
					} else {
						this.appPool[i] = {
							"app" : x,
							"name" : this.appName[x],
							"url" : this.appUrl[x]
						};
					}
					i++;
				}
			}
		},
		parsePassportCookie : function() {
			var cookies = document.cookie.split('; ');
			var cvalue;
			for ( var i = 0; i < cookies.length; i++) {
				if (cookies[i].indexOf('ppinf=') === 0) {
					cvalue = cookies[i].substr(6);
					break;
				}
				if (cookies[i].indexOf('ppinfo=') === 0) {
					cvalue = cookies[i].substr(7);
					break;
				}
				if (cookies[i].indexOf('passport=') === 0) {
					cvalue = cookies[i].substr(9);
					break;
				}
			}
			if (typeof cvalue === 'undefined') {
				this.cookie = false;
				return;
			}
			try {
				var x = unescape(cvalue).split('|');
				if (x[0] == '1' || x[0] == '2') {
					var cookie_raw_info = Base64.decode(x[3]);
					this._parsePassportCookie(cookie_raw_info);
					return;
				}
			} catch (e) {
			}
		},
		_parsePassportCookie : function(str) {
			var arr = str.split('|');
			this.cookie = {};
			var key, value, tmp;
			for ( var i = 0, l = arr.length; i < l; i++) {
				if (arr[i].length === 0)
					continue;
				tmp = arr[i].split(':');
				if (tmp.length !== 3)
					continue;
				if (parseInt(tmp[1], 10) !== tmp[2].length)
					continue;
				key = tmp[0];
				value = tmp[2];
				this.cookie[key] = value;
			}
			relation_userid = this._parserRelation();
			if (relation_userid) {
				this.cookie[k] = relation_userid;
			}
		},
		_parserRelation : function() {
			var relations = this.cookie['relation'];
			if (relations) {
				var arr = relations.split(";");
				for ( var i = 0; i < arr.length; i++) {
					var barr = arr[i].split(",");
					var appids = barr[2].split("#");
					for ( var j = 0; j < appids.length; j++) {
						if (this.appid == appids[j]) {
							return barr[0];
						}
					}
				}
			}
			return "";
		},
		doLogin : function() {
			var email = this.strip(this.emailInput.value);
			var password = this.strip(this.passwdInput.value);
			var pc = this.pcInput.checked == true ? 1 : 0;
			// �û���Ϊ�գ���ʾ�����û���
			if (email == "") {
				this.reportMsg('1');
				this.emailInput.focus();
				return false;
			}
			// ���autopad��Ϊ�գ�������ֻ�����뱾����û�
			if (this.autopad != "") {
				var dpostfix = email.substr(email.lastIndexOf('@') + 1);
				if (this.autopad.lastIndexOf(dpostfix) < 0) {
					this.reportMsg('3', this.autopad);
					this.emailInput.focus();
					this.passwdInput.value = "";
					return false;
				}
			}
			// ����Ϊ�գ���ʾ��������
			if (password == "") {
				this.reportMsg('4');
				this.passwdInput.value = "";
				this.passwdInput.focus();
				return false;
			}
			// ��ʾPassport�ȴ�״̬��
			// this.drawPassportWait( '���ڵ�¼�Ѻ�ͨ��֤�����Ժ�...' );
			if (this.usePost === 1) {
				if( this.postLoginClicked ){
					return false;
				}else{
					return this.doPostLogin();
				}
			} else {
				if (this.eInterval)
					return false; // �����ж�һ�£������������ε��
				if (arguments[0]) {
					PassportCardList[index].doLogin();
				}
				login_status = "";
				this.intervalCount = 0;
				this.sElement.innerHTML = "";
				return this.loginHandle(email, password, pc, this.sElement,
						this.loginFailCall.bindFunc(this),
						this.loginSuccessCall.bindFunc(this));
			}
		},
		doPostLogin : function() {
			var self = this;
			this.postLoginClicked = true;
			this.postLoginTimeout = setTimeout(function(){
				self.postLoginClicked = false;
				self.reportMsg('6');
			}, this.postLoginTimeoutTime);
			var form, _forms = document.forms;
			for ( var i = 0, l = _forms.length; i < l; i++) {
				if (_forms[i].name == "loginform") {
					form = _forms[i];
					break;
				}
			}
			// û���ҵ���¼��form������ֱ����ת��psssport.sohu.comҳ��
			if (!form) {
				document.location.href = this.loginProtocol
						+ "://passport.sohu.com";
				return false;
			}
			// �õ������������
			var b = getBrowserType();
			// �õ���Ļ���
			var w = screen.width;
			//remember password or not
			var pc = this.pcInput.checked == true ? 1 : 0;
			var slogin = window.location.protocol == 'https:' ? 1 : 0;
			// �������passport.sohu.comҳ���½�������迼�ǿ������⣬ֱ��post���ɡ�
			/*
			 * if( document.domain === 'passport.sohu.com' ){ form.method =
			 * 'post'; form.action = this.loginProtocol + this.loginUrl;
			 * this.addHiddenInput(form, 'appid', this.appid);
			 * this.addHiddenInput(form, 'b', b); this.addHiddenInput(form, 'w',
			 * w); return true; }
			 */
			// Ϊ��ʹ�ɹ��Ļص�������ȷ�ı����ã���Ҫ���� document.domain ֵΪ���������
			// ��house.focus.cn��Ҫ����document.domain='focus.cn'
			// ����Ƕ�document.domain�Ĳ��ɻָ����ƻ��Բ��������ܻ��ԭҳ����Ƕ�������iframe���Ӱ�죬ֱ��ҳ��ˢ�·��ɻָ�
			// �������passport.sohu.comҳ���½�������迼�ǿ������⡣
			/*
			if (document.domain !== 'passport.sohu.com') {
				document.domain = this.getDomain();
				d = this.getDomain();
			}
			*/
			document.domain = this.getDomain();
			var d = this.getDomain();
			// �������ص�iframe����Ϊform�ύ��target
			// IE�ڵ���document.createElement('iframe')������Ϊiframe.name��ֵ�ᱻIE�Զ��޸�ΪsubmitName������form����target�޷���ȷָ����Ҫ���⴦��
			if (!document.getElementById('sohuPassportFrame')) {
				var ifr;
				try {
					ifr = document
							.createElement('<iframe name="sohuPassportFrame"></iframe>');
				} catch (e) {
					ifr = document.createElement('iframe');
					ifr.name = "sohuPassportFrame";
				}
				ifr.id = "sohuPassportFrame";
				ifr.style.width = '0px';
				ifr.style.height = '0px';
				ifr.style.display = 'none';
				document.body.appendChild(ifr);
			}
			// Ϊform����������input����Ҫpost������
			try {
				this.addHiddenInput(form, 'appid', this.appid);
				this.addHiddenInput(form, 'loginSuccessCallFunction', 'postLoginSuccessCall');
				this.addHiddenInput(form, 'loginFailCallFunction', 'postLoginFailCall');
				this.addHiddenInput(form, 'domain', d);
				this.addHiddenInput(form, 'ru', this.postru);
				this.addHiddenInput(form, 'b', b);
				this.addHiddenInput(form, 'w', w);
				this.addHiddenInput(form, 'v', this.version);
				this.addHiddenInput(form, 'persistentcookie', pc);
				this.addHiddenInput(form, 'isSLogin', slogin);
			} catch (e) {
				return false;
			}
			form.target = 'sohuPassportFrame';
			form.method = 'post';
			form.action = this.loginProtocol + this.loginUrl;
			// form.action = "http://ptest.sohu.com:9000/sso/login_js.jsp";

			this.sendLog(document.getElementsByTagName('head')[0], 'beginLogin', '0');

			return true;
		},
		// Ϊform����������input
		addHiddenInput : function(ele, key, val) {
			if (typeof ele !== 'object' && ele.tagName.toLowerCase() !== 'form')
				return;
			var inputs = document.getElementsByTagName('input', ele);
			for ( var i = 0, l = inputs.length; i < l; i++) {
				if (key === inputs[i].getAttribute('name')) {
					//this persistentcookie hidden input should be refreshed every time
					if(key === 'persistentcookie'){
						inputs[i].value = val;
					}
					return;
				}
			}
			var tmp = document.createElement('input');
			tmp.type = 'hidden';
			tmp.name = key;
			tmp.value = val;
			ele.appendChild(tmp);
		},
		// �������ⲿ�Ĳ�Ʒ���ø�js��ʵ�ֵ�¼������Ϊһ��node
		loginHandle : function(user_id, pwd, pc, ele, lfc, lsc) {
			// �ж�ele�Ƿ��Ƕ������͵�
			if (typeof (ele) != "object") {
				return false;
			}
			if (!checkCookieEnabled()) {
				lfc();
				return false;
			}
			login_status = "";
			// �õ������������
			var b = getBrowserType();
			// �õ���Ļ���
			var w = screen.width;
			// �õ���ǰ�������domain
			if (this.domain == "") {
				this.domain = this.getDomain();
			}
			var ra = this.getTime();
			var pwd_md5 = MD5(pwd);
			var t = this.getTime();

			var stoken = "";
			if (document.getElementById("stoken")) {
				stoken = PassportSC
						.strip(document.getElementById("stoken").value);
			}
			this.http_url = (this.loginProtocol == "https"
					&& ra > MIN_HTTS_TIMESTAMP ? 'https' : 'http')
					+ '://passport.sohu.com/act/login?userid='
					+ (typeof encodeURIComponent === 'function' ? encodeURIComponent(user_id)
							: user_id)
					+ '&password='
					+ pwd_md5
					+ '&appid='
					+ this.appid
					+ '&persistentcookie='
					+ pc
					+ (this.loginProtocol == "https" && ra > MIN_HTTS_TIMESTAMP ? '&isSLogin=1'
							: '')
					+ '&s='
					+ ra
					+ '&b='
					+ b
					+ '&w='
					+ w
					+ '&pwdtype=1'
					+ '&v='
					+ this.version
					+ '&t='
					+ t
					+ '&stoken='
					+ stoken
					+ (this.domain != "sohu.com" ? '&domain=' + this.domain
							: '');
			if (this.loginProtocol == "https") {
				this.state = "1100";
			} else {
				this.state = "2200";
			}

			// ��¼���͵�½�������־
			this.sendLog(ele, "beginLogin", "0");

			var newScript = document.createElement("script");
			//newScript.src = url;
			newScript.src = this.http_url;
			newScript.id = "loginele";
			ele.appendChild(newScript);

			var self = this;
			this.eInterval = setInterval(function() {
				self.loginIntervalProc(lfc, lsc, ele);
			}, 100);
			return false;
		},
		loginIntervalProc : function(lfc, lsc, ele) {
			if (login_status == ""
					&& this.intervalCount < this.maxIntervalCount) {
				this.intervalCount++;
				return;
			}
			/* ��ʱ�з��ؽ���������Ѿ���ʱ��clear..... */
			clearInterval(this.eInterval);
			this.eInterval = false;
			// ��ʱ����־
			if (login_status == ""
					&& this.intervalCount >= this.maxIntervalCount) {
				var flag = "";
				if (this.state == "2200") {
					// �״�http��ʱ
					flag = "1";
					this.state = "2210";
				} else if (this.state == "1200") {
					// �״�����Э��https��ʱ�ģ��Һ�����http��¼�����Գ�ʱ�ģ�flagΪ3
					this.state = "1210";
					flag = "3";
				}
				this.sendLog(ele, "login timeout" + this.state, flag);
			}
			// �״�����Э��https��ʱ�ģ���������http��¼����ɹ��ģ�flagΪ2
			if (login_status == "success") {
				this.addCookie("pp_login_time", this.loginProtocol + "|"
						+ this.email + "|" + this.appid + "|"
						+ getBrowserType() + "|" + this.intervalCount + "|"
						+ this.state, -1, "sohu.com");
				if (this.state == "1200") {
					this.sendLog(ele, "login success", "2");
				}
			}
			if (login_status != "success"
					|| this.intervalCount >= this.maxIntervalCount) {
				if (this.loginProtocol == "https" && login_status == "") {
					this.intervalCount = 0;
					this.loginProtocol = "http";
					this.state = "1200";
					/**
					 * Jady@2011.9.5: ��url��https��Ϊhttp
					 */
					if (this.http_url.charAt(4) == 's') {
						this.http_url = 'http' + this.http_url.substr(5);
					}
					if (this.domain != "sohu.com") {
						this.http_url += "&domain=" + this.domain;
					}
					var newScript = document.createElement("script");
					newScript.src = this.http_url;
					ele.appendChild(newScript);
					var self = this;
					this.eInterval = setInterval(function() {
						self.loginIntervalProc(lfc, lsc, ele);
					}, 100);
				} else {
					lfc();
				}
				return;
			}
			// ���Զ���ת��ҳ������������cookie
			if (this.loginRedirectUrl == "") {
				this.autoProcAllDomain("login", ele);
			}
			// �Զ���ת�ģ�������cookie
			else {
				this.addCookie("crossdomain", this.getTime(), 336);
			}
			lsc();
		},
		// ��¼ʧ�ܺ�Ļص�����
		loginFailCall : function() {
			this.sElement.innerHTML = "";
			this.drawLoginForm();
			if (this.intervalCount >= this.maxIntervalCount) {
				this.reportMsg('6');
				this.emailInput.focus();
			} else if (login_status == 'error3' || login_status == 'error2') {
				this.reportMsg('5');
				this.passwdInput.focus();
			} else if (login_status == 'error5') {
				this.reportMsg('10');
				this.passwdInput.focus();
			} else if (login_status == 'error13') {
				window.location = this.loginProtocol
						+ "://passport.sohu.com/web/remind_activate.jsp";
				return;
			} else if (login_status == 'error11') {
				this.reportMsg('12');
				this.passwdInput.focus();
			} else if (login_status == 'error8') {
				this.reportMsg('13');
				this.passwdInput.focus();
			} else if (login_status == 'error9') {
				this.reportMsg('14');
			} else if (!checkCookieEnabled()) {
				this.reportMsg('11');
				this.emailInput.focus();
			} else {
				this.reportMsg('9');
				this.passwdInput.focus();
			}
		},
		// ��¼�ɹ���ص�����
		loginSuccessCall : function() {
			this.parsePassportCookie();
			if (this.cookie && this.cookie['userid'] != '') {
				this.email = "";
				// ��¼�ɹ����Ƿ��Զ���ת
				if (this.loginRedirectUrl != "") {
					this.gotohref(this.loginRedirectUrl);
				} else {
					// ����Ҫ�Զ���ת���ͻ���Ƭ
					this.drawPassportCard();
				}
			} else {
				this.drawLoginForm();
				this.reportMsg('7');
			}
		},
		//post login callback
		postLoginSuccessCall : function(){
			if( this.postLoginTimeout ){
				clearTimeout( this.postLoginTimeout );
				this.postLoginTimeout = false;
			}
			this.postLoginClicked = false;
			this.loginSuccessCallFunction();
		},
		postLoginFailCall : function(){
			if( this.postLoginTimeout ){
				clearTimeout( this.postLoginTimeout );
				this.postLoginTimeout = false;
			}
			this.postLoginClicked = false;
			this.loginFailCallFunction( arguments[0] );
		},
		loginSuccessCallFunction : function() {
			//��Ʒ����Ҫ�Լ�ʵ�ֵĵ�¼�ɹ��ص�
		},
		loginFailCallFunction : function( type ) {
			//��Ʒ����Ҫ�Լ�ʵ�ֵĵ�¼ʧ�ܻص�
			//����type��ʾʧ�ܵ�����
			//����reportMsg����
		},
		drawPassportCard : function() {
			this._drawPassportCard();
			var vlink = document.getElementById("ppcontid");
			vlink.onclick = this.doClickLink.bindFunc(this);
			this.initiElement();
			// ��¼�ɹ����ٵ���������Ʒ���ṩ��һ������
			try {
				if (this.iElement != null) {
					this.successCalledFunc(this.iElement);
				} else {
					try {
						this.drawPassportInfo();
					} catch (e) {

					}
				}
			} catch (e) {
				this.drawPassportInfo();
			}
		},
		// TODO:�����ǵ�¼�ɹ���passport��Ƭ�õķ�����ò�������Ʒ�߶�������ͬ����������Ƿ�����Ҫ��Ʒ���Լ���ʵ�֣��д�����
		_drawPassportCard : function() {

		},
		// �������ӵĵ���¼�
		doClickLink : function(_event) {
			var event = window.event ? window.event : _event;
			var srcName = event.srcElement || event.target;
			var tName = srcName.tagName.toLowerCase();
			var userid = this.cookie['userid'];
			var furl = document.location.href;
			var pname = "";
			if (tName == "img") {
				tName = srcName.parentNode.tagName.toLowerCase();
				srcName = srcName.parentNode;
			}
			if (tName == "a") {
				var newScript = document.createElement("script");
				newScript.src = this.loginProtocol
						+ "://passport.sohu.com/web/golog.jsp?userid=" + userid
						+ "&fappid=" + this.appid + "&furl=" + furl + "&turl="
						+ srcName;
				this.iElement.appendChild(newScript);
			}
		},
		initiElement : function() {
			this.iElement = document.getElementsByClassName('listContA')[0];
		},
		// ��ʾ��½�ȴ���Ϣ
		drawPassportWait : function(str) {

		},
		drawPassportInfo : function() {

		},
		// �ṩ����Ʒ����д����½�ɹ��Ļص�
		loginSuccessCallback : function() {

		},
		// �ṩ����Ʒ����д����½ʧ�ܵĻص�
		loginFailCallback : function() {

		},
		doLogout : function() {
			if (this.eInterval)
				return; // �����ж�һ�£������������ε���˳�
			this.intervalCount = 0;
			this.sElement.innerHTML = "";
			this.logoutHandle(this.sElement,
					this.logoutFailCall.bindFunc(this), this.logoutSuccessCall
							.bindFunc(this, "dd"));
		},
		// �������ⲿ��Ʒ�������˳�
		logoutHandle : function(ele, lfc, lsc) {
			// �ж�ele�Ƿ��Ƕ������͵�
			if (typeof (ele) != "object") {
				return false;
			}
			logout_status = "";
			// �õ���ǰ�������domain
			if (this.domain == "") {
				this.domain = this.getDomain();
			}
			var ra = this.getTime();
			var url = this.loginProtocol
					+ '://passport.sohu.com/act/logout?s=' + ra + '&appid='
					+ this.appid;
			if (this.domain != "sohu.com") {
				url += "&domain=" + this.domain;
			}
			var newScript = document.createElement("script");
			newScript.src = url;
			ele.appendChild(newScript);
			var self = this;
			this.eInterval = setInterval(function() {
				self.logoutIntervalProc(lfc, lsc, ele);
			}, 100);
		},

		logoutIntervalProc : function(lfc, lsc, ele) {
			if (logout_status == ""
					&& this.intervalCount < this.maxIntervalCount) {
				this.intervalCount++;
				return;
			}

			/* ��ʱ�з��ؽ���������Ѿ���ʱ��clear..... */
			clearInterval(this.eInterval);
			this.eInterval = false;
			// �˳�ʧ��
			if (logout_status == ""
					&& this.intervalCount >= this.maxIntervalCount) {
				lfc();
				var newScript = document.createElement("script");
				var browerType = getBrowserType();
				newScript.src = this.loginProtocol
						+ "://passport.sohu.com/web/cardlog.jsp?desc=logout timeout&loginProtocol="
						+ this.loginProtocol + "&userid=" + this.email
						+ "&appid=" + this.appid + "&browserType=" + browerType;
				ele.appendChild(newScript);
				return;
			}
			if (logout_status != "success") {
				lfc();
				return;
			}
			// ���Զ���ת��ҳ�������������cookie
			if (this.logoutRedirectUrl == "") {
				this.autoProcAllDomain("logout", ele);
			} else {// �Զ���ת�ģ�������cookie
				this.addCookie("crossdomain_logout", this.getTime(), 336);
			}
			lsc();
		},

		// logoutʧ�ܺ�Ļص�����
		logoutFailCall : function() {
			this.sElement.innerHTML = "";
			this.reportMsg('8');
		},

		// logout�ɹ���ص�����
		logoutSuccessCall : function(aa) {
			// ����������һ��domanselect list
			this.parseLastDomain(this.domainList);
			// ��cookie�ÿ�
			this.cookie = false;
			this.drawLoginForm();
			// ͬʱ�ػ������Ŀ�Ƭ
			for ( var i = 0; i < PassportCardList.length; i++) {
				if (i == this.curCardIndex)
					continue;
				PassportCardList[i].drawLoginForm();
			}
			// �˳��ɹ����ڵ���������Ʒ���ṩ��һ������
			try {
				logoutApp();
			} catch (e) {
			}
		},
		// ��������cookie���ú��������ⲿ��Ʒ�����е���
		renewCookie : function(ele, lfc, lsc) {
			// �ж�ele�Ƿ��Ƕ������͵�
			if (typeof (ele) != "object") {
				return false;
			}
			// �õ���ǰ�������domain
			if (this.domain == "") {
				this.domain = this.getDomain();
			}
			var ra = this.getTime();
			var url = this.loginProtocol
					+ "://passport.sohu.com/sso/renew.jsp?s=" + ra;
			if (this.domain != "sohu.com") {
				url += "&domain=" + this.domain;
			}
			var newScript = document.createElement("script");
			newScript.src = url;
			ele.appendChild(newScript);
			var self = this;
			this.eInterval = setInterval(function() {
				self.renewIntervalProc(lfc, lsc, ele);
			}, 100);
			return false;
		},
		renewIntervalProc : function(lfc, lsc, ele) {
			if (renew_status == ""
					&& this.intervalCount < this.maxIntervalCount) {
				this.intervalCount++;
				return;
			}
			/* ��ʱ�з��ؽ���������Ѿ���ʱ��clear..... */
			clearInterval(this.eInterval);
			this.eInterval = false;

			if (renew_status != "success"
					|| this.intervalCount >= this.maxIntervalCount) {
				try {
					lfc();
				} catch (e) {
				}
				return;
			}
			this.autoProcAllDomain("renew", ele);
			try {
				lsc();
			} catch (e) {
			}
		},
		getRanServ : function() {
			var relen = this.recomServ.length;
			if (relen == 0)
				return "";
			var i = Math.floor(relen * (Math.random()));
			var rtn = '<a href="' + this.recomServ[i]['url']
					+ '" target="_blank">' + this.recomServ[i]['name'] + "</a>";
			if (relen == 1)
				return rtn;
			var j = Math.floor(relen * (Math.random()));
			while (i == j) {
				j = Math.floor(relen * (Math.random()));
			}
			rtn += ' | <a href="' + this.recomServ[j]['url']
					+ '" target="_blank">' + this.recomServ[j]['name'] + "</a>";
			return rtn;
		},
		_drawLoginForm : function() {
		},
		drawLoginForm : function() {
			this._drawLoginForm();
			var inputs = this.cElement.getElementsByTagName("input");
			for ( var i = 0; i < inputs.length; i++) {
				if (inputs[i].name == "email")
					this.emailInput = inputs[i];
				if (inputs[i].name == "password")
					this.passwdInput = inputs[i];
				if (inputs[i].name == "persistentcookie")
					this.pcInput = inputs[i];
			}
			this.loginMsg = document.getElementsByClassName("error")[0];

			if (this.isShowRemPwdMsg == 1) {
				var self = this;
				this.pcInput.onclick = function() {
					if (self.pcInput.checked == false)
						return;
					var confirm = window
							.confirm("��������������ڱ���ͨ��֤�ĵ�¼״̬�����ɻ򹫹����������������á�����ȷ�ϱ��β�����");
					if (confirm == false) {
						self.pcInput.checked = false;
					}
				};
			}

			this.bindSelector(); // ��������������� pi18030 ����
			this.autoFillUserId();
			var self = this;
			if (this.emailInput.value == "") {
				if (this.isSetFocus) {
					setTimeout(function() {
						self.emailInput.focus();
					}, 50);
				}
			} else {
				if (this.isSetFocus && this.emailInput.value != "ͨ��֤�˺�/�ֻ���") {
					setTimeout(function() {
						self.passwdInput.focus();
					}, 50);
				}
			}
		},
		// ���������������cookie
		autoProcAllDomain : function(action, ele) {
			var vurl = this.crossDomainIframeUrl(action);
			if (vurl) {
				var iframe = document.createElement("iframe");
				iframe.src = vurl;
				iframe.style.width = "0";
				iframe.style.height = "0";
				ele.appendChild(iframe);
			}
		},
		// �ú������Զ���ת���ҳ�������ã��Ӷ���ɿ������������cookie
		doCrossDomainCookie : function(ele, action) {
			if (typeof (ele) != "object") {
				return;
			}
			var cookiename = "crossdomain";
			if (action == "logout")
				cookiename = "crossdomain_logout";
			// �ж��Ƿ���Ҫ��������cookie
			var cookie = this.getCookie(cookiename);
			if (cookie == "" || cookie == "0")
				return;
			if (this.domain == "")
				this.domain = this.getDomain();
			var vurl = this.crossDomainIframeUrl(action);
			if (vurl) {
				var iframe = document.createElement("iframe");
				iframe.src = vurl;
				iframe.style.width = "0";
				iframe.style.height = "0";
				iframe.style.display = "none";
				ele.appendChild(iframe);
				this.deleteCookie(cookiename);
			}
		},
		crossDomainUrl : function(action, domain) {
			var curtime = this.getTime();
			var vurl = this.setCookieProtocol
					+ "://passport.sohu.com/sso/crossdomain.jsp?s=" + curtime
					+ "&action=" + action + "&domain=" + domain;
			return vurl;
		},
		crossDomainIframeUrl : function(action) {
			var vurl = this.setCookieProtocol + "://"
					+ this.getPassportDomain()
					+ "/sso/crossdomain_all.jsp?action=" + action;
			return vurl;
		},
		// ���ݵ�ǰ��domain������ȡpassport��Ӧ��domain
		getPassportDomain : function() {
			if (this.domain === "")
				this.domain = this.getDomain();
			var p_domain = "passport." + this.domain;
			if (this.domain in {
				"focus.cn" : "",
				"17173.com" : "",
				"37wanwan.com" : "",
				"51f.com" : ""
			}) {
				p_domain = "pass." + this.domain;
			}
			return p_domain;
		},
		// ����ĳ�����cookie���ú��������ⲿ��Ʒ������
		setDomainCookie : function(ele, domain, lsc, lfc) {
			login_status = "";
			crossdomain_status = "";
			var curl = this.crossDomainUrl("login", domain);
			if (curl) {
				newScript = document.createElement("script");
				newScript.src = curl;
				ele.appendChild(newScript);
			}
			var self = this;
			this.eInterval = setInterval(function() {
				self.setCookieIntervalProc(ele, lsc, lfc);
			}, 100);
		},
		setCookieIntervalProc : function(ele, lsc, lfc) {
			if (crossdomain_status != "") {
				clearInterval(this.eInterval);
				this.eInterval = false;
				lfc();
				return;
			}
			if (login_status == ""
					&& this.intervalCount < this.maxIntervalCount) {
				this.intervalCount++;
				return;
			}

			/* ��ʱ�з��ؽ���������Ѿ���ʱ��clear..... */
			clearInterval(this.eInterval);
			this.eInterval = false;

			if (login_status != "success"
					|| this.intervalCount >= this.maxIntervalCount) {
				lfc();
				return;
			}
			lsc();
		},
		autoFillUserId : function() {
			if (this.showEmailInputTip) {
				this.showEmailInputTip = false;
				return;
			}
			var cuserid = this.getCookie("pptmpuserid");

			if (this.email.length > 0) {
				this.emailInput.value = this.email; // ��¼ʧ�ܺ��Զ����������û���
			} else {
				this.emailInput.value = cuserid;
			}
			if (cuserid.length > 0) {
				// this.deleteCookie("pptmpuserid");
				var self = this;
				setTimeout(function() {
					self.deleteCookie("pptmpuserid");
				}, 1000);
			}
		},

		/* ������һ���ֺ��������� domain select ��ʾ�� */
		downDSindex : function() {
			if (this.dsAnchor.firstChild == null)
				return;
			var x = this.dsAnchor.firstChild.rows;
			for ( var i = 0; i < x.length; i++) {
				if (x[i].firstChild.idx == this.curDSindex)
					break;
			}
			if (i >= x.length - 1) { // û���ҵ����������һ��
				this.curDSindex = x[0].firstChild.idx;
			} else {
				this.curDSindex = x[i + 1].firstChild.idx;
			}
		},
		upDSindex : function() {
			if (this.dsAnchor.firstChild == null)
				return;
			var x = this.dsAnchor.firstChild.rows;
			var last = -1;
			for ( var i = 0; i < x.length; i++) {
				if (x[i].firstChild.idx == this.curDSindex)
					break;
				last = x[i].firstChild.idx;
			}
			if (i == x.length) { // û���ҵ�
				this.curDSindex = x[0].firstChild.idx;
			} else if (last == -1) { // ��һ��
				this.curDSindex = x[x.length - 1].firstChild.idx;
			} else {
				this.curDSindex = last;
			}
		},
		findDSindex : function(index) {
			try {
				var x = this.dsAnchor.firstChild.rows;
				for ( var i = 0; i < x.length; i++) {
					if (x[i].firstChild.idx == index)
						return x[i].firstChild;
				}
			} catch (e) {
			}
			return false;
		},

		clearFocus : function(index) {
			if (typeof (index) != "number")
				index = this.curDSindex;
			try {
				var x = this.findDSindex(index);
				x.className = '';
				x.style.fontWeight = 'normal';
			} catch (e) {
			}
		},
		setFocus : function(index) {
			if (typeof (index) != "number")
				index = this.curDSindex;
			try {
				var x = this.findDSindex(index);
				x.className = 'active';
			} catch (e) {
			}
		},
		// �����ַ���ͬʱ�����������б�
		fillEmailSelect : function() {
			var e = this.emailInput.value;
			var p = /^[\u4e00-\u9fa5,a-zA-Z0-9-_.@]{1,100}$/;
			if (e == "" || !p.test(e)) {
				this.dsElement.style.display = "none";
				// ��������ʧ��ʱ������curDindexΪ-1
				this.curDSindex = -1;
				return;
			}
			var x_postfix = "";
			var x_prefix = "";
			var x_index = e.lastIndexOf("@");
			if (x_index < 0) {
				x_prefix = e;
			} else if (x_index == e.length - 1) { /* ��һ������ @ */
				x_prefix = e.substr(0, x_index);
			} else {
				x_prefix = e.substr(0, x_index);
				x_postfix = e.substr(x_index + 1);
			}
			var mleft = this.getPosition(this.emailInput, "offsetLeft")
					- this.getPosition(this.cElement, "offsetLeft");
			if (document.all && !document.addEventListener) { // ���� IE
				// ������ĺ�ʽģ�� bug
				mleft += 1;
			}
			// this.dsElement.style.marginLeft = mleft + "px";
			// this.dsElement.style.marginTop =
			// (this.getPosition(this.emailInput,"offsetTop") -
			// this.getPosition(this.cElement,"offsetTop") +
			// this.emailInput.offsetHeight) + "px";
			this.dsElement.style.zIndex = "2000";
			this.dsElement.style.paddingRight = "0";
			this.dsElement.style.paddingLeft = "0";
			this.dsElement.style.paddingTop = "0";
			this.dsElement.style.paddingBottom = "0";
			this.dsElement.style.backgroundColor = "white";
			this.dsElement.style.display = "block";

			var myTable = document.createElement("TABLE");
			myTable.width = "100%";
			myTable.style.tableLayout = "fixed";
			myTable.cellSpacing = 0;
			myTable.cellPadding = 3;
			var tbody = document.createElement("TBODY");
			myTable.appendChild(tbody);

			var j = 0;
			var haveCurrent = false;
			var isUserid = false;
			var firstItem = -1;
			var userid_postfix = "", userid_prefix = "";

			var domainList = this.emailPostfix;
			var pattern = /^1\d{0,10}$/;
			var pattern_1 = /^\d*$/;
			if (pattern_1.test(e)) {
				domainList = this.autopad === '' ? [ "qq.com", "focus.cn" ] : [
						"qq.com", "focus.cn", this.autopad ];
			}
			if (pattern.test(e)) {
				domainList = this.autopad === '' ? [ "mobile", "qq.com",
						"focus.cn" ] : [ "mobile", "qq.com", "focus.cn",
						this.autopad ];
			}
			// ��emailPostfix������ȡ��userid��domain��list��useridλ��ǰ3��
			for ( var i = 0; i < domainList.length; i++) {
				var postfix = domainList[i];
				if (typeof (postfix) != 'string' || postfix.length == 0)
					continue;
				if (x_postfix != "" && postfix.lastIndexOf(x_postfix) != 0) {
					continue;
				}
				// ����@�������Ǵ�lastdomain��ȡ����userid
				if (postfix.lastIndexOf("@") >= 0) {
					tmp_pos = postfix.lastIndexOf("@");
					if (this.autopad != ""
							&& this.autopad.lastIndexOf(postfix
									.substring(tmp_pos + 1)) < 0) {
						continue;
					}
					userid_prefix = postfix.substring(0, tmp_pos);
					// Cookie��Userid�в������Ѿ�������ַ�������������
					if (userid_prefix.indexOf(x_prefix) != 0) {
						continue;
					}
					// Cookie��Userid��ǰ׺��ȫ�����Ѿ�������ַ�����Ҫ��־һ�£����˵�������ظ��ļ�¼
					if (userid_prefix == x_prefix) {
						userid_postfix = postfix.substring(postfix
								.lastIndexOf("@") + 1);
					}
					isUserid = true;
				} else {// ���Ǵ�lastdomain��ȡ����
					// ����������autopad�ģ�ֻ��ʾautopad��������������Ĳ�����ʾ
					if (this.autopad != ""
							&& this.autopad.lastIndexOf(postfix) < 0) {
						continue;
					}
				}
				// ���˵��ظ��ĺ�׺
				if (postfix == userid_postfix) {
					continue;
				}
				// ���˵���׺�а������ĵģ���׺����������ģ��϶�������
				// ������Ҫ��split('@')����Ϊ�����postfix�����������ĺ�׺�����ܰ����˴�cookie��ȡ����������ʷ��½�û�������focus.cn�����û����а�������
				var domain_fix = postfix.split('@').slice(-1).toString();
				var _regArr = domain_fix.match(/[^\x00-\xff]/ig);
				if (_regArr != null && _regArr.length != 0) {
					continue;
				}
				j++;
				if (firstItem == -1)
					firstItem = i;
				if (this.curDSindex == i)
					haveCurrent = true;
				var tr = document.createElement("TR");
				var td = document.createElement("TD");
				td.nowrap = "true";
				td.align = "left";
				// �ж�emailPostfix�����Ƿ��Ǵ�cookie�ж�ȡ��userid����ʱ����Ҫ�ڶ�������@...��

				if (postfix == "mobile" || postfix == "uniqname") {// Ϊ��ʾ�ֻ�������ӣ���ʾ�������ֻ��ţ��������@
					td.innerHTML = x_prefix;
				} else {
					if (isUserid == false) {
						if (this.usePostFix) {
							td.innerHTML = x_prefix + "@" + postfix;
						} else {
							td.innerHTML = x_prefix;
						}
					} else {
						if (this.usePostFix) {
							td.innerHTML = postfix;
						} else {
							td.innerHTML = postfix.substring(0, postfix
									.lastIndexOf("@"));
						}
					}
				}
				// ���title�Լ��ı��������ʽ����
				td.title = td.innerHTML;
				td.style.width = "166px";
				td.style.lineHeight = "1.6em";
				td.style.textOverflow = "ellipsis";
				td.style.whiteSpace = "nowrap";
				td.style.overflow = "hidden";

				td.id = "email_postfix_" + i;
				td.idx = i;
				var self = this;
				// mouseover�Լ�click�¼���
				td.onmouseover = function() {
					self.clearFocus();
					self.curDSindex = this.idx;
					self.setFocus();
					this.style.cursor = "pointer";
				};
				td.onclick = function() {
					self.doSelect();
				};
				tr.appendChild(td);
				tbody.appendChild(tr);
				isUserid = false;
			}
			if (j > 0) {
				this.dsAnchor.innerHTML = "";
				this.dsAnchor.appendChild(myTable);
				if (haveCurrent == false)
					this.curDSindex = firstItem;
				this.setFocus();
			} else {
				this.dsElement.style.display = "none";
				this.curDSindex = -1;
			}
		},
		doSelect : function() {
			// if(this.emailInput.value=="") return; jiangyan@2009-12-08 ע�͵�
			// for��
			// ��chrome�£����ʹ��ƴ�����뷨���ں���״̬�£�ȥѡ���������е�Ӣ�ĵ�ʱ��textfieldֵ��Ϊ�գ�ע�͵���仰������������
			var x = this.findDSindex(this.curDSindex);
			if (x) {
				var c = x.innerHTML;
				if (c) {
					this.emailInput.value = c.replace(/&amp;/g, "&");
				}
			}
			if (this.emailInput.value != "")
				this.passwdInput.focus();
			this.dsElement.style.display = "none";
		},
		blurUserid : function() {
			var self = this;
			setTimeout(function() {
				if (self.dsElement && self.dsElement.style.display != "none") {
					self.dsElement.style.display = "none";
				}
				;
			}, 150);
		},
		// �����KeyDown�¼���Ҫ����IE�����¼�ͷ�¼�,IE ������ keydown �¼��������жϲ����� 'Up/Down'
		checkKeyDown : function(event) {
			// var keyCode = event.keyCode;
			event = event || window.event;
			var keyCode = event.keyCode || event.which || event.charCode;
			if (keyCode == 38 || keyCode == 40) {
				if (event.shiftKey == 1) {
					return;
				}
				this.clearFocus();
				if (keyCode == 38) {
					this.upDSindex();
				} else if (keyCode == 40) {
					this.downDSindex();
				}
				this.setFocus();
			}
		},
		// �����KeyPress�¼���Ҫ����FIREFOX�����¼�ͷ�¼���TT��BUG������olns�ĸ��ַ�
		checkKeyPress : function(event) {
			event = event || window.event;
			var keyCode = event.keyCode || event.which || event.charCode;
			// var keyCode = event.keyCode;
			if (keyCode == 13) {
				this.preventEvent(event);
			} else if (keyCode == 38 || keyCode == 40) {// ���¼�ͷ
				if (event.shiftKey == 1) {
					return;
				}
				this.preventEvent(event);
				this.clearFocus();
				if (keyCode == 38) {
					this.upDSindex();
				} else if (keyCode == 40) {
					this.downDSindex();
				}
				this.setFocus();
			} else if (keyCode == 108 || keyCode == 110 || keyCode == 111
					|| keyCode == 115) {// TT��Bug���ĸ��ַ�
				var self = this;
				setTimeout(function() {
					self.fillEmailSelect();
				}, 10);
			}
		},
		// ��Ӧ�û������룬��������б�
		checkKeyUp : function(event) {
			event = event || window.event;
			var keyCode = event.keyCode || event.which || event.charCode;
			// var keyCode = event.keyCode;
			// �����Ƿ���"�س�"�����������email�б�����û������뷨����ģʽ"�س�"������Ӣ�ĵ����
			this.fillEmailSelect();
			if (keyCode == 13) {
				this.doSelect();
			}
			// chrome&saferi ����������¼�ͷ����Ӧ keydown��keypress��ֻ��Ӧkeyup
			// jiangyan@2009-12-08
			if (getBrowserType() == 7 || getBrowserType() == 4) {
				if (keyCode == 38 || keyCode == 40) {
					if (event.shiftKey == 1) {
						return;
					}
					this.clearFocus();
					if (keyCode == 38) {
						this.upDSindex();
					} else if (keyCode == 40) {
						this.downDSindex();
					}
					this.setFocus();
				}
			}
		},
		bindSelector : function() {
			if (this.bindDomainSelector) {
				this.curDSindex = -1;
				if (typeof (this.emailInput) != "undefined") {
					try {
						this.emailInput.addEventListener('keypress',
								this.checkKeyPress.bindFunc(this), false);
						this.emailInput.addEventListener('keyup',
								this.checkKeyUp.bindFunc(this), false);
						// this.emailInput.addEventListener('blur',this.doSelect.bindFunc(this),
						// false);
						this.emailInput.addEventListener('blur',
								this.blurUserid.bindFunc(this), false);
					} catch (e) {
						try {
							this.emailInput.attachEvent("onkeydown",
									this.checkKeyDown.bindFunc(this));
							this.emailInput.attachEvent("onkeypress",
									this.checkKeyPress.bindFunc(this));
							this.emailInput.attachEvent("onkeyup",
									this.checkKeyUp.bindFunc(this));
							// this.emailInput.attachEvent("onblur",
							// this.doSelect.bindFunc(this));
							this.emailInput.attachEvent("onblur",
									this.blurUserid.bindFunc(this));
						} catch (e) {
						}
					}
				}
			}
		},
		/* �ӵ�2����Ƭ��ʼ������������������л��� */
		drawPassportNew : function(element, appid, scf) {
			if (typeof (element) != "object") {
				return;
			}
			var pBaseClass = new Function();
			pBaseClass.prototype = this;
			var cardCount = PassportCardList.length;
			var PassportSN = new pBaseClass();
			/* ���õ�¼�ɹ���Ļص����� */
			PassportSN.successCalledFunc = scf;
			PassportSN.appid = appid;
			PassportSN.curCardIndex = cardCount;
			/* �����Ժ�Ŀ�ƬĬ�ϲ�setFocus */
			PassportSN.isSetFocus = false;
			PassportCardList[cardCount] = PassportSN;
			drawPassportNewInit(cardCount, element);
			return;
		},
		// ������37wanwan������ͨ��js���������Զ���passportCard
		drawPassportJS : function() {
			if (!this.oElement || typeof (this.oElement) != "object") {
				return;
			}
			var cookie_ppinf = this.getCookie('ppinf');
			var sso_url = 'http://sso.passport.sohu.com/mirror/'
					+ this.getPassportDomain() + '/' + cookie_ppinf;
			var newScript = document.createElement("script");
			newScript.src = sso_url;
			ele.appendChild(newScript);
		},
		// ������37wanwan.com����������������iframe����setcookie��clearcookie�Ĳ���
		doCrossDomainIframe : function(iurl) {
			var iframe = document.createElement("iframe");
			iframe.src = iurl;
			iframe.style.width = "0";
			iframe.style.height = "0";
			iframe.id = "ifr_crossdomain";
			PassportSC.oElement.appendChild(iframe);
		},
		sendLog : function(ele, desc, flag) {
			var newScript = document.createElement("script");
			var browerType = getBrowserType();
			newScript.src = '//passport.sohu.com/web/cardlog.jsp?desc='
					+ desc + '&loginProtocol=' + this.loginProtocol
					+ '&userid=' + this.email + '&appid=' + this.appid
					+ '&browserType=' + browerType + '&status=' + login_status
					+ '&count=' + this.intervalCount + '&max='
					+ this.maxIntervalCount + '&flag=' + flag;
			ele.appendChild(newScript);
		}
	};
	// ���ڵ�½���Զ���ת����������������ȫ�ֱ���������Ҫ�Զ��������������cookie�������ֹ�ȥ����
	if (typeof PP_SETCROSSDOMAIN == "undefined") {
		// ��������ת�����ҳ����ֱ���ں�̨������cookie
		var ele = document.getElementsByTagName("head")[0];
		if (typeof PP_SETCOOKIEPROTOCOL != "undefined") {
			PassportSC.setCookieProtocol = PP_SETCOOKIEPROTOCOL;
		}
		PassportSC.doCrossDomainCookie(ele, "login");
		PassportSC.doCrossDomainCookie(ele, "logout");
	}
	// IE�汾��5.5����ʱ������post��ʽ�ύ
	if (typeof encodeURIComponent == "undefined") {
		PassportSC.usePost = 1;
	}
	// �����ֻ��ϵ�opera mini�����
	if (getBrowserType() == 3 && (screen.height == 5000 || window.navigator.userAgent.lastIndexOf("Mini") >= 0)) {
		PassportSC.usePost = 1;
	}
})(window);
