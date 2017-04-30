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
<div class="com_wrap clearfix">
	<div class="container">
  	<div class="row">
  		<div class="comment-detail col-md-9 col-sm-9 col-xs-9">
  			<section class="reviDetL leftWp fL">
  		    <section class="location">
          	&gt;&gt;&nbsp;&nbsp;<a title="影评">影评</a>&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;<?php echo ($result['com']["title"]); ?>
          </section>
    		  <section class="titleBox">
        	  <div class="cont">
            	<h1><?php echo ($result['com']["title"]); ?></h1>
                <div class="title-info clearfix">
                	<span>作者&nbsp;&nbsp;<a><?php echo ($result['com']["author"]); ?></a>&nbsp;&nbsp;评论&nbsp;&nbsp;<a><?php echo ($result['com']["movie_name"]); ?></a>&nbsp;&nbsp;时间 &nbsp;&nbsp;<a><?php echo ($result['com']["time"]); ?></a></span>
                </div>
            </div>   
          </section>        
    		  <section class="comCont">
      			<p style="text-indent: 0;"><?php echo ($result['com']["content"]); ?></p>
      		</section>
        </section>
  		</div>
       <!--网站右侧信息-->
      <div class="col-sm-3 col-md-3">
          <div class="rank-title">
    <h3>影评推荐</h3>
    <span>Movie Recomment</span>
  </div>

  <div class="rank-content">
    <ul>
      <?php if(is_array($result['rankCom'])): $k = 0; $__LIST__ = $result['rankCom'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li style="margin-bottom: 10px;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">
        <a href="/index.php?c=comment&a=detail&id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
      </div>

  	</div>
  </div>
</div>

<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $('p').children('img').parent().css('text-align','center');
    $('p').children('span').parent().css('text-indent','0em');
  })
</script>
</body>
</html>