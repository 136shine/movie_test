<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class MovieController extends CommonController {
    public function index($type=''){

    	$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;

        $Movie = D("Movie")->getMovieList($conds,$page,$pageSize);
        $count = D("Movie")->getMovieCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);

        $listNewMovies = D("Movie")->select(array('status'=>1,'pic'=>array('neq','')),'up_time desc',30);
        $listHotMovies = D("Movie")->select(array('status'=>1,'pic'=>array('neq','')),'grade desc',30);

       $this->assign('result', array(
            'listNewMovies' => $listNewMovies,
            'listHotMovies' => $listHotMovies,
        ));
        
        $this->display();
    }
}

   