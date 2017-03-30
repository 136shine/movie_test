<?php
namespace Admin\Controller;
use Think\Controller;

class CommentController extends CommonController {
    public function index()
    {
        //分页
        $conds['status'] = array('neq',-1);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 6;

        $comment = D("Comment")->getList($conds,$page,$pageSize);
        $count = D("Comment")->getCount($conds);
        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);
        $this->assign('comment',$comment);
        
        $this->display();
    }

     public function add(){
        if($_POST) {
            if(!isset($_POST['movie_name']) || !$_POST['movie_name']) {
                return show(0,'电影名不存在');
            }
            if(!isset($_POST['pic']) || !$_POST['pic']) {
                return show(0,'海报不存在');
            }
            if(!isset($_POST['title']) || !$_POST['title']) {
                return show(0,'标题不存在');
            }
            if(!isset($_POST['author']) || !$_POST['author']) {
                return show(0,'作者不存在');
            }
            if(!isset($_POST['time']) || !$_POST['time']) {
                return show(0,'发表时间不存在');
            }
            if(!isset($_POST['content']) || !$_POST['content']) {
                return show(0,'文章内容不存在');
            }
            if($_POST['id']) {
                return $this->save($_POST);
            }
            $content = D("Comment")->insert($_POST);

            if($content){
                return show(1,'新增成功');
            }else{
            	return show(0,'新增失败');
        	}

        }else {
            $this->display();
        }
    }

    public function edit() {
        $commentId = $_GET['id'];//获取地址栏中带过来的id
        if(!$commentId) {
            // 执行跳转
            $this->redirect('/admin.php?c=comment');
        }
        $com = D("Comment")->find($commentId);
        if(!$com) {
            $this->redirect('/admin.php?c=comment');
        }
         

        $webSiteMenu = D("Menu")->getBarMenus();
        $this->assign('webSiteMenu', $webSiteMenu);

        $this->assign('comm',$com);
        $this->display();
    }

    public function save($data) {
        $CommId = $data['id'];
        unset($data['id']);

        try {
            $id = D("Comment")->updateById($CommId, $data);
            if($id === false) {
                return show(0, '更新失败');
            }
            return show(1, '更新成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }

    }


     public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("Comment")->updateStatusById($id, $status);

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

    public function listorder() {
        $listorder = $_POST['listorder'];//获取排序数组
        //print_r($listorder);exit;
        $jumpUrl = $_SERVER['HTTP_REFERER'];//获取前一页面的url
        $errors = array();
        try {
            if ($listorder) {
                foreach ($listorder as $Id => $v) {
                    // 执行更新
                    $res = D("Comment")->updateCommListorderById($Id, $v);
                    //print_r($id);

                    if ($res === false) {
                        $errors[] = $Id;//更新失败的id存入数组
                    }
                }
                if ($errors) {
                    return show(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return show(1, '排序成功', array('jump_url' => $jumpUrl));
            }
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0,'获取排序数据失败',array('jump_url' => $jumpUrl));
    }

   
}
?> 