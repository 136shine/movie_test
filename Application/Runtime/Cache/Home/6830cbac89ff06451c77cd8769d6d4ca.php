<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <meta name="viewport" content=""> -->
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <!-- <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href=""> -->

  <title>KM 酷影</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/sing/style.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/sing/animate.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <![endif]-->
</head>

<body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">KM</h1>
            </div>
            <h3>欢迎注册 KM</h3>
            <form class="m-t" role="form" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name='username'placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password"placeholder="密码" required="">
                </div>
                <button type="button" class="btn btn-primary full-width" onclick="register.check()">注册</button>
            </form>
       </div>
    </div>

<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/user/login.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
</body>
</html>