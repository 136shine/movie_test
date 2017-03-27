<?php
namespace Home\Controller;
use Think\Controller;
class MovieDetailController extends CommonController {

    public function index() {
        $id = intval($_GET['id']);
        if(!$id || $id<0) {
            return $this->error("ID不合法");
        }

        $movie =  D("Movie")->find($id);

        if(!$movie || $movie['status'] != 1) {
            return $this->error("ID不存在或者被关闭");
        }

        $content = D("MovieDetail")->find($id);
        $movie['describle'] = htmlspecialchars_decode($content['describle']);
        $movie['count'] = $content['count'];
        $movie['rank'] = $content['rank'];
        $movie['director'] = $content['director'];
        $movie['actors'] = $content['actors'];



        //$this->add();

        $review =  D("Review")->select(array('movie_id'=>$id),10);
        $rankMovie = D("RankMovie")->select(array('status'=>1),10);

        $this->assign('result', array(
            'movie' => $movie,
            'review' => $review,
            'rankMovies' => $rankMovie,
        ));

        $this->display("Detail/movie");
    }

    public function add()
    {
        if($_POST){
           $data['movie_id'] = intval($_GET['id']);
           $data['content'] = $_POST['content'];
        }
        
        $data['time'] = Date('Y-m-d H:i:s');

        $data['username'] = $_SESSION['user']['username'];
        $data['user_id'] = $_SESSION['user']['user_id'];
        
        $ret = D('Review')->insert($data);
        return show(1,'发表成功');
       
    }

    public function  view() {
        if(!getLoginUsername()) {
            $this->error("您没有权限访问该页面");
        }

        $this->index();

    }
}