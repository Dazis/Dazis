@extends('layout')
@section('content')
    <div class="content">
        <div class="row">
            <div class="bg-fox icons"><i class="img-fox"></i></div>
            <div class="table-wraper">
                <ul class="nav nav-tabs icons">
                    <li><a href="{{url('signup')}}"><i class="img-cellphone"></i>手机注册</a></li>
                    <li><span>|</span></li>
                    <li class="active"><a href="{{url('signup')}}?signupType=email"><i class="img-email"></i>邮箱注册</a></li>
                        </ul>
                <div class="table-box icons">
                    <form id="regForm" action="/signup/email_signup" method="post" class="regForm clearfix">
                        <div class="control-group hide">
                            <input type="text"><input type="password">
                        </div>
                        <div class="control-group email-index">
                            <label class="ac-email"><span class="tit">邮箱账号</span><span class="ipt">
                    <div class="df-email">@sohu.com</div>
                    <input type="text" value="" name="passport" tabindex="1" autocomplete="off"></span>
                            </label>
                            <div id="ppcard"></div>
                            <div class="txt-info dobule-line">
                                <p>注册搜狐邮箱，可直接登录其他搜狐旗下产品</p><a href="#"  btn-act="oe">我有其他邮箱</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="passport"><span class="tit">设置密码</span><span class="ipt">
                    <input type="password" value="" name="password" tabindex="2" autocomplete="off"></span></label>
                            <div class="txt-info dobule-line">
                                <p>6-16位，英文（区分大小写）、数字或常用符号</p>
                                <p class="pw-lev"><i></i><i></i><i></i></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label><span class="tit">手机号码</span><span class="ipt">
                    <input type="text" value="" name="mobile" tabindex="3"></span></label>
                            <div class="txt-info">绑定手机号码可增强账户安全性</div>
                        </div>
                        <div class="control-group">
                            <label class="verification"><span class="tit">验证码</span><span class="ipt">
                    <input type="text" value="" name="captcha" tabindex="4"></span><a href="javascript:;" class="btn btn-small" btn-act="captcha">点击获取</a>
                            </label>
                            <div class="txt-info">免费获取手机验证码</div>
                        </div>
                        <div class="control-group mg-top">
                            <div class="pd-left"><span>
              <label><input type="checkbox" name="agree" tabindex="4">同意</label><a href="/signup/show_agreement" target="_blank">《搜狐服务协议》</a></span>
                                <div class="txt-info"></div>
                            </div>
                        </div>
                        <div class="control-group mg-top">
                            <div class="pd-left btn-group"><span>
                    <input type="submit" value="立即注册" class="btn btn-xlarge btn-yellow" tabindex="5"></span>
                                <div class="txt-info"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
