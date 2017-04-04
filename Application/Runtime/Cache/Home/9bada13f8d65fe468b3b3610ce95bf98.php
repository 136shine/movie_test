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
<body style="background-color: rgb(245,245,245);">
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="/">
          <img src="/Public/images/logo.png" alt="KM-logo">
        </a>
      </div>
      <ul class="nav navbar-nav nav-top">
        <li><a href="/">首页</a></li>
        <!-- <li><a href="/index.php?c=movie">电影推荐</a></li>
        <li><a href="/index.php?c=movie">影视金曲</a></li>
        <li><a href="/index.php?c=comment">影评</a></li> -->
        <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=<?php echo ($vo["c"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
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
  <script type="text/javascript">
    $(function(){
      var url = window.location.href,i = 0;      
      var urlName = url.split('c=')[1];
      
      switch(urlName){
        case 'movie': i = 1;break;
        case 'music': i = 2;break;
        case 'comment': i = 3;break;
        case '': i = 0;break;
      }
      $('.nav-top li').eq(i).children('a').addClass('curr').parent().siblings('li').children('a').removeClass('curr');
    })
  </script>
<div class="com_wrap clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-9">
				<div class="top_com">
					<?php if(is_array($result['topCom'])): $i = 0; $__LIST__ = $result['topCom'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><img src="<?php echo ($v["big_pic"]); ?>" />
					<p><a href="/index.php?c=comment&a=detail&id=<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></a><span><img src="/Public/images/icon_prince.png">最佳影评</span></p><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="comment">
					<span class="com_tag"> >> 新片影评</span>
					<?php if(is_array($result['listcom'])): $i = 0; $__LIST__ = $result['listcom'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="com_dl clearfix">
			                <dt class="com_l fL">
			                    <a><img class="com_avator" <?php if(($vo["avator"] != '')): ?>src="<?php echo ($vo["avator"]); ?>"<?php else: ?>src="/Public/images/com_avator.png"<?php endif; ?> alt="影评人头像"></a>
			                    <a class="com_name"><?php echo ($vo["author"]); ?></a>
			                </dt>                
			                <dd class="com_c fL">
			                    <p class="com_title"><a href="/index.php?c=comment&a=detail&id=<?php echo ($vo["id"]); ?>" title="<?php echo ($re["title"]); ?>"><?php echo ($vo["title"]); ?></a></p>
			                    <p><?php echo (msubstr(strip_tags(htmlspecialchars_decode(trim($vo["content"]))),0,50)); ?></p>
			                    
			                </dd>
			               
			            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<nav><ul class="page_bottom"><?php echo ($pageres); ?></ul></nav>
			</div>
			 <!--网站右侧信息-->
	      	<div class="sider col-sm-3 col-md-3 col-xs-3">
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
	</div>  
</div>

</body>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
</html>