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
  <div class="container" style="width:100%;margin: 0px;overflow: hidden;">
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
	    	<div class="music_info clearfix">
	    		<div class="singer_img">
		    		<img src="<?php echo ($listmu["pic"]); ?>" alt="歌手">
		    		<p>歌曲：<?php echo ($listmu["music_name"]); ?></p>
		    		<p>歌手：<?php echo ($listmu["singer"]); ?></p>
		    	</div>

		    	<!-- <div class="songWordContent songWordContentM jspScrollable" style="height: 330px; overflow: hidden; padding: 0px; width: 460px;" tabindex="0">
		    		<div class="jspContainer" style="width: 460px; height: 330px;">
		    			<div class="jspPane" style="padding: 0px; top: 0px; width: 448px;">
		    				<?php echo ($listmu["content"]); ?>
		    			</div>
		    			<div class="jspVerticalBar">
		    				<div class="jspCap jspCapTop"></div>
		    				<div class="jspTrack" style="height: 330px;">
		    					<div class="jspDrag" style="height: 60px; top: 0px;">
		    						<div class="jspDragTop"></div>
		    						<div class="jspDragBottom"></div>
		    					</div>
		    				</div>
		    				<div class="jspCap jspCapBottom"></div>
		    			</div>
		    		</div>
		    	</div> -->
		    	<div class="lyrics">
		    		<!-- <p class=""><?php echo ($listmu["music_name"]); ?></p> -->
		    		<p style="display: none;"><?php echo ($listmu["content"]); ?></p>
		    	</div>
	    	</div>
	    	
	    	<div class="play">
				<audio id="myaudio" controls="controls">
		            <source src="http://fs.web.kugou.com/468bb9a95133175acce9cb2c895540e6/58e341b8/G085/M07/07/18/NZQEAFh121aAELTiAD7hf0CT2eQ805.mp3">
		        </audio>
		    </div>
	
	    </div>
 	</div>
  </div>
</section>
 </body>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){
		var winH = $(window).height();
		$('.plane').height(winH);

		var str = $('.lyrics p').text();
		var s=str.replace(/\[.*\]/g,"\n");

		$('.lyrics').html("<div class='lyrics_wrap'><pre>"+s+"</pre></div>");

		function play(){
			var iTop = $('pre').offset().top;
			$('pre').offset({'top':iTop-60});
		}
		var timer = null;
		var myaudio = document.getElementById('myaudio');
		
			myaudio.onpause = function(){
				clearInterval(timer);
			}
			myaudio.onplay = function(){
				timer = setInterval(play,4000);
			}
		


	})
</script>
</html>