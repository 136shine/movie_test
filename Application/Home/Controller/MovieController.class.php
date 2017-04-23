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
        if ($_POST['keyword']) {
            // dump($page);exit;
            $data['movie_name'] = $_POST['keyword'];
           // $data['movie_type'] = $_POST['keyword'];
            $SearchMovies = D("Movie")->getMovieList($data,$page,$pageSize);

            $count2 = D("Movie")->getMovieCount($data);
            // dump($data);
            //  dump($count);

            $res2  =  new \Think\Page($count2,$pageSize);
            $page2 = $res2->show();

            $this->assign('page2',$page2);
            $this->assign('searchRes',$SearchMovies);
            //dump($SearchMovies);exit;
        }
        $this->display();
    }
}

   