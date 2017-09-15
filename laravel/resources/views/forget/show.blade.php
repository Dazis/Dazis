@extends('forget')
@section('content')
    <div class="content">
        <div id="password-body" class="row">
            <div class="bg-fox icons"><i class="img-fox"></i></div>
            <section class="agreement">
                <div class="step-box">
                    <ul>
                        <li class="step-on">
                            <div class="step-num">1</div><span class="step-word step1">输入账号</span>
                        </li>
                        <li>
                            <div class="step-num">2</div><span class="step-word step2">选择重置方式</span>
                        </li>
                        <li>
                            <div class="step-num">3</div><span class="step-word step3">重置密码</span>
                        </li>
                    </ul>
                </div>
                <div class="table-wraper table-wraper-wang">
                    <div class="table-box icons">
                        <form id="Form" action="{{url('forget/two')}}" class="regForm clearfix" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="control-group hide">
                                <input type="text"><input type="text">
                            </div>
                            <div class="control-group">
                                <label>
                                    <span class="tit tit-wang">账号</span><span class="ipt ipt-wang">
                                        <input type="text" name="userid" autocomplete="off" tabindex="1" id="userid">
                                    </span>
                                </label>
                                <div class="txt-info">
                                    <i class="img-error hide"></i>请输入账号
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="verification">
                                    <span class="tit tit-wang">验证码</span>
                                    <span id="ipt-wang-diff" class="ipt">
                                        <input type="text" name="captcha" autocomplete="off" tabindex="2" id="captcha">
                                            <p style="margin-bottom: 20px;display: inline-block">
                                                <img src="{{ URL('img/captcha/1') }}"  alt="验证码" title="刷新图片" width="91px" height="40px" id="c2c98f0de5a04167a9e427d883690ff6" s border="1px solid white">
                                            </p>
                                    </span>
                                    <a href="javascript:;" class="change-code" onclick="re_captcha();">换一张</a>
                                </label>
                                <div class="txt-info">请输入验证码</div>
                                <div class="txt-info hide"><i class="img-error"></i>免费获取手机验证码</div>
                                <div class="txt-info hide"><i class="img-sucess"></i></div>
                            </div>
                            <div class="control-group mg-top">
                                <div id="pd-left-wang" class="pd-left btn-group">
                                    <span>
                                        <input id="wang" type="button" value="下一步" class="btn btn-xlarge btn-yellow" tabindex="3">
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
    CheckMobile = false;
    CheckCaptcha = false;
    function re_captcha() {
        $url = "{{ URL('img/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }
    //验证手机号
    function checkMoblie(moblie){
        var preg = /^1[34578]\d{9}$/;
        if (preg.test(moblie)) {
            return true
        } else {

            return false;
        }
    }

    $(function(){
        //手机号
        $('#userid').focus(function(){
            var obj = $(this);
            obj.parent().parent().next().removeClass('txt-alert').html('<i class="img-error hide"></i>请输入账号');
        });
        $('#userid').blur(function(){
            var obj = $(this);
            var userid = obj.val();

            if(!checkMoblie(userid)){
                obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>账号不正确');
            }else{
                $.ajax({
                    type:"post",
                    url:"checkUser",
                    data:{
                        phone:userid
                    },success:function(data){
                        var callData = JSON.parse(data);
                        if(callData.error == 1){
                            obj.parent().parent().next().html('<i class="img-sucess"></i>');
                            CheckMobile = true;
                        }else{
                            obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>账号不正确');
                        }
                    }
                });
            }
        });
        //图形验证码
        $('#captcha').focus(function(){
            var obj = $(this);
            obj.parent().parent().next().removeClass('txt-alert').html('<i class="img-error hide"></i>请输入验证码');
        });
        $('#captcha').blur(function(){
            var obj = $(this);
            var captcha = obj.val();
            if(captcha == ''){
                obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>验证码不能为空');return;
            }
            $.ajax({
                type:"post",
                url:'checkCaptcha',
                data:{
                    captcha:captcha
                },success:function(data){
                    var callData = JSON.parse(data);
                    if(callData.error == '20001'){
                        obj.parent().parent().next().html('<i class="img-sucess"></i>');
                        CheckCaptcha = true;
                    } else {
                        obj.parent().parent().next().addClass('txt-alert').html('<i class="img-error"></i>验证码输入不正确');
                    }
                }
            });
        });
        $('#wang').click(function(){
            if(CheckMobile && CheckCaptcha){
                $('#Form').submit();
            } else {
                $(':input').trigger('blur');
            }
        });
    });
</script>
@stop
