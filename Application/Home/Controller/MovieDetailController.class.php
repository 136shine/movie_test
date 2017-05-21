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


        $review =  D("Review")->select(array('movie_id'=>$id),10);

        $userId = $_SESSION['user']['user_id'];
        if($userId){
            //获取地址栏传入的id同类型的电影
            $typeId = D('Movie')->select(array('movie_type'=>$movie['movie_type']));
            $countId = count($typeId);

            //获取地址栏传入的id同类型的电影的ID集合
            $ids = array();  
            $ids = array_map('array_shift', $typeId);

            //批量更新电影的listorder
            for ($i=0; $i < 6; $i++) { 
                $listorder = rand(1,20);
                $listId = rand(1,$countId);
                var_dump($listId);
                var_dump(intval($ids[$listId]));
                $resu = M('Movie')->where('movie_id='.$ids[$listId])->setField('listorder',$listorder);
            }
            //地址栏传入的id同类型且评分高电影随机推荐
            $rankMovie = D("Movie")->select(array('status'=>1,'movie_type'=>$movie['movie_type']),'grade desc,listorder desc',6);
        }else{
            $rankMovie = D("RankMovie")->select(array('status'=>1),10);
        }
       
        $rankCom = D("Comment")->select(array('status'=>1),10);

        $this->assign('result', array(
            'movie' => $movie,
            'review' => $review,
            'rankMovies' => $rankMovie,
            'rankCom' => $rankCom,
        ));

         //头部显示登录用户
        if($_SESSION['user']){
            $this->header();
        }

        $this->display("Movie/detail");
    }

    public function add()
    {
        if($_POST){
           $data['movie_id'] = intval($_GET['id']);
           $data['content'] = $_POST['content'];
           $data['avator'] = $_POST['avator'];
        }
        $res = D('movie')->find($data['movie_id']);
        $data['movie_name'] = $res['movie_name'];

        $data['time'] = Date('Y-m-d H:i:s');
        $data['username'] = $_SESSION['user']['username'];
        // $data['user_id'] = $_SESSION['user']['user_id'];
        $ret = D('Review')->insert($data);
        return show(1,'发表成功');
       
    }

    //  发表评论
    public function  view() {
        if(!$_SESSION['user']) {
            $this->error("您没有权限访问该页面");
        }else{
             $this->index();
        }
    }
}