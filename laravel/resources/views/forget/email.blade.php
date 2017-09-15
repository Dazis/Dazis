@extends('forget')
@section('content')
    <div class="content">
        <div id="password-body" class="row">
            <div class="bg-fox icons"><i class="img-fox"></i></div>
            <section class="agreement">
                <div class="step-box">
                    <ul>
                        <li class="step-two">
                            <div class="step-num">1</div><span class="step-word step1">输入账号</span>
                        </li>
                        <li class="step-two">
                            <div class="step-num">2</div><span class="step-word step2">选择重置方式</span>
                        </li>
                        <li class="step-on">
                            <div class="step-num">3</div><span class="step-word step3">重置密码</span>
                        </li>
                    </ul>
                </div>
                <div class="table-wraper table-wraper-wang">
                    <p class="choose-way choose-way-diff">您正在使用邮箱找回密码方式，请完成以下操作：</p>
                    <div class="table-box icons">
                        <form id="Form" action="{{url('forget/upd')}}" class="regForm clearfix" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="control-group hide">
                                <input type="password">
                            </div>


                            <div class="control-group">
                                <input type="hidden" value="{{$email}}" id="email" name="email">
                                <label><span class="tit tit-wang">邮箱号码</span><span class="phone-num">{{$mail}}</span></label>
                                <div class="txt-info"><i class="img-error hide"></i></div>
                            </div>


                            <div class="control-group">

                                <label class="verification">
                                    <span class="tit tit-wang">验证码</span>
                                    <span class="ipt ipt-wang">
                                        <input name="yanzheng" id="yanzhang" >
                                    </span>
                                    <a href="{{url('forget/email')}}" class="btn btn-small" id="click">点击获取</a>
                                </label>
                                <div class="txt-info"><i class="img-error hide"></i>获取邮箱验证码</div>
                            </div>


                            <div class="control-group">
                                <label class="passport">
                                    <span class="tit tit-wang">新密码</span>
                                    <span class="ipt ipt-wang">
                                        <a href="javascript:;" class="shortcut"><i class="img-eyes"></i></a>
                                        <a href="javascript:;" class="shortcut" tabindex="-1"><i class="img-eyes"></i></a>
                                        <input name="password" autocomplete="off" type="password" id="password">
                                    </span>
                                </label>
                                <div class="txt-info dobule-line">
                                    <p><i class="img-error hide"></i>6-16位，英文（区分大小写）、数字或常用符号</p>
                                    <p class="pw-lev"><i></i><i></i><i></i></p>
                                </div>
                                <div class="txt-info hide"><i class="img-sucess"></i></div>
                            </div>


                            <div class="control-group mg-top">
                                <div id="pd-left-wang" class="pd-left btn-group">
                                    <span>
                                        <input id="save-wan" value="保存" class="btn btn-xlarge btn-yellow" tabindex="1" type="button">
                                    </span>
                                    <div id="txt-info-wang" class="txt-info txt-alert"></div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script type="text/javascript">
        MsgCode = false;
        Pwd = false;
        PwdRight = false;
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



        $(function(){
            //验证码
            $('#yanzhang').focus(function(){
                var obj = $(this);

                obj.parent().parent().next().html('<i class="img-error hide"></i>获取邮箱验证码');
            });
            $('#yanzhang').blur(function(){
                var obj = $(this);
                var code = obj.val();
                $.ajax({
                    type:"post",
                    url:"checkMsgCode",
                    data:{
                        code:code
                    },success:function(data){
                        var da = JSON.parse(data);
                        if(da.error != '1'){
                            obj.parent().parent().next().html('<i class="img-error"></i>');
                        } else {
                            MsgCode = true;
                            obj.parent().parent().next().html('<i class="img-sucess"></i>');
                        }
                    }
                });
            });

            //验证密码
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
                div.children('p').eq(0).html('6-16位，英文（区分大小写）、数字或常用符号');
            });
            $("#password").blur(function(){
                var obj = $(this);
                var pwd = obj.val();
                obj.parent().removeClass('active');
                //      div class="txt-info dobule-line"
                var div = obj.parent().parent().next();
                div.children('p').eq(0).html('6-16位，英文（区分大小写）、数字或常用符号');

                if(pwdSun(pwd)){
                    div.addClass('txt-alert');
                    div.children('p').eq(0).html('<i class="img-error"></i>密码强度太弱，请重新设置');return;
                }
                if(PwdRight){
                    if (pwd == '') {
                        div.children('p').eq(0).html('6-16位，英文（区分大小写）、数字或常用符号');return;
                    }
                    div.children('p').eq(0).html('<i class="img-sucess"></i>');
                    Pwd = true;
                } else {
                    if (pwd == '') {
                        div.children('p').eq(0).html('6-16位，英文（区分大小写）、数字或常用符号');return;
                    }
                    div.addClass('txt-alert');
                    div.children('p').eq(0).html('<i class="img-error"></i>6-16位，英文（区分大小写）、数字或常用符号');
                }

            });
            //提交
            $("#save-wan").click(function(){

                if(MsgCode && Pwd){

                    $('#Form').submit();
                }else{

                    $(":input").trigger('blur');
                }
            });
        });
    </script>
@stop