<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作
 * @author  singwa
 */
class ReviewModel extends Model {
    private $_db = '';

    public function __construct() {
        $this->_db = M('Review');
    }
    public function select($data = array(), $limit = 100) {

        $conditions = $data;
        $list = $this->_db->where($conditions)->order('time asc')->limit($limit)->select();
        return $list;
    }
   
    //添加
    public function insert($data = array()) {
        if(!is_array($data) || !$data) {
            return 0;
        }       
      
        return $this->_db->add($data);
    }

    //获取评论列表
  public function getCommentList($data,$page,$pageSize=10) {
        $conditions = $data;
        //模糊查询
        if(isset($data['movie_name']) && $data['movie_name']) {
            $conditions['movie_name'] = array('like','%'.$data['movie_name'].'%');
        }
       
        $conditions['status'] = array('neq',-1);

        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($conditions)
            ->order('listorder desc ,id desc')
            ->limit($offset,$pageSize)
            ->select();

        return $list;

    }

    //获取影评总数
    public function getCommentCount($data = array()){
        $conditions = $data;
        if(isset($data['movie_name']) && $data['movie_name']) {
            $conditions['movie_name'] = array('like','%'.$data['movie_name'].'%');
        }
        $conditions['status'] = array('neq',-1);

        return $this->_db->where($conditions)->count();
    }
    //通过ID查找数据
    public function find($id) {
        $data = $this->_db->where('movie_id='.$id)->find();
        return $data;
    }
    //通过ID更新数据
    public function updateById($id, $data) {
        if(!$id || !is_numeric($id) ) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新数据不合法');
        }

        return $this->_db->where('id='.$id)->save($data);
    }

   //修改status来删除数据
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        $data['status'] = $status;

        return $this->_db->where('id='.$id)->save($data);
    }
    //更新排序
    public function updateCommListorderById($id, $listorder) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        $data = array('listorder'=>intval($listorder));
        return $this->_db->where('id='.$id)->save($data);
    }

    public function getMovieByCommIdIn($commIds) {
        if(!is_array($commIds)) {
            throw_exception("参数不合法");
        }

        $data = array(
            'id' => array('in',implode(',', $commIds)),
        );
       
        return $this->_db->where($data)->select();
    }


}
