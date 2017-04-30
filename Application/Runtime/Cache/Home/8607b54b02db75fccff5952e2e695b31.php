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
		    		<div class="pic"><img src="<?php echo ($listmu["pic"]); ?>" alt="歌手"></div>
		    		<p>歌曲：<?php echo ($listmu["music_name"]); ?></p>
		    		<p>歌手：<?php echo ($listmu["singer"]); ?></p>

		    		<div class="play">
						<audio id="myaudio" controls="controls">
				            <source src="<?php echo ($listmu["url"]); ?>">
				        </audio>
				    </div>
		    		<!-- <div class="in_after"></div> -->
		    	</div>

		    	<div class="lyrics">
		    		<!-- <p class=""><?php echo ($listmu["music_name"]); ?></p> -->
		    		<p style="display: none;"><?php echo ($listmu["content"]); ?></p>
					
		    	</div>

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

		$('.lyrics').html("<div class='lyrics_wrap'><pre>"+s+"</pre></div><a class='con_open' style='display: block;text-align:left;text-indent:50px; color:blue; cursor:pointer;'>展开 <img src='/Public/images/arrow_down.png' /></a>");

		function play(){
			// var iTop = $('pre').offset().top;
			// $('pre').offset({'top':iTop-60});
			$('.pic').addClass('active');
		}
		var timer = null;
		var myaudio = document.getElementById('myaudio');
		
			myaudio.onpause = function(){
				// clearInterval(timer);
				$('.pic').removeClass('active');
			}
			myaudio.onplay = function(){
				play();
				// timer = setInterval(play,6000);
			}

		var iTop = $('pre').offset().top;
		var iNow = 0;

			$('.con_open').click(function(){
				if (iNow === 0) {
					iNow++;
					var preH = $('pre').height();
					$('.lyrics_wrap').css({'overflow':'visible','height':(preH+30)+'px'});
					$(this).attr('class','con_close');
					$(this).html("收起 <img src='/Public/images/arrow_up.png' />");
				}else{
					iNow--; 
					console.log("asd"+iNow);
					
					$('.lyrics_wrap').css({'overflow':'hidden','height':'400px'});
					
					$(this).html("展开 <img src='/Public/images/arrow_down.png' />");
				}
			});

			
				
			
	})
</script>
</html>