<?php
namespace Common\Model;
use Think\Model;

/**
 * 推荐位wmodel操作
 * @author  singwa
 */
class RankMovieModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('rank_movie');
	}

	public function select($data = array(),$limit=0) {

		if($data['movie_name']) {
			$data['movie_name'] = array('like', '%'.$data['movie_name'].'%');
		}
		$this->_db->where($data)->order('rank asc ,id desc');
		if($limit) {
			$this->_db->limit($limit);
		}
		$list = $this->_db->select();
		//echo $this->_db->getLastSql();exit;
		return $list;
		//print_r($list);
	}

	public function find($id) {
		$data = $this->_db->where('id='.$id)->find();
		return $data;
	}
    /**
    * 插入相关数据
    * @param  array  $data [description]
    * @return intval
    */
    public function insert($res=array()) {
    	if(!$res || !is_array($res)) {
    		return 0;
    	}
    	if(!$res['push_time']) {
    		$res['push_time'] = time();
    	}
		
    	return $this->_db->add($res);
    }

	/**
	 * 通过id更新的状态
	 * @param $id
	 * @param $status
	 * @return bool
	 */
	public function updateStatusById($id, $status) {
		if(!is_numeric($status)) {
			throw_exception("status不能为非数字");
		}
		if(!$id || !is_numeric($id)) {
			throw_exception("ID不合法");
		}
		$data['status'] = $status;
		return  $this->_db->where('id='.$id)->save($data); // 根据条件更新记录

	}

	public function updateById($id, $data) {

		if(!$id || !is_numeric($id)) {
			throw_exception("ID不合法");
		}
		if(!$data || !is_array($data)) {
			throw_exception('更新的数据不合法');
		}
		return  $this->_db->where('id='.$id)->save($data); // 根据条件更新记录
	}

	/**7 排序**/
	public function updateListorderById($id, $listorder) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }

        $data = array('listorder'=>intval($listorder));
        return $this->_db->where('id='.$id)->save($data);

    }

    //获取列表
  	public function getList($data,$page,$pageSize=10) {
        $conditions = $data;
        //模糊查询
        if(isset($data['movie_name']) && $data['movie_name']) {
            $conditions['movie_name'] = array('like','%'.$data['movie_name'].'%');
        }
        $conditions['status'] = array('neq',-1);

        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($conditions)
            ->order('listorder desc ,movie_id desc')
            ->limit($offset,$pageSize)
            ->select();

        return $list;

    }

    //获取总数
    public function getCount($data = array()){
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

     public function getRankMovieIn($rankIds) {
        if(!is_array($rankIds)) {
            throw_exception("参数不合法");
        }

        $data = array(
            'id' => array('in',implode(',', $rankIds)),
        );
       
        return $this->_db->where($data)->select();
    }
}
