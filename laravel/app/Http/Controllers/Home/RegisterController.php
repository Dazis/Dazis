<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserInfo;

use Session;
class RegisterController extends Controller
{
    //注册页面
    public function signup(Request $request){

        $signupType = $request->input('signupType');

        if($signupType !='' && $signupType == 'email') {
            return view('register.registerEmail');
        }else{
            return view('register.register');
        }
    }

    //手机号唯一性
    public function checkMoblie(Request $request){
        $phone = $request->input('phone');

        if (!preg_match("/^1[34578]{1}\d{9}$/",$phone)) {

            $arr = ['error'=>10002,'msg'=>'手机号码格式不正确'];
        }else {
            $data = UserInfo::findPhone($phone);
            if ($data) {
                $arr = ['error'=>10001,'msg'=>'数据库中有该手机号的信息'];
            } else {
                $arr = ['error'=>202,'msg'=>'该手机号码可以使用'];
            }
        }
            echo json_encode($arr);
    }

    //注册
    public function zhuce(Request $request){
        $data = $request->input();
        $data['password'] = md5($data['password']);
        $da = UserInfo::add($data);
        if($da){
            Session::set('user',$data['phone']);
            echo 1;
        }else{
            echo 0;
        }
    }
}
