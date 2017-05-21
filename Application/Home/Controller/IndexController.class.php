<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class IndexController extends CommonController {
    public function index($type=''){
        $userId = $_SESSION['user']['user_id'];
        if($userId){
            $ret = D('User')->getUserById($userId);
            $listMovies = D("Movie")->select(array('status'=>1,'pic'=>array('neq',''),'movie_type'=>$ret['movie_type']),'grade desc',20);
        }else{
             $listMovies = D("Movie")->select(array('status'=>1,'pic'=>array('neq','')),'grade desc',24);
        }
        
        

        $topRecomment = D('Movie')->select(array('status'=>1,'big_pic'=>array('neq','')),'listorder desc',3);
       
        $rankMovie = D("RankMovie")->select(array('status'=>1),'grade desc',10);
        $rankCom = D("Comment")->select(array('status'=>1),10);
       
        $this->assign('result', array(
            'topPic' => $topRecomment,
            'listMovies' => $listMovies,
            'rankMovies' => $rankMovie,
            'rankCom' => $rankCom,

        ));
        //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }
        /**
         * 生成页面静态化
         */
        if($type == 'buildHtml') {
            $this->buildHtml('index',HTML_PATH,'Index/index');

        }else {
            $this->display();
        }
    }

    public function build_html() {
        $this->index('buildHtml');
        return show(1, '首页缓存生成成功');
    }


    public function crontab_build_html() {
        if(APP_CRONTAB != 1) {
            die("the_file_must_exec_crontab");
        }
        $result = D("Basic")->select();
        if(!$result['cacheindex']) {
            die('系统没有设置开启自动生成首页缓存的内容');
        }
        $this->index('buildHtml');

    }

    public function getCount() {
        if(!$_POST) {
            return show(0, '没有任何内容');
        }

        $newsIds =  array_unique($_POST);

        try{
            $list = D("News")->getNewsByNewsIdIn($newsIds);
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }

        if(!$list) {
            return show(0, 'notdataa');
        }

        $data = array();
        foreach($list as $k=>$v) {
            $data[$v['news_id']] = $v['count'];
        }
        return show(1, 'success', $data);
    }
}