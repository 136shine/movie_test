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
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
              <!-- <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li> -->
          </ol>
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
<!--                 <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li> -->
            </ol>
           
            <div class="carousel-inner" role="listbox">
              <?php if(is_array($result['topPic'])): $i = 0; $__LIST__ = $result['topPic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
                    <a href="/index.php?c=movie_detail&id=<?php echo ($vo["movie_id"]); ?>"><img width="100%" src="<?php echo ($vo["big_pic"]); ?>" alt="<?php echo ($vo["movie_name"]); ?>"></a>
                    <div class="carousel-caption">
                    <?php echo ($vo["movie_name"]); ?>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>  
               
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">上一张</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">下一张</span>
            </a>
          </div>
        </div>
      </div>
      
    </div>
    <div class="row">
      <!-- <div class="col-sm-9 col-md-9 home_tag"></div> -->
      <div class="col-sm-9 col-md-9">
          <div class="home_tag"><div class="line" style="left:10px;"></div><span>精彩推荐</span><div class="line" style="right:10px;"></div></div>
          <div class="news-list">
            <?php if(is_array($result['listMovies'])): $i = 0; $__LIST__ = $result['listMovies'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="wrap col-md-3 col-sm-4">
                <div class="movie_pic"><a target="_blank" href="/index.php?c=movie_detail&id=<?php echo ($vo["movie_id"]); ?>" style="background:url(<?php echo ($vo["pic"]); ?>) no-repeat center; background-size: 100% 100%;" ><span class="grade"><?php echo ($vo["grade"]); ?></span></a></div>
                <div class="ms">
                  <span class="movie_name"><?php echo ($vo["movie_name"]); ?></span>                  
                  <!-- <span class="type"><?php echo (getMovieType($vo["movie_type"])); ?></span> -->
                  
                </div>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
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
</section>
</body>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
  //轮播显示
  $(function(){
    $('body').css('background-color', '#fff');
    $('.carousel-indicators').find('li').each(function(ele){
      if($(this).hasClass('active')){
        $index = $(this).index();
        $('.carousel-inner').find('.item').eq($index).addClass('active');
      }
    })

 
  })
</script>
</html>