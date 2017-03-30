<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class CommentController extends CommonController {
    public function index(){

         //分页
        $conds['status'] = array('neq',-1);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 1;

        $listcom = D("Comment")->getList($conds,$page,$pageSize);
        $count = D("Comment")->getCount($conds);
        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);

        // $listcom = D("Comment")->select(array('status'=>1),12);
        $rankMovie = D("RankMovie")->select(array('status'=>1),10);
  
       
       $this->assign('result', array(
            'listcom' => $listcom,
            'rankMovies' => $rankMovie,
        ));
        
        $this->display();
    }
    public function detail(){
        $id = intval($_GET['id']);
        
        $listcom = D("Comment")->find($id);
        $this->assign('listcom' , $listcom );
        
        $this->display();
    }
}