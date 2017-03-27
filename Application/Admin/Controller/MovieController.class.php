<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

/**
 * 电影内容管理
 */
class MovieController extends CommonController {

    public function index() {
        $conds = array(); 
        if($movieId) {
            $conds['movie_id'] = $_GET['movie_id'];
        }
        if($_GET['movie_type']) {
            $conds['movie_type'] = $_GET['movie_type'];
        }

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;

        $Movie = D("Movie")->getMovieList($conds,$page,$pageSize);
        $count = D("Movie")->getMovieCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);
        $this->assign('Movie',$Movie);

        $this->assign('webSiteMenu',D("Menu")->getBarMenus());
        $this->display();
    }
    public function add(){
        if($_POST) {
            if(!isset($_POST['movie_name']) || !$_POST['movie_name']) {
                return show(0,'电影名不存在');
            }
            if(!isset($_POST['movie_type']) || !$_POST['movie_type']) {
                return show(0,'电影类型不存在');
            }
            if(!isset($_POST['grade']) || !$_POST['grade']) {
                return show(0,'评分不存在');
            }
            if(!isset($_POST['pic']) || !$_POST['pic']) {
                return show(0,'缩略图不存在');
            }
            if(!isset($_POST['up_time']) || !$_POST['up_time']) {
                return show(0,'上映时间不存在');
            }
            if($_POST['movie_id']) {
                return $this->save($_POST);
            }
            $movieId = D("Movie")->insert($_POST);

            if($movieId) {
                $movieContentData['describle'] = $_POST['describle'];
                $movieContentData['movie_id'] = $movieId;
                $movieContentData['count'] = $_POST['count'];
                $movieContentData['rank'] = $_POST['rank'];
                $movieContentData['director'] = $_POST['director'];
                $movieContentData['actors'] = $_POST['actors'];
                $cId = D("MovieDetail")->insert($movieContentData);
                if($cId){
                    return show(1,'新增成功');
                }else{
                    return show(1,'主表插入成功，副表插入失败');
                }


            }else{
                return show(0,'新增失败');
            }

        }else {

            
            $movie_type= C("MOVIE_TYPE");

            $this->assign('movie_type', $movie_type);
            $this->display();
        }
    }

    public function edit() {
        $movieId = $_GET['id'];//获取地址栏中带过来的movie_id
        if(!$movieId) {
            // 执行跳转
            $this->redirect('/admin.php?c=movie');
        }
        $movie = D("Movie")->find($movieId);
        if(!$movie) {
            $this->redirect('/admin.php?c=movie');
        }
        $movieDetail = D("MovieDetail")->find($movieId);
        if($movieDetail) {
            $movie['describle'] = $movieDetail['describle'];
            $movie['rank'] = $movieDetail['rank'];
            $movie['count'] = $movieDetail['count'];
            $movie['actors'] = $movieDetail['actors'];
            $movie['director'] = $movieDetail['director'];
        }      

        $webSiteMenu = D("Menu")->getBarMenus();
        $this->assign('webSiteMenu', $webSiteMenu);
        
        $this->assign('movieType', C("MOVIE_TYPE"));

        $this->assign('movie',$movie);
        $this->display();
    }

    public function save($data) {
        $MovieId = $data['movie_id'];
        unset($data['movie_id']);

        try {
            $id = D("Movie")->updateById($MovieId, $data);
            $MovieDetailData['describle'] = $data['describle'];
            $MovieDetailData['rank'] = $data['rank'];
            $MovieDetailData['count'] = $data['count'];
            $MovieDetailData['director'] = $data['director'];
            $MovieDetailData['actors'] = $data['actors'];
            $condId = D("MovieDetail")->updateMvDetailById($MovieId, $MovieDetailData);
            if($id === false || $condId === false) {
                return show(0, '更新失败');
            }
            return show(1, '更新成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }

    }
    public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("Movie")->updateStatusById($id, $status);

                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
            return show(0, '没有提交的内容');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function listorder() {
        $listorder = $_POST['listorder'];//获取排序数组
        $jumpUrl = $_SERVER['HTTP_REFERER'];//获取前一页面的url
        $errors = array();
        try {
            if ($listorder) {
                foreach ($listorder as $MovieId => $v) {
                    // 执行更新
                    $res = D("Movie")->updateMvListorderById($MovieId, $v);
                    //print_r($id);

                    if ($res === false) {
                        $errors[] = $MovieId;//更新失败的id存入数组
                    }
                }
                if ($errors) {
                    return show(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return show(1, '排序成功', array('jump_url' => $jumpUrl));
            }
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0,'获取排序数据失败',array('jump_url' => $jumpUrl));
    }

    public function push() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $movieId = $_POST;
       
        if(!$movieId || !is_array($movieId)) {
            return show(0, '请选择推荐电影ID进行推荐');
        }
       
        try {
            $Movie = D("Movie")->getMovieByMovieIdIn($movieId);
            if (!$Movie) {
                return show(0, '没有相关内容');
            }
            foreach ($Movie as $new) {
                $data = array(
                    'movie_name' => $new['movie_name'],
                    'pic' => $new['pic'],
                    'movie_id' => $new['movie_id'],
                    'status' => 1,
                    'grade' => $new['grade'],
                    'listorder' => $new['listorder'],
                    'push_time' =>Date('Y-m-d H:i:s'),

                    
                );
                $ret = D('MovieDetail')->find($data['movie_id']);
                $data['rank']=$ret['rank'];
                $rank_movie = D("RankMovie")->insert($data);
            }
           
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }

        return show(1, '推荐成功',array('jump_url'=>$jumpUrl));


    }
}