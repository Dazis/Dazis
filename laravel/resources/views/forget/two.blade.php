@extends('forget')
@section('content')
    <div class="content">
        <div class="row">
            <div class="bg-fox icons"><i class="img-fox"></i></div>
            <section class="agreement">
                <div class="step-box">
                    <ul>
                        <li class="step-two">
                            <div class="step-num">1</div><span class="step-word step1">输入账号</span>
                        </li>
                        <li class="step-on">
                            <div class="step-num">2</div><span class="step-word step2">选择重置方式</span>
                        </li>
                        <li>
                            <div class="step-num">3</div><span class="step-word step3">重置密码</span>
                        </li>
                    </ul>
                </div>
                <div class="content-box">
                    <div class="choose-way-wra">
                        <p class="choose-way">您正在为账号 {{$userid}} 找回密码，请选择重置方式：</p>
                        <ul class="ways-box">



                            <li class=""><a href="{{url('forget/repwd')}}"><span class="choice-icon choice-ic1"></span><span class="choice-tip">手机找回</span><span class="choice-explain">你的账号已绑定手机{{$userid}}，可使用手机找回密码</span></a></li>
                            @if($email == '')
                                <li class="noway">
                                    <a href="">
                                        <span class="choice-icon choice-ic2"></span>
                                        <span class="choice-tip">邮箱找回</span>
                                        <span class="choice-explain">未绑定邮箱</span>
                                    </a>
                                </li>
                            @else
                                <li class="">
                                    <a href="{{url('forget/toEmail')}}">
                                        <span class="choice-icon choice-ic2"></span>
                                        <span class="choice-tip">邮箱找回</span>
                                        <span class="choice-explain">你的账号已绑定邮箱{{$email}}，可使用邮箱找回密码</span>
                                    </a>
                                </li>
                            @endif


                            {{--<li class="noway"><a><span class="choice-icon choice-ic8"></span><span class="choice-tip">密保问题</span><span class="choice-explain">未设置</span></a></li>--}}

                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
