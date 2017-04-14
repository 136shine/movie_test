<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class CommentController extends CommonController {
    public function index(){

         //分页
        $conds['status'] = array('neq',-1);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 3;

        $listcom = D("Comment")->getList($conds,$page,$pageSize);
        $count = D("Comment")->getCount($conds);
        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);

        $topCom = D("Comment")->select(array('status'=>1,'big_pic'=>array('neq','')),1);
        
        $rankMovie = D("RankMovie")->select(array('status'=>1),10);
  
       
        $this->assign('result', array(
            'listcom' => $listcom,
            'topCom' => $topCom,
            'rankMovies' => $rankMovie,
        ));
         //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }
        
        $this->display();
    }
    public function detail(){
        $id = intval($_GET['id']);
        $rankCom = D("Comment")->select(array('status'=>1),10);
        
        $com = D("Comment")->find($id);
        $this->assign('result', array(
            'com' => $com,
            'rankCom' => $rankCom,
        ));
         //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }
        
        $this->display();
    }
}