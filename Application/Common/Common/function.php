<?php

/**
 * 公用的方法
 */

function  show($status, $message,$data=array()) {
    $reuslt = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );

    exit(json_encode($reuslt));
}
function getMd5Password($password) {
    return md5($password . C('MD5_PRE'));
}
function getMenuType($type) {
    return $type == 1 ? '后台菜单' : '前端导航';
}
function status($status) {
    if($status == 0) {
        $str = '关闭';
    }elseif($status == 1) {
        $str = '正常';
    }elseif($status == -1) {
        $str = '删除';
    }
    return $str;
}
function sex($sex) {
    if($sex == 0) {
        $str = '男';
    }elseif($sex == 1) {
        $str = '女';
    }
    return $str;
}
function getAdminMenuUrl($nav) {
    $url = '/admin.php?c='.$nav['c'].'&a='.$nav['a'];
    if($nav['f']=='index') {
        $url = '/admin.php?c='.$nav['c'];
    }
    return $url;
}
function getActive($navc){
    $c = strtolower(CONTROLLER_NAME);
    if(strtolower($navc) == $c) {
        return 'class="active"';
    }
    return '';
}
function showKind($status,$data) {
    header('Content-type:application/json;charset=UTF-8');
    if($status==0) {
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
    exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}
function getLoginUsername() {
    return $_SESSION['adminUser']['username'] ? $_SESSION['adminUser']['username']: '';
}
function getCatName($navs, $id) {
    foreach($navs as $nav) {
        $navList[$nav['menu_id']] = $nav['name'];
    }
    return isset($navList[$id]) ? $navList[$id] : '';
}
function getCopyFromById($id) {
    $copyFrom = C("COPY_FROM");
    return $copyFrom[$id] ? $copyFrom[$id] : '';
}
function getMovieTypeByKey($key) {
    $movietype = C("MOVIE_TYPE");
    return $movietype[$key] ? $movietype[$key] : '';
}
function getMovieType($key) {
    $type = '';
    switch($key){
        case 1: $type = '动作';break;
        case 2: $type = '喜剧';break;
        case 3: $type = '悬疑';break;
        case 4: $type = '科幻';break;
        case 5: $type = '爱情';break;
        case 6: $type = '恐怖';break;
        case 7: $type = '其他';break;
    }
    return $type;
}
function isThumb($thumb) {
    if($thumb) {
        return '<span style="color:red">有</span>';
    }
    return '无';
}
function unhtml($content)                                        //定义自定义函数的名称
 {
    // $content=htmlspecialchars($content);                        //五个特殊字符转成html字符表示，显示效果仍不变
    $content=str_replace("@","",$content);                        //替换文本中的换行符,(但是不知道替换什么符号为空)
   return trim($content);                                        //删除文本中首尾的空格
 } 


    function cutstr_html($string,$length=0,$ellipsis='…'){
          $string=strip_tags($string);
          $string=preg_replace('/\n/is','',$string);
          $string=preg_replace('/ |　/is','',$string);
          $string=preg_replace('/&nbsp;/is','',$string);
          preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);
          if(is_array($string)&&!empty($string[0])){
              if(is_numeric($length)&&$length){
                  $string=join('',array_slice($string[0],0,$length)).$ellipsis;
              }else{
                  $string=implode('',$string[0]);
              }
          }else{
              $string='';
          }
          return $string;
    }

    function cutstr ($data, $no, $le = '...') {
    $data = strip_tags(htmlspecialchars_decode($data));
    $data = str_replace(array("\r\n", "\n\n", "\r\r", "\n", "\r"), '', $data);
    $datal = strlen($data);
    $str = msubstr($data, 0, $no);
    $datae = strlen($str);
    if ($datal > $datae)
        $str .= $le;
    return $str;
}
/**
+----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
+----------------------------------------------------------
 * @static
 * @access public
+----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{   
    // $str = trim($str);
    $len = substr($str);
    if(function_exists("mb_substr")){
        if($suffix)
            return mb_substr($str, $start, $length, $charset)."...";
        else
            return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
        if($suffix && $len>$length)
            return iconv_substr($str,$start,$length,$charset)."...";
        else
            return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));

    if($suffix) return $slice."…";

    return $slice;

}





