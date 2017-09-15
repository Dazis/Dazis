<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class UserInfo extends Model
{
    protected $table = "userinfo";

    protected $primaryKey = 'id';

    public $timestamps = false;

    //检查输入手机号是否已被注册
    static public function findPhone($phone){
        return DB::table('userinfo')->where(['phone'=>$phone])->first();
    }
    //根据openid查询
    static public function openId($openid){
        return DB::table('userinfo')->where(['openId'=>$openid])->first();
    }
    //根据phone查询
    static public function sel($data){
        return DB::table('userinfo')->where($data)->first();
    }
    //注册 信息入库
    static public function add($arr){
        $arr['created_time'] = time();
        return DB::table('userinfo')->insert($arr);
    }

    static public function PhonePwd($data){
        $data['password'] = md5($data['password']);
        return DB::table('userinfo')->where($data)->first();
    }
    //修改
    static public function replace($data){
        $email = $data['email'];
        $password = $data['password'];
        return DB::table('userinfo')->where(['email'=>$email])->update(['password'=>$password]);
    }
}
