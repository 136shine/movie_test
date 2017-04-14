<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class MovieController extends CommonController {
    public function index($type=''){
        $conds['status'] = array('neq',-1);
    	$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;

        $listNewMovies = D("Movie")->getMovieList($conds,$page,$pageSize,'up_time desc');
        $listHotMovies = D("Movie")->getMovieList($conds,$page,$pageSize,'grade desc');
        $count = D("Movie")->getMovieCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);

        $this->assign('result', array(
            'listNewMovies' => $listNewMovies,
            'listHotMovies' => $listHotMovies,
        ));
        //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }
        
        $this->display();
    }
}

   