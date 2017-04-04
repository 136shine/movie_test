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

    public function batchDel() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $UserId = $_POST;
       
        if(!$UserId || !is_array($UserId)) {
            return show(0, '请选择推荐歌曲ID进行批量删除');
        }
       
        try {
                $User = D("User")->getUserIn($UserId);
                if (!$User) {
                    return show(0, '没有相关内容');
                }
                
                foreach ($User as $new) {
                    $data = array(
                        'id' => $new['id'],
                    );
                    $id = $data['id']; 
                    if (!$id) {
                        return show(0, 'ID不存在');
                    }
                    $res = D("User")->updateStatusById($id, -1);
                } 
            }catch(Exception $e) {
                return show(0, $e->getMessage());
            }

        return show(1, '删除成功',array('jump_url'=>$jumpUrl));


    }
 

}