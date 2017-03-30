<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class UserController extends CommonController {


    public function index() {
         //分页
        $conds = array('status' => array('neq',-1));       
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 8;

        $users = D("User")->getList($conds,$page,$pageSize);
        $count = D("User")->getCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);
        $this->assign('users', $users);
        $this->display();
    }

    public function setStatus() {
        $data = array(
            'user_id'=>intval($_POST['id']),
            'status' => intval($_POST['status']),
        );
        return parent::setStatus($_POST,'User');
    }
 

}