!function t(n,e,i){function o(s,r){if(!e[s]){if(!n[s]){var c="function"==typeof require&&require;if(!r&&c)return c(s,!0);if(a)return a(s,!0);throw new Error("Cannot find module '"+s+"'")}var u=e[s]={exports:{}};n[s][0].call(u.exports,function(t){var e=n[s][1][t];return o(e?e:t)},u,u.exports,t,n,e,i)}return e[s].exports}for(var a="function"==typeof require&&require,s=0;s<i.length;s++)o(i[s]);return o}({1:[function(t,n,e){var i=jQuery;n.exports.init=function(){i(function(){i("body").append('<a href="/help" class="btn-question" target="_blank"><i>?</i>遇到问题</a>'),i("a.btn-question").css("margin-left",parseInt(i(".content > .row").width()/2))})}},{}],2:[function(t,n,e){var i=jQuery;n.exports.init=function(){function t(){var t=i(".backtotop");parseInt(i(window).scrollTop())<200?t.hide():t.fadeIn().click(function(t){t.preventDefault(),i("html,body").stop(!0).animate({scrollTop:0},200)})}i(function(){i("body").append('<a class="backtotop" href="javascript:;"><i class="img-backtotop"></i></a>'),t()}),i(window).scroll(function(){t()})}},{}],3:[function(t,n,e){function i(t){this.options=o.extend({url:"",method:"post",callback:null,time:0},t||{}),this._isOK=!0,this._sending=!1}var o=jQuery;i.prototype={request:function(t){var n=this;this._isOK=!1,this._sending=!0,o.ajax({url:this.options.url,type:this.options.method,dataType:"json",data:t||{}}).done(function(e){n._sending=!1,0===e.code&&(n._isOK=!0),o.isFunction(n.options.callback)&&n.options.callback(e,t)})},isOK:function(){return this._sending||this._isOK},reset:function(){this._isOK=!0,this._sending=!1}},i.prototype.constructor=i,n.exports=i},{}],4:[function(t,n,e){var i=(jQuery,t("./answerquestion")),o=t("./backtotop");n.exports={answerquestion:i.init,backtotop:o.init}},{"./answerquestion":1,"./backtotop":2}],5:[function(t,n,e){function i(t,n){var e={};if(o(t)&&t.length>0)for(var i,a,s,c=n?u:r,l=t.split(/;\s/g),d=0,p=l.length;p>d;d++){if(s=l[d].match(/([^=]+)=/i),s instanceof Array)try{i=u(s[1]),a=c(l[d].substring(s[1].length+1))}catch(f){}else i=u(l[d]),a="";i&&(e[i]=a)}return e}function o(t){return"string"==typeof t}function a(t){return o(t)&&""!==t}function s(t){if(!a(t))throw new TypeError("Cookie name must be a non-empty string")}function r(t){return t}var c={},u=decodeURIComponent,l=encodeURIComponent;c.get=function(t,n){s(t),n="function"==typeof n?{converter:n}:n||{};var e=i(document.cookie,!n.raw);return(n.converter||r)(e[t])},c.set=function(t,n,e){s(t),e=e||{};var i=e.expires,o=e.domain,r=e.path;e.raw||(n=l(String(n)));var c=t+"="+n,u=i;return"number"==typeof u&&(u=new Date,u.setDate(u.getDate()+i)),u instanceof Date&&(c+="; expires="+u.toUTCString()),a(o)&&(c+="; domain="+o),a(r)&&(c+="; path="+r),e.secure&&(c+="; secure"),document.cookie=c,c},c.remove=function(t,n){return n=n||{},n.expires=new Date(0),this.set(t,"",n)},n.exports=c},{}],6:[function(t,n,e){function i(t){function n(){var n=o.trim(d.val());n?o.isFunction(t.onConfirm)&&t.onConfirm(n):a("请输入验证码")}function e(){u&&(u.addClass("hide"),l.addClass("hide"))}function i(){var t="/apiv2/picture_captcha?userid="+s+"&time="+Math.random();u.find("a.auth").html('<img src="'+t+'">')}function a(t){u.find(".alert-block").html(t)}t=o.extend({},t||{});var s,r=['<div class="modal confirm-box hide">','  <div class="modal-title"><a href="javascript:;" class="btn-close">&times;</a></div>','  <div class="modal-content tabs-box">','    <div class="control-group code"><span class="pull-right"><a href="javascript:;" class="auth"></a></span>','      <label><span class="ipt">','          <input type="text" placeholder="请输入验证码"></span></label>',"    </div>",'    <div class="alert-block txt-alert"></div>','    <div class="btn-group">','      <input type="button" value="确认" class="btn btn-xlarge btn-yellow">',"    </div>","  </div>","</div>",'<div class="modal-backdrop hide"></div>'].join(""),c=o(r).appendTo("body"),u=c.filter("div.modal"),l=c.filter("div.modal-backdrop"),d=u.find("input:text");return u.on("click",".btn-close",function(t){t.preventDefault(),e()}).on("click","input:button",function(t){t.preventDefault(),n()}).on("focus","input:text",function(t){a("")}).on("keyup","input:text",function(t){13===t.keyCode&&n()}).on("click","img",function(){i()}),{hide:e,refresh:i,error:a,show:function(t){s=t,u.removeClass("hide"),l.removeClass("hide"),d.val(""),a(""),i()}}}var o=jQuery;n.exports=i},{}],7:[function(t,n,e){function i(t,n,e,i){var o=t.attr("name"),s=t.closest(".control-group").find(".txt-info");switch(s.removeClass("txt-alert"),e){case a.NONE:break;case a.OK:n='<i class="img-sucess"></i>'+n;break;case a.ERROR:s.addClass("txt-alert"),n='<i class="img-error"></i>'+n;break;case a.WARNING:n='<i class="img-exclamation"></i>'+n}i?s.addClass("dobule-line"):s.removeClass("dobule-line"),"password"===o&&(s=s.find("p").eq(0)),s.html(n)}var o=(jQuery,t("./validate")),a=o.type;n.exports=i},{"./validate":13}],8:[function(t,n,e){var i=jQuery,o=function(t,n){this.input=t,this.opts=i.extend({},n||{})};o.prototype={init:function(){this.build(),this.bindEvent()},build:function(){},bindEvent:function(){}};var a=function(t,n){o.call(this,t,n),this.init(),this.setState(this.input.attr("type"))},s=a.prototype=new o;s.constructor=a,s.build=function(){var t='<a href="javascript:;" class="shortcut" tabindex="-1"><i class="img-eyes"></i></a>';this.btn=i(t).insertBefore(this.input)},s.bindEvent=function(){this.btn.on("click",i.proxy(this.toogleType,this))},s.toogleType=function(){var t=this.input.attr("type");"text"===t?t="password":"password"===t&&(t="text"),this.input.attr("type",t),this.setState(t)},s.setState=function(t){"text"===t?this.btn.addClass("active"):"password"===t&&this.btn.removeClass("active")},e.PasswordSwitch=a},{}],9:[function(t,n,e){var i=jQuery;n.exports.init=function(){function t(t){var n="/lapi/log?"+t+"&_="+(new Date).getTime(),e=document.createElement("script");e.src=n,document.body.appendChild(e)}i(document).on("click","[data-log]",function(n){var e=i(this),o=e.data("log");t(o)})}},{}],10:[function(t,n,e){function i(t){if("string"!=typeof t||t.length<6)return 0;var n=t.length<=7?10:20,e=/.*[a-zA-Z].*/.test(t)?/.*[a-z].*/.test(t)&&/.*[A-Z].*/.test(t)?20:10:0,i=/.*[0-9].*/.test(t)?t.match(/[0-9]/g).length>=3?15:5:0,o=/.*[^a-zA-Z0-9].*/.test(t)?t.match(/[^a-zA-Z0-9]/g).length>1?25:20:0,a=n+e+i+o;return a+=20===e&&i&&o?20:e&&i&&o?15:e&&i?5:0}function o(t,n){return n.indexOf(t)>-1}function a(t){for(var n=0,e=r.length;e>n;n++)if(t===r[n])return!0}function s(t){return c.test(t)}var r=["000000","111111","11111111","112233","123123","123321","123456","1234567","12345678","123456789","1234567890","654321","666666","888888","abcdef","abcabc","abc123","a1b2c3","aaa111","123qwe","qwe123","qwerty","qweasd","admin","password","p@ssword","passwd","iloveyou","5201314","password1","monkey","letmein","trustno1","dragon","baseball","master","sunshine","shadow","superman","qazwsx","football","adobe123","admin123"],c=/^[A-Za-z0-9_<>\"\'\~\`\!\@\#\$\%\^\&\*\(\)\+\|\{\}\[\]\/\,\.\=\-\:\;\?\\]{6,16}$/;e.isSame=o,e.isWeak=a,e.isValid=s,e.strength=function(t,n){var e=i(t);return!s(t)||o(t,n)||a(t)?0:40>e?1:e>60?3:2}},{}],11:[function(t,n,e){function i(t){this.options=o.extend({url:"",method:"post",onstart:null,onresponse:null,onprogress:null,onend:null,time:60},t||{}),this.sid=null,this.isCounting=!1}var o=jQuery;i.prototype={request:function(t){if(!this.isCounting){var n=this;this.start(this.options.time),""!==this.options.url&&o.ajax({url:this.options.url,type:this.options.method,dataType:"json",data:t||{}}).done(function(t){0!==t.code?n.end(t):n.response(t)})}},countdown:function(){var t,n=this,e=this.options.time,i=+new Date+1e3*e;this.sid=setInterval(function(){t=+new Date,e=Math.floor((i-t)/1e3),0>=e?n.end():n.progress(e)},500)},start:function(t){this.isCounting=!0,o.isFunction(this.options.onstart)&&this.options.onstart(t),this.countdown()},progress:function(t){o.isFunction(this.options.onprogress)&&this.options.onprogress(t)},end:function(t){this.isCounting=!1,this.sid&&clearInterval(this.sid),o.isFunction(this.options.onend)&&this.options.onend(t)},response:function(t){o.isFunction(this.options.onresponse)&&this.options.onresponse(t)}},i.prototype.constructor=i,n.exports=i},{}],12:[function(t,n,e){var i=jQuery,o=t("./cookie"),a=t("./checkbyrequest"),s=t("./requestwithdelay"),r=t("./inputextend"),c=t("./password"),u=t("./validate"),l=t("./errormessage"),d=t("./dialog-captcha"),p=u.type,f=u.message;n.exports.init=function(){function t(){var t=o.get("ru");return t||(t="//passport.sohu.com"),t.replace(/"/g,"")}function n(){l(h,'该手机号码已被绑定过，可使用该号码<a href="'+t()+'" class="txt-sky" data-log="logType=1">直接登录</a>',p.ERROR)}var e=i("#regForm"),m=e.find('[name="password"]'),h=e.find('[name="mobile"]'),v=e.find('[name="captcha"]'),b=e.find('[name="agree"]'),g=e.find('[btn-act="captcha"]'),y=e.find(":submit"),w=e.find(".pw-lev"),R=e.attr("action"),N="reg",O=!1;new r.PasswordSwitch(m);var x=new a({url:"/signup/check_mobile",callback:function(t){0===t.code?l(h,"",p.OK):7===t.code?n():l(h,t.msg,p.ERROR)}}),k=d({onConfirm:function(t){E.request({mobile:i.trim(h.val()),captchaType:1,pictureCaptcha:t})}}),E=new s({url:"/signup/send_mobile_captcha",time:60,onstart:function(t){g.addClass("disabled").html(t+"s"),h.prop("disabled",!0).parent().addClass("disabled"),l(v,f.captcha.countdown,p.NONE)},onprogress:function(t){g.html(t+"s")},onend:function(t){g.removeClass("disabled").html("点击获取"),h.prop("disabled",!1).parent().removeClass("disabled"),t&&0!==t.code?2===t.code?(k.error(t.msg),k.refresh()):7===t.code?(n(),l(v,f.captcha.hint,p.NONE),k.hide()):16===t.code?(l(h,t.msg,p.ERROR),l(v,f.captcha.hint,p.NONE),k.hide()):(l(v,t.msg,p.ERROR),k.hide()):l(v,f.captcha.hint,p.NONE)},onresponse:function(t){0===t.code&&k.hide()}});h.on("focus",function(){l(h,f.mobile.regHint,p.NONE)}).on("blur",function(){var t=i.trim(h.val()),n=u.mobile(t,N);n.valid?x.request({mobile:t}):l(h,n.msg,n.type)}),m.on("focus",function(){l(m,f.password.hint,p.NONE,!0)}).on("blur",function(){var t=i.trim(m.val()),n=i.trim(h.val()),e=u.password(t,n);l(m,e.msg,e.type,!0)}).on("keyup",function(){var t=i.trim(m.val()),n=i.trim(h.val()),e=c.strength(t,n);w.find("i").removeClass("active").slice(0,e).addClass("active")}),v.on("focus",function(){l(v,E.isCounting?f.captcha.countdown:f.captcha.hint,p.NONE)}),g.on("click",function(t){if(t.preventDefault(),!g.hasClass("disabled")){var n=i.trim(h.val()),e=u.mobile(n,N,!0);e.valid&&x.isOK()?k.show(n):e.valid||l(h,e.msg,e.type)}}),b.on("click",function(){this.checked&&l(b,"",p.NONE)}),e.on("focus",":text,:password",function(){i(this).parent().addClass("active")}).on("blur",":text,:password",function(){i(this).parent().removeClass("active")}).submit(function(){if(O)return!1;l(y,"",p.NONE);var t=i.trim(m.val()),o=i.trim(h.val()),a=i.trim(v.val()),s=u.mobile(o,N,!0);if(!s.valid)return l(h,s.msg,s.type),!1;if(!x.isOK())return!1;var r=u.password(t,o,!0);if(!r.valid)return l(m,r.msg,r.type,!0),!1;var c=u.captcha(a);if(!c.valid)return l(v,c.msg,c.type),!1;if(!b.prop("checked"))return l(b,"请接受服务条款",p.WARNING),!1;var d={password:t,mobile:o,captcha:a};return O=!0,i.ajax({type:"POST",url:R,data:d,dataType:"json",timeout:1e4}).done(function(t){if(0===t.code)t.data.url&&(location.href=t.data.url);else if(1===t.code){var o=t.data&&t.data.err;if(i.isArray(o)&&o.length>0)for(var a=0;a<o.length;a++){var s,r=o[a];"password"===r.name&&(s=!0),l(e.find('[name="'+r.name+'"]'),r.msg,p.ERROR,s)}}else 7===t.code?n():l(y,t.msg,p.ERROR)}).fail(function(){l(y,"服务器繁忙，请稍后重试",p.ERROR)}).always(function(){O=!1}),!1})}},{"./checkbyrequest":3,"./cookie":5,"./dialog-captcha":6,"./errormessage":7,"./inputextend":8,"./password":10,"./requestwithdelay":11,"./validate":13}],13:[function(t,n,e){function i(t){return d.username.test(t)}function o(t){var n=d.email;return n.test(t)}function a(t){return""===t}function s(t){return d.mobile.test(t)}function r(t){return d.captcha.test(t)}function c(t,n,e){return{valid:t,msg:n||"",type:e||""}}function u(t){var n=d.realname;return n.test(t)}var l=t("./password"),d={username:/^[a-z][a-zA-Z0-9_]{3,15}$/,email:/^[a-zA-Z0-9][a-zA-Z0-9._-]{0,}@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/,emailAtFocus:/^[a-zA-Z0-9\u4e00-\u9fff][a-zA-Z0-9\u4e00-\u9fff._-]{0,}@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/,mobile:/^1[0-9]{10}$/,captcha:/^\d+$/,realname:/^[\u4e00-\u9fa5\.a-zA-Z· ]{2,18}$/},p={NONE:"none",OK:"ok",ERROR:"error",WARNING:"warning"},f={username:{hint:'<p>注册搜狐邮箱，可直接登录其他搜狐旗下产品</p><a href="#" btn-act="oe">我有其他邮箱</a>',invalid:"4-16位，英文、数字、下划线，小写字母开头",empty:"请填写邮箱地址"},email:{hint:"请输入常用邮箱账号",invalid:"邮箱格式不正确",empty:"请输入常用邮箱账号"},password:{hint:"6-16位，英文（区分大小写）、数字或常用符号",invalid:"6-16位，英文（区分大小写）、数字或常用符号",same:"密码和账号相似度过高，请重新设置",weak:"密码强度太弱，请重新设置",empty:"请您输入密码"},mobile:{regHint:"注册成功后即可使用手机号码登录",bindHint:"绑定手机号码可增强账户安全性",invalid:"手机号码格式不正确",empty:"请您输入手机号码"},captcha:{hint:"免费获取手机验证码",countdown:"60秒后可重新发送验证码",invalid:"验证码不正确，请重新输入",empty:"请输入验证码"},realname:{hint:"请输入真实姓名",invalid:"真实姓名格式不正确",empty:"请输入真实姓名"}};n.exports={type:p,message:f,username:function(t,n){return a(t)?n?c(!1,f.username.empty,p.WARNING):c(!1,f.username.hint,p.NONE):i(t)?c(!0,"",p.OK):c(!1,f.username.invalid,p.ERROR)},email:function(t,n){return a(t)?n?c(!1,f.email.empty,p.WARNING):c(!1,f.email.hint,p.NONE):o(t)?c(!0,"",p.OK):c(!1,f.email.invalid,p.ERROR)},mobile:function(t,n,e){return a(t)?e?c(!1,f.mobile.empty,p.WARNING):c(!1,"reg"===n?f.mobile.regHint:f.mobile.bindHint,p.NONE):s(t)?c(!0,"",p.OK):c(!1,f.mobile.invalid,p.ERROR)},captcha:function(t){return a(t)?c(!1,f.captcha.empty,p.WARNING):r(t)?c(!0,"",p.NONE):c(!1,f.captcha.invalid,p.ERROR)},password:function(t,n,e){return a(t)?e?c(!1,f.password.empty,p.WARNING):c(!1,f.password.hint,p.NONE):l.isValid(t)?l.isSame(t,n)?c(!1,f.password.same,p.ERROR):l.isWeak(t)?c(!1,f.password.weak,p.ERROR):c(!0,"",p.OK):c(!1,f.password.invalid,p.ERROR)},realname:function(t,n){return a(t)?n?c(!1,f.realname.empty,p.WARNING):c(!1,f.realname.hint,p.NONE):u(t)?c(!0,"",p.OK):c(!1,f.realname.invalid,p.ERROR)}}},{"./password":10}],14:[function(t,n,e){var i=jQuery,o=t("../module/signupbycellphone"),a=t("../module/log"),s=t("../module/commonplugs");i(function(){o.init(),a.init(),s.answerquestion()})},{"../module/commonplugs":4,"../module/log":9,"../module/signupbycellphone":12}]},{},[14]);