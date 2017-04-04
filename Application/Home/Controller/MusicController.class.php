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

        // $topCom = D("Music")->select(array('status'=>1,'big_pic'=>array('neq','')),1);
        //print_r($topCom);exit;
        $rankMovie = D("RankMovie")->select(array('status'=>1),10);

  
       
       $this->assign('result', array(
            // 'listcom' => $listcom,
            // 'topCom' => $topCom,
            'rankMovies' => $rankMovie,
            'listMusic' => $listMusic,
        ));
        
        $this->display();
    }
    public function detail(){
        $id = intval($_GET['id']);
        
        $listmu = D("Music")->find($id);
        $this->assign('listmu' , $listmu );
        
        $this->display(Music/detail);
    }
}