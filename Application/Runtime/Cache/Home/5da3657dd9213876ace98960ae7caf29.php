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
<section>
  <div class="container" style="width:100%;margin: 0px;">
    <div class="row">
		<div class="col-sm-3 col-md-3">
			<div class="plane">
				<h2 class="mu_txt">音&nbsp;&nbsp;&nbsp;乐</h2>
				<h2 class="mu_txt">心&nbsp;&nbsp;&nbsp;情</h2>
				<h2 class="mu_txt">生&nbsp;&nbsp;&nbsp;活</h2>
				<p>春风十里，暖阳，音乐文字旋律意境  和你...</p>
			</div>
	    </div>
	    <div class="col-sm-9 col-md-9">
	    	<h2 class="mu_tag">影视金曲</h2>
	        <ul class="musicWrap">
	        	<?php if(is_array($result['listMusic'])): $i = 0; $__LIST__ = $result['listMusic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$music): $mod = ($i % 2 );++$i;?><li>
						
						<a href="/index.php?c=music&a=detail&id=<?php echo ($music["id"]); ?>" data-active="playDwn" data-index="0" class="pc_temp_songname" title="<?php echo ($music["music_name"]); ?>" hidefocus="true"><?php echo ($music["music_name"]); ?></a>
						<span class="music_singer"><?php echo ($music["singer"]); ?></span>
						<span class="music_mv">【 <?php echo ($music["movie_name"]); ?> 】</span>
						<span class="music_time"><?php echo ($music["time_long"]); ?></span>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
	        	 <nav><ul style="margin-top: 20px; margin-bottom: 30px;" class="page_bottom"><?php echo ($pageres); ?></ul></nav>
	        </ul>	    	
	    </div>

 	</div>
  </div>
</section>
  
   </div>
    
  </body>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){
		var winH = $(window).height();
		var winW = $(window).width();
		$('.plane').height(winH);
		if(winW<960){
			$('.plane').hide();
		}
	})
</script>
</html>