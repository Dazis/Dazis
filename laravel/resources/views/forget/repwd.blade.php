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
                    <p class="choose-way choose-way-diff">您正在使用手机找回密码方式，请完成以下操作：</p>
                    <div class="table-box icons">
                        <form id="Form" action="" class="regForm clearfix" method="post">
                            <div class="control-group hide">
                                <input type="text"><input type="password">
                            </div>


                            <div class="control-group">

                                <label class="verification">
                                    <span class="tit tit-wang">手机号码</span>
                                    <span class="phone-num">153****2394</span>
                                    <a id="btn-wan" href="{{url('img/msgCode')}}" class="btn btn-small">点击获取</a>
                                </label>

                                <div class="txt-info"><i class="img-error hide"></i>免费获取手机验证码</div>
                            </div>


                            <div class="control-group">
                                <label>
                                    <span class="tit tit-wang">验证码</span>
                                    <span class="ipt ipt-wang">
                                        <a href="javascript:;" class="shortcut active"></a>
                                        <input name="captch" autocomplete="off" tabindex="1" type="text">
                                    </span>
                                </label>
                                <div class="txt-info"><i class="img-error hide"></i>请输入手机验证码</div>
                            </div>



                            <div class="control-group">
                                <label class="passport">
                                    <span class="tit tit-wang">新密码</span>
                                    <span class="ipt ipt-wang">
                                        <a href="javascript:;" class="shortcut" tabindex="-1"><i class="img-eyes"></i></a>
                                        <input name="password" autocomplete="off" tabindex="2" type="password">
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
                                        <input id="save-wang" value="保存" class="btn btn-xlarge btn-yellow" tabindex="3" type="button">
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
@stop