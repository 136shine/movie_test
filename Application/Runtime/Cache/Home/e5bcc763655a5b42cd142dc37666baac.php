<?php if (!defined('THINK_PATH')) exit(); session_start(); <!-- $config = D("Basic")->select(); --> $navs = D("Menu")->getBarMenus(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" content="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/Public/css/home/main.css" type="text/css" />
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
      <ul class="nav navbar-nav">
        <li><a href="/" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
        <li><a href="/index.php?c=movie&a=view" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>电影推荐</a></li>
        <li><a href="/index.php?c=movie&a=view" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>影视金曲</a></li>
        <li><a href="/index.php?c=comment" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>影评</a></li>
       <!--  <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=cat&id=<?php echo ($vo["menu_id"]); ?>" <?php if($vo['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?> -->
      </ul>
      <ul class="nav navbar-right user-nav nav-com" <?php if($_SESSION['user'] == null): ?>style="display:none;"<?php endif; ?>>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php if(isset($_SESSION['user'])||!$_SESSION['user']) echo $_SESSION['user']['username']; ?> <b class="caret"></b></a>
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
        <a href="/index.php?c=user"><button type="button" class="btn btn-default">注册</button></a>
        <a href="/index.php?c=user&a=login"><button type="button" class="btn btn-default">登录</button></a> 
      </div>
    </div>
  </div>
</header>
 <div class="row">
        <span class="per-set col-lg-12 col-md-12 col-sm-12">账户设置</span>
        <div class="col-sm-offset-2 col-lg-8 col-md-8 col-sm-8" style="border:1px solid #ccc;">
      
          <form class="form-horizontal" id="personal-form">
            <div class="form-group avator">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">头像</label>
              <div class="col-sm-6">
                
                <img id="upload_org_code_img" <?php if(($user["pic"] != '')): ?>src="<?php echo ($user["pic"]); ?>"<?php else: ?>src="/Public/images/user_pic.png"<?php endif; ?> width="120" height="120">
                <input id="file_upload" class="avator_person" type="file" multiple="true" >
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
                <input id="sex" name="sex" type="radio" value="男" <?php if(($user["sex"] == 0)): ?>checked="true"<?php endif; ?> /><span>男</span>
                <input id="sex" name="sex" type="radio" value="女" <?php if(($user["sex"] == 1)): ?>checked="true"<?php endif; ?> /><span>女</span>
              </div>
            </div>
            
             <div class="form-group">
              <label for="inputname" class="col-sm-2 col-sm-offset-2 control-label">手机号</label>
              <div class="col-sm-6">
                <input type="text" name="phone" class="form-control" id="inputname" value="<?php echo ($user["phone"]); ?>">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-12" style="text-align:center;">
                <button type="button" class="btn btn-default" id="singcms-button-submit">提交</button>
              </div>
            </div>
          </form>
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
    'save_url' : '/index.php?c=user&a=add',
    'jump_url' : '/index.php',
    'ajax_upload_image_url' : '/admin.php?c=image&a=ajaxuploadimage',
    'ajax_upload_swf' : '/Public/js/party/uploadify.swf',
  };

</script>
<script src="/Public/js/admin/image.js"></script>
</html>