<?php
namespace Home\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class UserController extends Controller {

    public function index(){
        // if(session('User')) {
        //    $this->redirect('/index.php');
        // }
        // admin.php?c=index
        $this->display();
    }

    public function register(){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if(!trim($username)) {
            return show(0,'用户名不能为空');
        }
        if(!trim($password)) {
            return show(0,'密码不能为空');
        }

        $data = array('username' => $username, 'password' => $password);
      

        $ret = D('User')->getAdminByUsername($username);
        if($ret) {
            return show(0,'该用户已存在');
        }else{
            D('User')->insert($data);
        }
        return show(1,'注册成功');
    }

    public function check() {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if(!trim($username)) {
            return show(0,'用户名不能为空');
        }
        if(!trim($password)) {
            return show(0,'密码不能为空');
        }

        $ret = D('User')->getAdminByUsername($username);
        if(!$ret) {
            return show(0,'该用户不存在');
        }

        if($ret['password'] != $password) {
            return show(0,'密码错误');
        }

        D("User")->updateByAdminId($ret['user_id'],array('lastLoginTime'=>time()));
        D("User")->updateStatusById($ret['user_id'],1);
        //session('User', $ret);
        return show(1,'登录成功');

    }

    public function loginout() {
        session('User', null);
        D("User")->updateStatusById($ret['user_id'],0);
        $this->redirect('/index.php?c=user');
    }

}