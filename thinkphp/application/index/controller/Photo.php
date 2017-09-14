<?php
namespace app\index\controller;
use think\Session;
class Photo extends \think\Controller
{
	public function __construct(){
        parent::__construct();
        $session = Session::get('name');
        if($session==""){
        	$this->error('请先登录', 'Login/index');
        }
    }
    public function show(){
    	return $this->fetch('show');
    }
}
