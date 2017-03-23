<?php
namespace Admin\Controller;
use Think\Controller;

class CommentController extends CommonController {
    public function index()
    {
        $data['status'] = array('neq',-1);

        $rank_movie = D("Comment")->select($data);
        //print_r($rank_movie);exit;
        $this->assign('rank_movie',$rank_movie);
        $this->display();
    }
}
?> 