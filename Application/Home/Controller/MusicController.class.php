<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class MusicController extends CommonController {
    public function index(){

        //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }

        if ($_POST['keyword']) {
            $data['status'] = array('neq',-1);
            $data['music_name'] = $_POST['keyword'];
        }else{
            $data['status'] = array('neq',-1);
        }

        //分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;

        $listMusic = D("Music")->getList($data,$page,$pageSize);

        $count = D("Music")->getCount($data);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);
        $this->assign('result', array(
                'listMusic' => $listMusic,
        ));
        
        $this->display();
    }
    public function detail(){
        $id = intval($_GET['id']);
        
        $listmu = D("Music")->find($id);
        $this->assign('listmu' , $listmu );
        
        //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }
        $this->display(Music/detail);
    }
}