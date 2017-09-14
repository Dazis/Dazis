<?php
namespace app\index\controller;
use think\Session;
use \think\Controller;
use think\Db;
use think\Request;
class Jurisdiction extends Controller
{	
    public function __construct(){
        parent::__construct();
        $session = Session::get('name');
        if($session==""){
            $this->error('请先登录', 'Login/index');
        }
    }
    // 角色列表页面
    public function role(){
        $data = Db::table('role')->paginate(6);
        // 模板变量赋值
        $this->assign('data',$data);
        return $this->fetch('role');
    }
    // 角色删除
    public function role_del(Request $request){
        $roleId = Request::instance()->param('roleId');// 接受用户id
        $res = Db::table('role')->where('roleId',$roleId)->delete();
        if($res){
            $this->success('删除成功', 'Jurisdiction/role');
        }else{
            $this->error('删除失败', 'Jurisdiction/role');
        }
    }
    // 角色添加页面
    public function role_add(){
        return $this->fetch('role_add');
    }
    // 角色添加
    public function role_role(){
    	$role = Request::instance()->param('role');// 接受权限名称
        $add_time = time();
        $data = ['role' => $role,'add_time'=>$add_time];
        $res = Db::name('role')->insert($data);
        if($res){
            $this->success('添加成功', 'Jurisdiction/role');
        }else{
            $this->error('添加失败', 'Jurisdiction/role');
        }
    }
    // 角色修改
    public function role_update(Request $request){
        $roleId = Request::instance()->param('roleId');// 接受用户id
        $data   = Db::table('role')->where('roleId',$roleId)->find();
        // 模板变量赋值
        $this->assign('data',$data);
        return view('Jurisdiction/role_update');
    }
    // 接收修改数据进行更新
    public function update_role(Request $request){
        $role = Request::instance()->param('role');// 接受用户名
        $roleId = Request::instance()->param('roleId');// 接受用户id
        $data = ['role' => $role];
        $res = Db::name('role')->where('roleId',$roleId)->update($data);
        if($res){
            $this->success('修改成功', 'Jurisdiction/role');
        }else{
            $this->error('修改失败', 'Jurisdiction/role');
        }
    }


    // 权限展示
    public function jsdt(){
        $data = Db::table('note')->paginate(8);
        // 模板变量赋值
        $this->assign('data',$data);
        return $this->fetch('jsdt'); 
    }
    // 权限添加模板渲染
    public function jsdt_add(){
        return $this->fetch('jsdt_add');
    }
    //删除权限
    public function jsdt_del(Request $request){
        $noteId = Request::instance()->param('noteId');// 接受用户id
        $res = Db::table('note')->where('noteId',$noteId)->delete();
        if($res){
            $this->success('删除成功', 'Jurisdiction/jsdt');
        }else{
            $this->error('删除失败', 'Jurisdiction/jsdt');
        }
    }
    // 修改页面
    public function jsdt_update(Request $request){
        $noteId = Request::instance()->param('noteId');// 接受用户id
        $data   = Db::table('note')->where('noteId',$noteId)->find();
        // 模板变量赋值
        $this->assign('data',$data);
        return view('Jurisdiction/jsdt_update');
    }
    // 权限添加
    public function jsdt_insert(Request $request){
        $noteName = Request::instance()->param('noteName');// 接受用户名
        $noteRoad = Request::instance()->param('noteRoad');// 接受用户密码
        $add_time = time();
        $data = ['noteName' => $noteName, 'noteRoad' => $noteRoad,'add_time'=>$add_time];
        $res = Db::name('note')->insert($data);
        if($res){
            $this->success('添加成功', 'Jurisdiction/jsdt');
        }else{
            $this->error('添加失败', 'Jurisdiction/jsdt');
        }
    }
    // 接收修改数据进行更新
    public function update_jsdt(Request $request){
        $noteName = Request::instance()->param('noteName');// 接受用户名
        $noteId = Request::instance()->param('noteId');// 接受用户id
        $noteRoad = Request::instance()->param('noteRoad');// 接受用户密码
        $data = ['noteName' => $noteName, 'noteRoad' => $noteRoad];
        $res = Db::name('note')->where('noteId',$noteId)->update($data);
        if($res){
            $this->success('修改成功', 'Jurisdiction/jsdt');
        }else{
            $this->error('修改失败', 'Jurisdiction/jsdt');
        }
    }




    // 角色赋予权限展示
    public function role_jsdt(){
        // $userId=Session::get('userId');
        $roleId = Request::instance()->param('roleId');// 接受用户id
        $data = Db::table('role_note')->where('roleId',$roleId)->select();
        $goods = array();
        $box ='';
        foreach ($data AS $key => $val)
        {
            $goods[$key]['noteId']           = $val['noteId'];
            $box.= ",".$val['noteId'];
        }
        $box=ltrim($box,",");
        // 已拥有权限
        $data = Db::table('note')->where('noteId','in',$box)->select();
        // 未拥有权限
        $date = Db::table('note')->where('noteId','notin',$box)->select();
        $this->assign('data',$data);
        $this->assign('date',$date);
        $this->assign('roleId',$roleId);
        return $this->fetch('role_jsdt');
    }
    // 角色赋予权限添加
    public function role_noteAdd(Request $request){
        $noteId = Request::instance()->param('noteId');
        $roleId = Request::instance()->param('roleId');
        $noteId = explode(",",$noteId);
        foreach ($noteId as $key => $val) {
                $res = Db::name('role_note')->insert(['roleId'=>$roleId,'noteId'=>$val]);
        }
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    // 删除角色权限
    public function role_notedel(Request $request){
        $noteId = Request::instance()->param('noteId');
        $roleId = Request::instance()->param('roleId');
        $res = Db::table('role_note')->where('noteId','in',$noteId)->where('roleId',$roleId)->delete();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    // 给用户添加角色
    public function user_role(){
        $userId = Request::instance()->param('userId');// 接受用户id
        $data = Db::table('user_role')->where('userId',$userId)->select();
        $goods = array();
        $box ='';
        foreach ($data AS $key => $val)
        {
            $goods[$key]['roleId']           = $val['roleId'];
            $box.= ",".$val['roleId'];
        }
        $box=ltrim($box,",");
        // 已拥有角色
        $data = Db::table('role')->where('roleId','in',$box)->select();
        // 未拥有角色
        $date = Db::table('role')->where('roleId','notin',$box)->select();
        $this->assign('data',$data);
        $this->assign('date',$date);
        $this->assign('userId',$userId);
        return $this->fetch('user_role');
    }
    // 用户赋予角色添加
    public function user_roleAdd(Request $request){
        $roleId = Request::instance()->param('roleId');
        $userId = Request::instance()->param('userId');
        $roleId = explode(",",$roleId);
        foreach ($roleId as $key => $val) {
                $res = Db::name('user_role')->insert(['userId'=>$userId,'roleId'=>$val]);
        }
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    // 删除用户角色
    public function user_roledel(Request $request){
        $roleId = Request::instance()->param('roleId');
        $userId = Request::instance()->param('userId');
        $res = Db::table('user_role')->where('roleId','in',$roleId)->where('userId',$userId)->delete();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }


    // 用户展示页面
    public function amstt(){
        $data = Db::table('user')->paginate(8);
        // 模板变量赋值
        $this->assign('data',$data);
        return $this->fetch('amstt'); 
    }
    //管理员添加角色
    public function amstt_role(){
        return $this->fetch('amstt_role');
    }
    //删除用户
    public function amstt_del(Request $request){
        $userId = Request::instance()->param('userId');// 接受用户id
        $res = Db::table('user')->where('userId',$userId)->delete();
        if($res){
            $this->success('删除成功', 'Jurisdiction/amstt');
        }else{
            $this->error('删除失败', 'Jurisdiction/amstt');
        }
    }
    // 添加用户页面
    public function amstt_add(){
        return view('Jurisdiction/amstt_add');
    }
    // 添加用户信息
    public function amstt_user(Request $request){
        $nickname = Request::instance()->param('nickname');// 接受用户名
        $password = Request::instance()->param('password');// 接受用户密码
        $new      = md5($password);
        $add_time = time();
        $data = ['nickname' => $nickname, 'password' => $new,'add_time'=>$add_time];
        $res = Db::name('user')->insert($data);
        if($res){
            $this->success('添加成功', 'Jurisdiction/amstt');
        }else{
            $this->error('添加失败', 'Jurisdiction/amstt');
        }
    }
    // 修改页面
    public function amstt_update(Request $request){
        $userId = Request::instance()->param('userId');// 接受用户id
        $data   = Db::table('user')->where('userId',$userId)->find();
        // 模板变量赋值
        $this->assign('data',$data);
        return view('Jurisdiction/amstt_update');
    }
    // 接收修改数据进行更新
    public function update_amstt(Request $request){
        $nickname = Request::instance()->param('nickname');// 接受用户名
        $userId = Request::instance()->param('userId');// 接受用户id
        $password = Request::instance()->param('password');// 接受用户密码
        $new      = md5($password);
        $data = ['nickname' => $nickname, 'password' => $new];
        $res = Db::name('user')->where('userId',$userId)->update($data);
        if($res){
            $this->success('修改成功', 'Jurisdiction/amstt');
        }else{
            $this->error('修改失败', 'Jurisdiction/amstt');
        }
    }

    // 用户反馈
    public function feedback(){
        $data = Db::table('contact')->alias('a')->join('userinfo c','a.user_id = c.id')->paginate(8);
        // 模板变量赋值
        $this->assign('data',$data);
        return $this->fetch('feedback'); 
    }
    // 用户反馈删除
    public function feedback_del(Request $request){
        $c_id = Request::instance()->param('c_id');// 接受用户id
        $res = Db::table('contact')->where('c_id',$c_id)->delete();
        if($res){
            $this->success('删除成功', 'Jurisdiction/feedback');
        }else{
            $this->error('删除失败', 'Jurisdiction/feedback');
        }
    }
    // 反馈用户
    public function reversion(Request $request){
        $c_id = Request::instance()->param('c_id');// 接受用户id
        $email = Request::instance()->param('email');// 接受用户id
        $this->assign('c_id',$c_id);
        $this->assign('email',$email);
        return $this->fetch('reversion');
    }
    /**
     * tp5邮件
     * @param
     * @author staitc7 <static7@qq.com>
     * @return mixed
     */
    public function email() {
        $content = Request::instance()->param('content');// 接受用户id
        $c_id = Request::instance()->param('c_id');// 接受用户id
        $toemail = Request::instance()->param('email');// 接受用户id
        $name='花间提壶小贾总';
        $subject='搜狐健康';
        $data = ['status' => 1];
        $res = Db::name('contact')->where('c_id',$c_id)->update($data);
        $str = send_mail($toemail,$name,$subject,$content);
        if($res=="1" && $str){
            $this->success('邮件发送成功', 'Jurisdiction/feedback');
        }else{
            $this->error('邮件发送失败', 'Jurisdiction/feedback');
        }
    }
}
