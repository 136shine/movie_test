<?php
/**
 * 
 */
namespace Admin\Controller;
use Think\Controller;
class RankMovieController extends CommonController {
    public function index()
    {   
        //分页
        $conds['status'] = array('neq',-1);       
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 6;

        $rank_movie = D("RankMovie")->getList($conds,$page,$pageSize);
        $count = D("RankMovie")->getCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);

        $this->assign('rank_movie',$rank_movie);
        $this->display();
    }

    public function add() {
        if($_POST) {
            /**
             * 如果提交了id，那么及时编辑模式
             */
            if($_POST['id']) {
                return $this->save($_POST);
            }
            try {

                $id = D("RankMovie")->insert($_POST);
                if($id) {
                    return show(1,'新增成功',$id);
                }
                return show(0,'新增失败',$id);


            }catch(Exception $e) {
                return show(0, $e->getMessage());
            }
            return show(0, '新增失败',$newsId);
        }else {
            $this->display();
        }

    }
    /**
     * 编辑页面
     */
    public function edit() {
        $data = array(
            'status' => array('neq',-1),
        );
        $id = $_GET['id'];
        $position = D("RankMovie")->find($id);
        $this->assign('vo', $position);
        $this->display();

    }
    public function save($data) {
        $id = $data['id'];
        unset($data['id']);
        try {
            $id = D("RankMovie")->updateById($id,$data);
            if($id === false) {
                return show(0,'更新失败');
            }
            return show(1,'更新成功');
        }catch (Exception $e) {
            return show(0,$e->getMessage());
        }
    }
    /**
     * 设置状态
     * status=1 正常 0关闭 -1删除
     */
    public function setStatus(){
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                $res = D("RankMovie")->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }

            }
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }

        return show(0, '没有提交的内容');
    }
     public function batchDel() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $RankMovieId = $_POST;
       
        if(!$RankMovieId || !is_array($RankMovieId)) {
            return show(0, '请选择推荐歌曲ID进行批量删除');
        }
       
        try {
                $RankMovie = D("RankMovie")->getRankMovieIn($RankMovieId);
                if (!$RankMovie) {
                    return show(0, '没有相关内容');
                }
                
                foreach ($RankMovie as $new) {
                    $data = array(
                        'id' => $new['id'],
                    );
                    $id = $data['id']; 
                    if (!$id) {
                        return show(0, 'ID不存在');
                    }
                    $res = D("RankMovie")->updateStatusById($id, -1);
                } 
            }catch(Exception $e) {
                return show(0, $e->getMessage());
            }

        return show(1, '删除成功',array('jump_url'=>$jumpUrl));


    }
}