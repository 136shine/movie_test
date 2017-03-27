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

        $this->assign('result', array(
            'movie' => $movie,
        ));

        $this->display("Detail/movie");
    }

    public function  view() {
        if(!getLoginUsername()) {
            $this->error("您没有权限访问该页面");
        }
        $this->index();

    }
}