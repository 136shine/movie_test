<?php if (!defined('THINK_PATH')) exit(); $config = D("Basic")->select(); $navs = D("Menu")->getBarMenus(); ?>
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
          <img src="/Public/images/" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="/" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
        <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=cat&id=<?php echo ($vo["menu_id"]); ?>" <?php if($vo['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
      <div class="nav navbar-nav navbar-right" style="padding: 16px 0;">
        <a href="/index.php?c=user"><button type="button" class="btn btn-default">注册</button></a>
        <a href="/index.php?c=user&a=login"><button type="button" class="btn btn-default">登录</button></a> 
      </div>
    </div>
  </div>
</header>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="banner">
          <div class="banner-left">
            <ul>
              <?php if(is_array($result['topPic'])): $i = 0; $__LIST__ = $result['topPic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="list-style: none;">
                  <a target="_blank" data-src="/index.php?c=detail&id=<?php echo ($vo["movie_id"]); ?>"><img width="1200" height="360" src="<?php echo ($vo["big_pic"]); ?>" alt="<?php echo ($vo["movie_name"]); ?>"></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>
          </div>
        </div>
       
      </div>
      
    </div>
    <div class="row">
      <div class="col-sm-9 col-md-9">
          <div class="news-list">
            <?php if(is_array($result['listMovies'])): $i = 0; $__LIST__ = $result['listMovies'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="wrap col-md-3 col-sm-4">
                <div class="movie_pic"><a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["movie_id"]); ?>" style="background:url(<?php echo ($vo["pic"]); ?>) no-repeat center; background-size: 100% 100%;" ><span class="grade"><?php echo ($vo["grade"]); ?></span></a></div>
                <div class="ms">
                  <span class="movie_name"><?php echo ($vo["movie_name"]); ?></span>
                  
                  <span class="type"><?php echo ($vo["movie_type"]); ?></span>
                  
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
      <?php if(is_array($result['rankNews'])): $k = 0; $__LIST__ = $result['rankNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
        <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["small_title"]); ?></a>
        <?php if($k == 1): ?><div class="intro">
          <?php echo ($vo["description"]); ?>
        </div><?php endif; ?>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <?php if(is_array($result['advNews'])): $k = 0; $__LIST__ = $result['advNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="right-hot">
    <a target="_blank" href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>

      </div>
    </div>
  </div>
</section>
</body>
<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/count.js"></script>
<script type="text/javascript">
  $(function(){
    console.log('123432cndiasndklsnvjfdsn');
    var dataHref = $('.banner-right li:first-child a').attr('data-src');
    var dataSrc = $('.banner-right li:first-child img').attr('src');
    console.log(dataHref);
    $('.banner-left a').attr('href',dataHref);
    $('.banner-left a img').attr('src',dataSrc);
  })
</script>
</html>