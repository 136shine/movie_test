<?php if (!defined('THINK_PATH')) exit(); session_start(); $config = D("Basic")->select(); $navs = D("Menu")->getBarMenus(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" content="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/Public/css/home/main.css" type="text/css" />
  <script type="text/javascript" src="/Public/js/jquery.js"></script>

</head>
<body>
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="/">
          <img src="/Public/images/logo.png" alt="KM-logo">
        </a>
      </div>
      <ul class="nav navbar-nav nav-top">
        <li><a class="curr" href="/">首页</a></li>
        <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=<?php echo ($vo["c"]); ?>&a=index"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
      <ul class="nav navbar-right user-nav nav-com" <?php if($_SESSION['user'] == null): ?>style="display:none;"<?php endif; ?>>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo ($user['pic']); ?>"><i class="fa fa-user"></i>  <?php if(isset($_SESSION['user'])||!$_SESSION['user']) echo $_SESSION['user']['username']; ?><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="/index.php?c=user&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="/index.php?c=user&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
            </li>
          </ul>
        </li>
      </ul>
      
      <div class="nav navbar-nav navbar-right nav-com" <?php if($_SESSION['user'] != null): ?>style="display:none;"<?php endif; ?>>
        <a class="btn btn_reg" href="/index.php?c=user"><span>注册</span></a>
        <a class="btn btn_log" href="/index.php?c=user&a=login"><span>登录</span></a> 
      </div>
    </div>
  </div>
</header>
  <script type="text/javascript">
    $(function(){
      var url = window.location.href,i = 0;      
      var urlName = url.split('c=')[1].split('&')[0];
      
      switch(urlName){
        case 'movie': case 'movie_detail':case 'Movie': i = 1;break;
        case 'music': case 'Music':i = 3;break;
        case 'comment':case 'Comment': i = 2;break;
        case '': i = 0;break;
      }
      $('.nav-top li').eq(i).children('a').addClass('curr').parent().siblings('li').children('a').removeClass('curr');
    })
  </script>
<div class="containter" style="background-color: #F4F4F4;">
   <div class="row">
        <span class="per-set col-sm-offset-2 col-lg-8 col-md-8 col-sm-8" style="background-color: #fff;">账户设置</span>
        <div class="col-sm-offset-2 col-lg-8 col-md-8 col-sm-8" style="background-color: #fff;padding-bottom: 80px;">
      
          <form class="form-horizontal" id="singcms-form">
            <div class="form-group avator">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label" style="padding-top: 50px;">头像</label>
              <div class="col-sm-6">
                
                <img id="upload_org_code_img" <?php if(($user["pic"] != '')): ?>src="<?php echo ($user["pic"]); ?>"<?php else: ?>src="/Public/images/user_pic.png"<?php endif; ?> width="120" height="120">
                <input id="file_upload" class="avator_person" type="file" multiple="true" >
                <input id="file_upload_image" name="pic" type="hidden" multiple="true"<?php if(($user["pic"] != '')): ?>value="<?php echo ($user["pic"]); ?>"<?php else: ?>value="/Public/images/user_pic.png"<?php endif; ?>>
              </div>
            </div>
           
            <div class="form-group">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">用户名</label>
              <div class="col-sm-6">
                <input type="text" name="username" class="form-control" id="inputname" value="<?php echo ($user["username"]); ?>">
              </div>
            </div>
            
             <div class="form-group">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">邮箱</label>
              <div class="col-sm-6">
                <input type="text" name="email" class="form-control" id="inputname" value="<?php echo ($user["email"]); ?>">
              </div>
            </div>

            <div class="form-group sex">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">性别</label>
              <div class="col-sm-6">
                <input id="sex" name="sex" type="radio" value="0" <?php if(($user["sex"] == 0)): ?>checked="true"<?php endif; ?> /><span>男</span>
                <input id="sex" name="sex" type="radio" value="1" <?php if(($user["sex"] == 1)): ?>checked="true"<?php endif; ?> /><span>女</span>
              </div>
            </div>
            
             <div class="form-group">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">手机号</label>
              <div class="col-sm-6">
                <input type="text" name="phone" class="form-control" id="inputname" value="<?php echo ($user["phone"]); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">喜欢的电影类型</label>     
              <div class="col-sm-6">
                 <select class="form-control" name="movie_type">
                  <option value="">--请选择类型--</option>    
                  <option value="1">动作</option>
                  <option value="2">喜剧</option>
                  <option value="3">悬疑</option>
                  <option value="4">科幻</option>
                  <option value="5">爱情</option>
                  <option value="6">恐怖</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-lg-8 col-md-8 col-sm-8" style="text-align: right;margin-top: 20px;">
                <button type="button" style="padding:5px 30px;background-color: #F9AE4C; font-size: 22px;color: #fff;" class="btn btn-default" id="singcms-button-submit">提交</button>
              </div>
            </div>
          </form>
        </div>
 </div>
</div>

</body>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/dialog/layer.js"></script>
<script type="text/javascript" src="/Public/js/dialog.js"></script>
<script type="text/javascript" src="/Public/js/party/jquery.uploadify.js"></script>

<script>
  var SCOPE = {
    'save_url' : '/index.php?c=user&a=personal',
    'jump_url' : '/index.php',
    'ajax_upload_image_url' : '/admin.php?c=image&a=ajaxuploadimage',
    'ajax_upload_swf' : '/Public/js/party/uploadify.swf',
  };

</script>
<script type="text/javascript">
  $(function(){
    var winH = $(window).height();
    $('.containter').height(winH);
  })
</script>
<script type="text/javascript" src="/Public/js/admin/common.js"></script>
<script type="text/javascript" src="/Public/js/admin/image.js"></script>
</html>