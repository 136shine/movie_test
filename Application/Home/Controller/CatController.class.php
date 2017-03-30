<?php
namespace Home\Controller;
use Think\Controller;
class CatController extends CommonController {
    public function index(){
        // $id = intval($_GET['id']);
        // if(!$id) {
        //     return $this->error('ID不存在');
        // }

        // $nav = D("Menu")->find($id);
        // if(!$nav || $nav['status'] !=1) {
        //     return $this->error('栏目id不存在或者状态不为正常');
        // }
       

        // $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        // $pageSize = 20;
        // $conds = array(
        //     'status' => 1,
        //     'thumb' => array('neq', ''),
        //     'catid' => $id,
        // );
       
        // $res  =  new \Think\Page($count,$pageSize);
        // $pageres = $res->show();

        // $this->assign('result', array(
            
        //     'catId' => $id,
        //     'pageres' => $pageres,
        // ));
        // $this->display();
    }
    
}