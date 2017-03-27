<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class CommentController extends CommonController {
    public function index(){

        $listcom = D("Comment")->select(array('status'=>1),12);
  //       public function cnsubstr($str,$strlen=10) {
		// 	if(empty($str)||!is_numeric($strlen)){
		// 		return false;
		// 	}
		// 	if(strlen($str)<=$strlen){
		// 		return $str;
		// 	}
		// }
  //       $listcom[smallCon] = $listcom['content'];
       
       $this->assign('result', array(
            'listcom' => $listcom,
        ));
        
        $this->display();
    }
    public function detail(){
        $id = intval($_GET['id']);
        
        $listcom = D("Comment")->find($id);
        $this->assign('listcom' , $listcom );
        
        $this->display();
    }
}