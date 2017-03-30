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
<div class="com_wrap clearfix">
	<div class="container">
	<div class="row">
		<div class="comment-detail col-md-9 col-sm-9 col-xs-9">
			<section class="reviDetL leftWp fL">
		<section class="location">
        	<!-- 当前位置：<a href="http://www.51oscar.com" title="首页" target="_blank"><img src="/Images/location_ind.png" alt="大众影评网" style="vertical-align:text-bottom;"></a> -->&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;<a title="影评">影评</a>&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;<?php echo ($listcom["title"]); ?>

        </section>
		<section class="titleBox">
    	<div class="cont">
        	<h1><?php echo ($listcom["title"]); ?></h1>
            <div class="title-info clearfix">
            	<span>作者&nbsp;&nbsp;<a><?php echo ($listcom["author"]); ?></a>&nbsp;&nbsp;评论&nbsp;&nbsp;<a><?php echo ($listcom["movie_name"]); ?></a>&nbsp;&nbsp;时间 &nbsp;&nbsp;<a><?php echo ($listcom["time"]); ?></a></span>
            </div>
        </div>   
    </section>        
		<section class="comCont">
			<p><?php echo ($listcom["content"]); ?></p>
		</section>
    </section>
		</div>
	</div>
</div>
  <!--网站右侧信息-->
  <div class="col-sm-3 col-md-3">
      <div class="right-title">
    <h3>电影排行</h3>
    <span>TOP MOVIE</span>
  </div>

  <div class="right-content">
    <ul>
      <?php if(is_array($result['rankMovies'])): $k = 0; $__LIST__ = $result['rankMovies'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
        <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["movie_id"]); ?>"><?php echo ($vo["movie_name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <!-- <?php if(is_array($result['advNews'])): $k = 0; $__LIST__ = $result['advNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="right-hot">
    <a target="_blank" href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a>
  </div><?php endforeach; endif; else: echo "" ;endif; ?> -->

  </div>
</div>

<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $('p').children('img').parent().css('text-align','center');
  })
</script>
</body>
</html>