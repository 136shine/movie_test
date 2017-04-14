<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class MusicController extends CommonController {
    public function index(){

         //分页
        $conds['status'] = array('neq',-1);
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;

        $listMusic = D("Music")->getList($conds,$page,$pageSize);
        $count = D("Music")->getCount($conds);
        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);

        $rankMovie = D("RankMovie")->select(array('status'=>1),10);

  
        //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }

        $this->assign('result', array(
            'rankMovies' => $rankMovie,
            'listMusic' => $listMusic,
        ));
        
        $this->display();
    }
    public function detail(){
        $id = intval($_GET['id']);
        
        $listmu = D("Music")->find($id);
        $this->assign('listmu' , $listmu );
        
        $this->header();
        $this->display(Music/detail);
    }
}