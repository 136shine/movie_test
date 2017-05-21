<?php if (!defined('THINK_PATH')) exit();?> <?php
 session_start(); $config = D("Basic")->select(); $navs = D("Menu")->getBarMenus(); ?>
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
  
  <div class="container">
    <div class="row">
      <div class="search col-sm-6 col-md-6 col-sm-pull-3 col-md-push-3">
          <form id="search-form" method="post" autocomplete="off">
              <input name="keyword" value="" placeholder="输入想看的电影或关键字...">
              <input id="submit" type="submit" value="ฅ">
          </form>
      </div>
    </div>
    <div class="search_res">
        <div class="movie-list clearfix">
              <?php if(is_array($searchRes)): $i = 0; $__LIST__ = $searchRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="movie-item col-xs-1-5 col-sm-4 col-md-3 col-xs-6">
                  <div class="movie-pic"><a target="_blank" href="/index.php?c=movie_detail&id=<?php echo ($vo["movie_id"]); ?>" style="background:url(<?php echo ($vo["pic"]); ?>) no-repeat center; background-size: 100% 100%;" ><span class="grade"><?php echo ($vo["grade"]); ?></span></a></div>
                  <div class="ms">
                    <span class="movie_name"><?php echo ($vo["movie_name"]); ?></span>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
              <nav><ul style="margin-top: -8px; margin-bottom: 30px;" class="page_bottom"><?php echo ($page); ?></ul></nav>
        </div>
        <div class="lineS" <?php if($searchRes == null): ?>style="display:none;"<?php endif; ?>></div>
    </div>

    <div class="row" id="movie-re">
        <div class="col-sm-12 col-md-12 list_mode">
          <span class="tag_movie">最新推荐</span>
            <div class="movie-list clearfix">
              <?php if(is_array($result['listNewMovies'])): $i = 0; $__LIST__ = $result['listNewMovies'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="movie-item col-xs-1-5 col-sm-4 col-md-3 col-xs-6">
                  <div class="movie-pic"><a target="_blank" href="/index.php?c=movie_detail&id=<?php echo ($vo["movie_id"]); ?>" style="background:url(<?php echo ($vo["pic"]); ?>) no-repeat center; background-size: 100% 100%;" ><span class="grade"><?php echo ($vo["grade"]); ?></span></a></div>
                  <div class="ms">
                    <span class="movie_name"><?php echo ($vo["movie_name"]); ?></span>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 list_mode">
          <span class="tag_movie">最热推荐</span>
            <div class="movie-list clearfix">
              <?php if(is_array($result['listHotMovies'])): $i = 0; $__LIST__ = $result['listHotMovies'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="movie-item col-xs-1-5 col-sm-4 col-md-3 col-xs-6">
                  <div class="movie-pic"><a target="_blank" href="/index.php?c=movie_detail&id=<?php echo ($vo["movie_id"]); ?>" style="background:url(<?php echo ($vo["pic"]); ?>) no-repeat center; background-size: 100% 100%;" ><span class="grade"><?php echo ($vo["grade"]); ?></span></a></div>
                  <div class="ms">
                    <span class="movie_name"><?php echo ($vo["movie_name"]); ?></span>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>       
    </div>
    <nav><ul style="margin-top: -8px; margin-bottom: 30px;" class="page_bottom"><?php echo ($pageres); ?></ul></nav>
  </div>
    
  </body>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $('body').css('background-color','rgb(245,245,245)');

     /**
     * 提交form表单操作
     */
    $("#submit").click(function(){
        var data = $("#search-form").serializeArray();
        postData = {};
        $(data).each(function(i){
           postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
       
        //jump_url = SCOPE.jump_url;
        $.post('/index.php?c=movie&a=index',postData,function(result){
            if(result.status == 1) {
              console.log(result.status);
                $('#movie-re').hide();
                //成功
                return;
            }else if(result.status == 0) {
                // 失败
                return;
            }
        },"JSON");
    });
  })
</script>
</html>