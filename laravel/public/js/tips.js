var returnCode = {
	GOON:'100', //正常，可以继续
	OK:'200', //成功
	NOT_FOUND:'404', //没有查询到信息
	NOT_ALLOW:'405', //此操作被限制
	WRONG_PARAMS:'450', //输入参数错误
	ACCOUNT_EXIST:'451', //账号已存在
	ACCOUNT_NOT_ALLOW:'452', //账号不符合规范
	ACCOUNT_LOCKED:'453', //输入的账号被锁定
	ACCOUNT_INACTIVE:'454', //账号未激活，暂时不能使用
	NICK_EXIST:'455', //昵称已存在
	NICK_NOT_ALLOW:'456', //昵称不合规范
	NICK_NO_CHANGE:'457', //此用户不能修改昵称
	CAPTCHA_WRONG:'458', //验证码错误
	PSW_WRONG:'459', //密码错误
	PSW_NOT_ALLOW:'460', //密码不合规范
	MOBILE_WRONG:'461', //手机号错误
	MOBILE_HAVE_BIND:'462', //用户已经绑定了手机号
	MOBILE_OTHER_BIND:'463', //手机号已经被其他账号绑定
	MOBILE_CANT_UNBIND:'464', //手机注册的账号不能解绑
	SIG_WRONG:'465', //接口的签名错误
	ID_WRONG:'466', //输入的身份校验信息错误
	DPSW_WRONG:'467', //动态口令错误
	CAPTCHA_NEED:'468', //此操作需要提供验证码
	HUDUN_NEED:'469', //此操作需要狐盾动态口令
	OLD_EMAIL_WRONG : '470', //旧绑定邮箱错误
	OLD_ANSWER_WRONG : '471', //旧密保问题答案错误
	IP_LOCKED: '472', //IP被锁定
	EMAIL_WRONG:'420',
	SERIAL_NUM_WRONG : '474', //序列号错误
	HUDUN_NOT_BIND : '476',
	USER_LOGIN_FORBIDDEN : '477', //用户禁止登录
	BIND_EMAIL_WRONG : '478', //绑定邮箱错误
	BIND_EMAIL_SELF : '479',  //不能绑定自己
	MOBILE_EXIST: '480',	//该手机号已被注册
	INTERNAL_ERROR:'500' //内部服务器错误		
};