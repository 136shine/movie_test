<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

/**
 * 电影内容管理
 */
class MessageController extends CommonController {

    public function index() {
        //分页 
        $conds['status'] = array('neq',-1);    
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 8;

        $msg = D("Review")->getCommentList($conds,$page,$pageSize);

        $count = D("Review")->getCommentCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);
        $this->assign('message',$msg);

        $this->assign('webSiteMenu',D("Menu")->getBarMenus());
        $this->display();
    }
  
  
    public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("Review")->updateStatusById($id, $status);

                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
            return show(0, '没有提交的内容');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function batchDel() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $ReviewId = $_POST;
       
        if(!$ReviewId || !is_array($ReviewId)) {
            return show(0, '请选择ID进行批量删除');
        }
       
        try {
                $Review = D("Review")->getReviewIn($ReviewId);
                if (!$Review) {
                    return show(0, '没有相关内容');
                }
                
                foreach ($Review as $new) {
                    $data = array(
                        'id' => $new['id'],
                    );
                    $id = $data['id']; 
                    if (!$id) {
                        return show(0, 'ID不存在');
                    }
                    $res = D("Review")->updateStatusById($id, -1);
                } 
            }catch(Exception $e) {
                return show(0, $e->getMessage());
            }

        return show(1, '删除成功',array('jump_url'=>$jumpUrl));
    }

}