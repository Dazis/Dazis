<?php
namespace app\index\controller;
use think\Session;
class Userinfo extends \think\Controller
{
	public function __construct(){
        parent::__construct();
        $session = Session::get('name');
        if($session==""){
        	$this->error('请先登录', 'Login/index');
        }
    }
    //列表
    public function userList()
    {
    	return $this->fetch('userList');
    }
    //添加用户
    public function user_add(){
    	return $this->fetch('user_add');
    }
}
