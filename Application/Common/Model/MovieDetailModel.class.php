<?php
namespace Common\Model;
use Think\Model;

/**
 * 电影详情Detail model操作
 * @author 
 */
class MovieDetailModel extends Model {
    private $_db = '';

    public function __construct() {
        $this->_db = M('movie_detail');
    }
    public function insert($data=array()){
        if(!$data || !is_array($data)) {
            return 0;
        }
        //$data['create_time'] = time();
        if(isset($data['describle']) && $data['describle']) {
            $data['describle'] = htmlspecialchars($data['describle']);
        }
        if(isset($data['count']) && $data['count']) {
            $data['count'] = $data['count'];
        }
        if(isset($data['rank']) && $data['rank']) {
            $data['rank'] = $data['rank'];
        }
        if(isset($data['director']) && $data['director']) {
            $data['director'] = $data['director'];
        }
        if(isset($data['actors']) && $data['actors']) {
            $data['actors'] = $data['actors'];
        }
        

        return $this->_db->add($data);

    }
    public function find($id) {
        return $this->_db->where('movie_id='.$id)->find();
    }
    public function updateMvDetailById($id, $data) {
        if(!$id || !is_numeric($id) ) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        if(isset($data['describle']) && $data['describle']) {
            $data['describle'] = htmlspecialchars($data['describle']);
        }
        if(isset($data['count']) && $data['count']) {
            $data['count'] = $data['count'];
        }
        if(isset($data['rank']) && $data['rank']) {
            $data['rank'] = $data['rank'];
        }
        if(isset($data['actors']) && $data['actors']) {
            $data['actors'] = $data['actors'];
        }
        if(isset($data['director']) && $data['director']) {
            $data['director'] = $data['director'];
        }


        return $this->_db->where('movie_id='.$id)->save($data);
    }




}
