<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

/**
* 
*/
class MusicController extends CommonController 
{
	
	public function index($value='')
	{
		$conds['status'] = array('neq',-1);
    	$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 8;

        $music = D("Music")->getList($conds,$page,$pageSize);
        $count = D("Music")->getCount($conds);

        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();

        $this->assign('pageres',$pageres);

        $this->assign('result', array(
            'music' => $music,
        ));
        
        $this->display();
	}


	 public function add(){
        if($_POST) {
            if(!isset($_POST['music_name']) || !$_POST['music_name']) {
                return show(0,'歌名不存在');
            }
            if(!isset($_POST['movie_name']) || !$_POST['movie_name']) {
                return show(0,'电影名不存在');
            }
            if(!isset($_POST['singer']) || !$_POST['singer']) {
                return show(0,'评分不存在');
            }
            if(!isset($_POST['time_long']) || !$_POST['time_long']) {
                return show(0,'时长不存在');
            }
            if($_POST['id']) {
                return $this->save($_POST);
            }
            D("Music")->insert($_POST);

            return show(1,'新增成功');
        }else {
            $this->display();
        }
    }

    public function edit() {
        $musicId = $_GET['id'];//获取地址栏中带过来的id
        if(!$musicId) {
            // 执行跳转
            $this->redirect('/admin.php?c=music');
        }
        $music = D("Music")->find($musicId);
        if(!$music) {
            $this->redirect('/admin.php?c=music');
        }
        

        $webSiteMenu = D("Menu")->getBarMenus();
        $this->assign('webSiteMenu', $webSiteMenu);
        $this->assign('music',$music);
        $this->display();
    }

    public function save($data) {
        $musicId = $data['id'];
        unset($data['id']);

        try {
            $id = D("Music")->updateById($musicId, $data);            
            if($id === false) {
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
                $res = D("Music")->updateStatusById($id, $status);

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
                foreach ($listorder as $musicId => $v) {
                    // 执行更新
                    $res = D("Music")->updateMvListorderById($musicId, $v);
                    //print_r($id);

                    if ($res === false) {
                        $errors[] = $musicId;//更新失败的id存入数组
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

    public function batchDel() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $musicId = $_POST;
       
        if(!$musicId || !is_array($musicId)) {
            return show(0, '请选择推荐歌曲ID进行批量删除');
        }
       
        try {
                $Music = D("Music")->getMusicIn($musicId);
                if (!$Music) {
                    return show(0, '没有相关内容');
                }
                
                foreach ($Music as $new) {
                    $data = array(
                        'id' => $new['id'],
                    );
                  	$id = $data['id']; 
    	            if (!$id) {
    	                return show(0, 'ID不存在');
    	            }
    	            $res = D("Music")->updateStatusById($id, -1);
                } 
            }catch(Exception $e) {
                return show(0, $e->getMessage());
            }

        return show(1, '删除成功',array('jump_url'=>$jumpUrl));


    }
}