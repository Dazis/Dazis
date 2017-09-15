@extends('layout')
@section('content')
    <div class="content">
        <div class="row">
            <div class="bg-fox icons"><i class="img-fox"></i></div>
            <div class="table-wraper">
                <ul class="nav nav-tabs icons">
                    <li class="active"><a href="/signup"><i class="img-cellphone"></i>手机注册</a></li>
                    <li><span>|</span></li>
                    <li><a href="/signup?signupType=email"><i class="img-email"></i>邮箱注册</a></li>
                </ul>
                <div class="table-box icons">
                    <form id="regForm" action="" class="regForm clearfix" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="control-group hide">
                            <input type="text"><input type="password">
                        </div>
                        <div class="control-group">
                            <label><span class="tit">手机号码</span><span class="ipt">
                    <input type="text" value="" name="mobile" tabindex="1" autocomplete="off" id="mobile"></span></label>
                            <div class="txt-info">注册成功后即可使用手机号码登录</div>

                        </div>
                        <div class="control-group">
                            <label class="passport"><span class="tit">设置密码</span>
                                <span class="ipt">
                                    <input type="password" value="" name="password" tabindex="2" autocomplete="off" id="password">
                                </span>
                            </label>
                            <div class="txt-info dobule-line" title="123456">
                                <p>6-12位，英文（区分大小写）、数字或常用符号</p>
                                <p class="pw-lev"><i></i><i></i><i></i></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="verification"><span class="tit">验证码</span><span class="ipt">
                    <input type="text" value="" name="captcha" tabindex="3" id="cap"></span>
                                <a href="javascript:;" class="btn btn-small" btn-act="captcha">点击获取</a>
                            </label>
                            <div class="txt-info">免费获取手机验证码</div>
                        </div>
                        <div class="control-group mg-top">
                            <div class="pd-left"><span>
                    <label><input type="checkbox" name="agree" tabindex="4" id="agree">同意</label><a href="/signup/show_agreement" target="_blank">《搜狐服务协议》</a></span>
                                <div class=""></div>
                            </div>
                        </div>
                        <div class="control-group mg-top">
                            <div class="pd-left btn-group"><span>
                    <input type="button" value="立即注册" class="btn btn-xlarge btn-yellow" id="register" tabindex="5"></span>
                                <div class="txt-info"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        Moblie = false;
        Pwd     = false;
        PwdRight = false;
        //图像验证码是否已经验证过
        beginCode = false;
        //60s倒计时
        Seconds = false;
        //短信验证码
        Captcha  =  false;
        //获取短信验证码 是否成功
        Callcode = false;
        //短信验证码  是否成功
        CapMsg = false;
        //验证手机号
        function checkMoblie(moblie){
            var preg = /^1[34578]\d{9}$/;
            if (preg.test(moblie)) {
                Moblie = true;
                return true
            } else {

                return false;
            }
        }
        //验证密码
        function checkPwd(pwd){
            // 6-12位字符
            var preg = /^\w{6,12}$/;
            if (preg.test(pwd)) {
                return true;
            }else{
                return false;
            }
        }
        //只能是数字
        function pwdMath(pwd){
            var preg = /^[0-9]{6,12}$/;
            if (preg.test(pwd)) {
                return true;
            } else {
                return false;
            }
        }
        //顺序数字 1234567890
        function pwdSun(pwd){
            var preg = /^[1234567890]{6,10}$/;
            if(preg.test(pwd)){
                return true;
            }
        }
        //只能是小写字母
        function pwdSmall(pwd){
            var preg = /(?!^[A-Z]+$)[a-zA-Z]{6,12}/;
            if (preg.test(pwd)) {
                return true;
            } else {
                return false;
            }
        }
        //只能是大写字母
        function pwdBig(pwd){
            var preg = /(?!^[a-z]+$)[a-zA-Z]{6,12}/;
            if (preg.test(pwd)) {
                return true;
            } else {
                return false;
            }
        }
        // jquery 正则 只能是 数字和字母
        function pwdME(pwd){
            var preg = /(?!^\d+$)(?!^[a-zA-Z]+$)[0-9a-zA-Z]{6,12}/;
            if (preg.test(pwd)) {
                return true;
            } else {
                return false;
            }
        }
        // 匹配任意字符  /[\w\W]+/ 匹配任何字符
        function pwdAll(pwd){
            var preg = /^\w{6,12}$/;
            if (preg.test(pwd)) {
                return true;
            } else {
                return false;
            }

        }
        //图形验证码 只能是数字和字母 或 字母
        function checkCode(code){
            var preg1 = /^[a-z]{5}$/;
            var preg2 = /(?!^\d+$)(?!^[a-z]+$)[0-9a-z]{5}/;
            var preg3 = /^[0-9]{5}$/;
            if(preg1.test(code) || preg2.test(code) || preg3.test(code)){
                return true;
            } else {
                return false;
            }
        }
        //60s倒计时
        var countdown=60;
        function settime(obj) {
            if (countdown == 0) {
//                obj.removeAttribute('disabled');
                obj.removeClass("disabled");
                obj.html("点击获取");
                obj.parent().next().html('免费获取手机验证码');
                countdown = 60;
                return;
            } else {
//                obj.setAttribute('disabled',true);
                obj.addClass("disabled");
                obj.html(countdown+'s');
                obj.parent().next().html('60秒后可重新发送验证码');
                countdown--;
            }
            setTimeout(function() {
                        settime(obj) }
                    ,1000)
        }
        //手机短信验证码  四位数字
        function checkCap(cap){
           var preg = /^[0-9]{4}$/;
            if(preg.test(cap)){
                return true
            }else{
                return false;
            }
        }
        $(function(){
            //验证手机号格式和唯一性
            $("#mobile").focus(function(){
                var obj = $(this);
                //给当前对象的父级span 加class属性active  (文本框渐变为黄色)
                obj.parent().addClass('active');
                //去除对象class为 txt-info 的其中一个class属性 txt-alert
                obj.parent().parent().next().removeClass('txt-alert').html('注册成功后即可使用手机号码登录');
            });
            $("#mobile").blur(function(){

                var obj = $(this);
                obj.parent().removeClass('active');

                var moblie = obj.val();
                if(checkMoblie(moblie)){
                    $.ajax({
                        type:'post',
                        url:'register/checkMoblie',
                        data:{phone:moblie},
                        success:function(data){
                            var callback = JSON.parse(data);
                            if (callback.error == '10001') {
                                obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>该手机号码已被绑定过，可使用该号码<a href="{{url('login/tologin')}}" class="txt-sky" data-log="logType=1">直接登录</a>');
                                Moblie = false;
                            } else if(callback.error == '10002') {
                                obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>手机号码格式不正确');
                                Moblie = false;
                            } else {
                                obj.parent().parent().next().addClass('txt-alert').html('<i class="img-sucess"></i>');
                                Moblie = true;
                            }
                        }
                    });
                }else{
                    obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>手机号码格式不正确');
                    Moblie = false;
                }
            });


            //验证密码格式
            $('#password').on('input propertychange',function(){
                var obj = $(this);
                var pwd = obj.val();

                var i = obj.parent().parent().next().children('p').eq(1).children('i');
                if(!checkPwd(pwd)){
                    i.removeClass('active');
                }else{
                    //判断是否全是数字
                    if(pwdMath(pwd)){

                    //判断是否是顺序数字
                        if(pwdSun(pwd)){

                            i.removeClass('active');return;
                        }
                        PwdRight = true;
                        i.eq(0).addClass('active');return;
                    }


                    //判断是否全为小写字母
                    if(pwdSmall(pwd)){
                        PwdRight = true;
                        i.eq(0).addClass('active');return;
                    }


                    //判断是否全为大写字母
                    if(pwdBig(pwd)){
                        PwdRight = true;
                        i.eq(0).addClass('active');return;
                    }


                    //判断是否是数字和字母的混搭
                    if(pwdME(pwd)){

                        //是否是 数字 字母 和 符号的 混搭
                        if(pwdAll(pwd) && !pwdME(pwd)){
                            i.addClass('active');
                            PwdRight = true;
                        }else{
                            i.eq(0).addClass('active');
                            i.eq(1).addClass('active');
                            PwdRight = true;
                            return;
//                        $(".pw-lev li:lt(2)").addClass('active');
                        }

                    }

                }
            });

            $("#password").focus(function(){
                var obj = $(this);
                //给当前对象的父级span 加class属性active  (文本框渐变为黄色)
                obj.parent().addClass('active');
                //去除对象class为 txt-info dobule-line的其中一个class属性 txt-alert

                var div = obj.parent().parent().next();
                div.removeClass('txt-alert');
                div.children('p').eq(0).html('6-12位，英文（区分大小写）、数字或常用符号');
            });
            $("#password").blur(function(){
                var obj = $(this);
                var pwd = obj.val();
                obj.parent().removeClass('active');
                //      div class="txt-info dobule-line"
                var div = obj.parent().parent().next();
                div.children('p').eq(0).html('6-12位，英文（区分大小写）、数字或常用符号');

                if(pwdSun(pwd)){
                    div.addClass('txt-alert');
                    div.children('p').eq(0).html('<i class="img-error"></i>密码强度太弱，请重新设置');return;
                }
                if(PwdRight){
                    if (pwd == '') {
                        div.children('p').eq(0).html('6-12位，英文（区分大小写）、数字或常用符号');return;
                    }
                    div.children('p').eq(0).html('<i class="img-sucess"></i>');
                    Pwd = true;
                } else {
                    if (pwd == '') {
                        div.children('p').eq(0).html('6-12位，英文（区分大小写）、数字或常用符号');return;
                    }
                    div.addClass('txt-alert');
                    div.children('p').eq(0).html('<i class="img-error"></i>6-16位，英文（区分大小写）、数字或常用符号');
                }

            });

            //展示图形验证码遮罩层
            $('.btn-small').click(function() {
                var obj = $(this);
                if(Moblie) {
                    if(beginCode == false) {  //如果图形验证码没验证 先验证图形验证码
                        $('.confirm-boxs').removeClass('hide');
                        $('.modal-backdrops').removeClass('hide');
                    } else {   // 图形验证码验证成功后   验证手机短信验证码
//                        var timestamp = (Date.parse(new Date())/1000);
//                        var times = (timestamp+1000);
//                        alert(timestamp);return;
                        settime(obj);
                        if(countdown>0){
                            var phone = $('#mobile').val();

                            $.ajax({
                                type:"post",
                                url:"img/msgCode",
                                data:{
                                    phone:phone
                                },success:function(data){
//                                    alert(data);return;
                                    var da = JSON.parse(data);
                                    if(da.success == 1){
                                        Callcode = true;
                                    }
                                }
                            });
                        }
                    }
                } else {
                    var moblie = $('#mobile');
                    moblie.parent().parent().next().html('<i class="img-exclamation"></i>请您输入手机号码');
                }
            });
            //验证手机验证码
            $('#cap').focus(function(){
                var obj = $(this);
                if( CapMsg == true){
                    obj.parent().parent().next().html('60秒后可重新发送验证码').removeClass('active');return;
                }
                obj.parent().parent().next().html('免费获取手机验证码').removeClass('active');
            });
            $("#cap").blur(function(){
                var obj = $(this);
                if(Callcode == true){
                    var cap = $('#cap').val();
                    $.ajax({
                        type:"post",
                        url:"img/checkCap",
                        data:{
                            cap:cap
                        },success:function(callCap){
                            if(callCap == 1){
                                CapMsg = true;
                            }else{
                                obj.parent().parent().next().html('验证码输入错误').addClass('active');
                            }
                        }
                    });
                }
            });
            //清空文本框里的内容
            $('#ipt').focus(function() {

                $('.alert-block').html('');
            });

            $('.btn-group').click(function() {

                var code = $("#ipt").val();
                //判断文本框内填写的内容  数字 字母   或 数字+字母 5位
                if(!checkCode(code) || code.length!=5) {

                    $('.alert-block').html('请输入正确的图片验证码');
                } else {

                    $.ajax({
                        type:"post",
                        url:"img/checkCode",
                        data:{
                            code:code
                        },success:function(data) {
                            var da = JSON.parse(data);
                            if(da.error == 10003) {
                                $('.alert-block').html('请输入正确的图片验证码');
                            } else {
                                $('.alert-block').html('');
                                $('.confirm-boxs').addClass('hide');
                                $('.modal-backdrops').addClass('hide');
                                beginCode = true;
                            }
                        }
                    });
                }
            });

            //提交信息
            $(document).on('click','#register',function(){
                var fuxuan = $('#agree').is(':checked');
                if(fuxuan == false){
                    $('#register').parent().next().html('<i class="img-error"></i>');
                }else{
                    $('#register').parent().next().html('<i class="img-sucess"></i>');
                }
                if(Moblie && Pwd && CapMsg && fuxuan){

                    var phone = $("#mobile").val();
                    var pwd = $("#password").val();
                    $.ajax({
                        type:"post",
                        url:"register/zhuce",
                        data:{
                            phone:phone,
                            password:pwd
                        },success:function(data){
                            if(data==1){
                                location.href = "{{url('index/show')}}";
                            }
                        }

                    });
                }else {

                    $(":input").trigger("blur");
                }
            });
        });
    </script>
@stop

