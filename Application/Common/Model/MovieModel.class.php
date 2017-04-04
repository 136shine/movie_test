<?php
namespace Common\Model;
use Think\Model;

/**
 * 电影model操作
 * @author  ada
 */
class MovieModel extends Model {
    private $_db = '';

    public function __construct() {
        $this->_db = M('movie');
    }
  
    public function select($data = array(), $order = '', $limit = 100) {

        $conditions = $data;
        $list = $this->_db->where($conditions)->order($order)->limit($limit)->select();
        return $list;
    }
    //添加
    public function insert($data = array()) {
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['movie_name'] = $_POST['movie_name'];
        $data['movie_type'] = $_POST['movie_type'];
        $data['grade'] = $_POST['grade'];
        $data['up_time'] = $_POST['up_time'];
        $data['pic'] = $_POST['pic'];
        $data['big_pic'] = $_POST['big_pic'];
        return $this->_db->add($data);
    }

    //获取电影列表
  public function getMovieList($data,$page,$pageSize=10,$rankType='listorder desc ,movie_id desc') {
        $conditions = $data;
        //模糊查询
        if(isset($data['movie_name']) && $data['movie_name']) {
            $conditions['movie_name'] = array('like','%'.$data['movie_name'].'%');
        }
        if(isset($data['movie_type']) && $data['movie_type'])  {
            $conditions['movie_type'] = intval($data['movie_type']);
        }
        $conditions['status'] = array('neq',-1);

        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($conditions)
            ->order($rankType)
            ->limit($offset,$pageSize)
            ->select();

        return $list;

    }

    //获取电影总数
    public function getMovieCount($data = array()){
        $conditions = $data;
        if(isset($data['movie_name']) && $data['movie_name']) {
            $conditions['movie_name'] = array('like','%'.$data['movie_name'].'%');
        }
        if(isset($data['movie_type']) && $data['movie_type'])  {
            $conditions['movie_type'] = $data['movie_type'];
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

        return $this->_db->where('movie_id='.$id)->save($data);
    }

    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        $data['status'] = $status;

        return $this->_db->where('movie_id='.$id)->save($data);
    }
    //更新排序
    public function updateMvListorderById($id, $listorder) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        $data = array('listorder'=>intval($listorder));
        return $this->_db->where('movie_id='.$id)->save($data);
    }

    public function getMovieByMovieIdIn($movieIds) {
        if(!is_array($movieIds)) {
            throw_exception("参数不合法");
        }

        $data = array(
            'movie_id' => array('in',implode(',', $movieIds)),
        );
       
        return $this->_db->where($data)->select();
    }


}
