<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KM后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/Public/css/sing/common.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/admin/main.css">
    <link rel="stylesheet" href="/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/dialog/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <script src="/Public/js/kindeditor/kindeditor-all-min.js"></script>
    <script type="text/javascript" src="/Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>
<div id="wrapper">

  <?php
 $navs = D("Menu")->getAdminMenus(); $username = getLoginUsername(); foreach($navs as $k=>$v) { if($v['c'] == 'admin' && $username != 'admin') { unset($navs[$k]); } } $index = 'index'; ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >酷影电影推荐管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo getLoginUsername()?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getActive($index)); ?>>
        <a href="/admin.php"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navo): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($navo["c"])); ?>>
        <a href="<?php echo (getAdminMenuUrl($navo)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i> <?php echo ($navo["name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>
  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">

          <ol class="breadcrumb">
            <li>
              <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=movie">电影管理</a>
            </li>
            <li class="active">
              <i class="fa fa-edit"></i> 电影修改
            </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-lg-6">

          <form class="form-horizontal" id="singcms-form">
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">电影名称:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["movie_name"]); ?>" type="text" name="movie_name" class="form-control" id="inputname">
              </div>
            </div>
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">上映时间:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["up_time"]); ?>" type="text" name="up_time" class="form-control" id="inputname">
              </div>
            </div>
                       
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">类型:</label>
              <div class="col-sm-5">
                  <select class="form-control" name="movie_type">
                    <?php if(is_array($movieType)): foreach($movieType as $key=>$mvType): ?><option value="<?php echo ($key); ?>" <?php if($key == $movie['movie_type']): ?>selected="selected"<?php endif; ?>><?php echo ($mvType); ?></option><?php endforeach; endif; ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">评分:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["grade"]); ?>" type="text" name="grade" class="form-control" id="inputname">
              </div>
            </div>

            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">排名:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["rank"]); ?>" type="text" name="rank" class="form-control" id="inputname">
              </div>
            </div>
             <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">票房数:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["count"]); ?>" type="text" name="count" class="form-control" id="inputname">
              </div>
            </div>
             <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">主演:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["actors"]); ?>" type="text" name="actors" class="form-control" id="inputname">
              </div>
            </div>
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">导演:</label>
              <div class="col-sm-5">
                <input value="<?php echo ($movie["director"]); ?>" type="text" name="director" class="form-control" id="inputname">
              </div>
            </div>
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">缩图:</label>
              <div class="col-sm-5">
                <input id="file_upload" type="file" multiple="true" >
                <img id="upload_org_code_img" src="<?php echo ($movie["pic"]); ?>" width="150" height="150">
                <input id="file_upload_image" name="pic" type="hidden" multiple="true" value="<?php echo ($movie["pic"]); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">大图:</label>
              <div class="col-sm-5">
                <input id="img_upload" class="img_upload" type="file" multiple="true" >
                <img id="upload_org_big_pic" src="<?php echo ($movie["big_pic"]); ?>" width="300" height="150">
                <input id="file_upload_big_pic" name="big_pic" type="hidden" multiple="true" value="<?php echo ($movie["big_pic"]); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputname" class="col-sm-2 control-label">描述:</label>
              <div class="col-sm-5">
                <textarea class="input js-editor" id="editor_content" name="describle" rows="25" ><?php echo ($movie["describle"]); ?></textarea>
              </div>
            </div>
         
            <input value="<?php echo ($movie["movie_id"]); ?>" type="hidden" name="movie_id" class="form-control">

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" id="singcms-button-submit">提交</button>
              </div>
            </div>
          </form>


        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<script>
  var SCOPE = {
    'save_url' : '/admin.php?c=movie&a=add',
    'jump_url' : '/admin.php?c=movie',
    'ajax_upload_image_url' : '/admin.php?c=image&a=ajaxuploadimage',
    'ajax_upload_swf' : '/Public/js/party/uploadify.swf',
  };

</script>
<!-- /#wrapper -->
<script src="/Public/js/admin/image.js"></script>
<script>
  // 6.2
  KindEditor.ready(function(K) {
    window.editor = K.create('#editor_content',{
      uploadJson : '/admin.php?c=image&a=kindupload',
      afterBlur : function(){this.sync();}, //
    });
  });
</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>