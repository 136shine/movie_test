<?php
namespace Home\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class UserController extends Controller {

    public function index(){
        if(session('user')) {
           $this->redirect('/index.php');
        }
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

        D("User")->updateByAdminId($ret['user_id'],array('lastLoginTime'=>Date('Y-m-d H:i:s')));
        D("User")->updateStatusById($ret['user_id'],1);
        session('user', $ret);
        // print_r($_SESSION['user']);exit;
        return show(1,'登录成功');

    }

    public function loginout() {
       
        $ret = D('User')->getAdminByUsername($_SESSION['user']['username']);
        D("User")->updateStatusById($ret['user_id'],0);
         session('user', null);
        $this->redirect('/index.php?c=user&a=login');
    }

    public function add(){
        if($_POST) {
           
            // if(!isset($_POST['pic']) || !$_POST['pic']) {
            //     return show(0,'头像不存在');
            // }
            if(!isset($_POST['email']) || !$_POST['email']) {
                return show(0,'邮箱不存在');
            }
            if(!isset($_POST['phone']) || !$_POST['phone']) {
                return show(0,'电话不存在');
            }
            if(!isset($_POST['sex']) || !$_POST['sex']) {
                return show(0,'性别不存在');
            }
            if($_POST['username']) {
                return $this->save($_POST);
            }
            $userId = D("User")->insert($_POST);

            
        }else {

            $this->display();
        }
    }

    public function personal() {
        $Id = $_SESSION['user']['user_id'];//获取
        if(!$Id) {
            // 执行跳转
            $this->redirect('/index.php?c=user');
        }
        $user = D("User")->getUserById($Id);
        if(!$user) {
            $this->redirect('/index.php?c=user');
        }
        $this->assign('user',$user);
        $this->display();
    }

    public function save($data) {
        $Id = $_SESSION['user']['user_id'];

        try {
            $id = D("User")->updateByAdminId($Id,$data);
            if($id === false) {
                return show(0, '修改失败');
            }
            return show(1, '修改成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }

    }

}