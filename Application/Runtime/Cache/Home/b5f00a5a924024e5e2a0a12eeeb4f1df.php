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
        <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=cat&id=<?php echo ($vo["menu_id"]); ?>" <?php if($vo['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
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
<?php  $vo = $result['movie']; ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-9 col-sm-9 col-md-9">
					<div class="movie-detail">
						<h1><?php echo ($vo["movie_name"]); ?></h1>
						<div class="row">
							<div class="col-xs-4 movie-left">
								<img src="<?php echo ($vo["pic"]); ?>">
							</div>
							<div class="col-xs-8 movie-right">
								<span><strong>导演：</strong><?php echo ($vo["director"]); ?></span>
								<span><strong>主演：</strong><?php echo ($vo["actors"]); ?></span>
								<span><strong>类型：</strong><?php echo ($vo["movie_type"]); ?></span>
								<span><strong>评分：</strong><?php echo ($vo["grade"]); ?></span>
								<span><strong>排名：</strong><?php echo ($vo["rank"]); ?></span>
								<span><strong>票房：</strong><?php echo ($vo["count"]); ?></span>
								<span><strong>上映时间：</strong><?php echo ($vo["up_time"]); ?></span>
								
							</div>
						</div>
						
					</div>
					<div class="col-xs-12 desc mode">
						<span class="tag">影片介绍</span>
						<p><?php echo ($vo["describle"]); ?></p>
					</div>
					<div class="col-xs-12 comment mode">
						<span class="tag">影片评论</span>
           			 	<div class="row">
							<div class="col-xs-12">

								<div style="margin-top:10px;">
									<?php if(is_array($result['review'])): $k = 0; $__LIST__ = $result['review'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><hr class="dline">
									    <table style="width:100%;overflow:auto;" id="comment1417" name="comment1417">
									        <tbody>
									            <tr>
										            <td width="38px" valign="top" align="center">
										                <a target="_blank" href="/u/178214"><img style="width:100%;border-radius:3px;" title="" src="/Public/images/user_avator.png"></a>
										            </td>
									            	<td width="10px"></td>
									            	<td width="auto">
										                <div class="reply-author">
										                    <a><?php echo ($vo["username"]); ?></a>
										                    <div class="reply-right" style="float: right;">
										                    	<em style="margin-right: 16px;"><?php echo ($vo["time"]); ?></em>
										                    	<a>#<?php echo ($k); ?></a>
										                    </div>
										                </div>
									                	<div class="reply-content">
									                		<?php echo ($vo["content"]); ?>
										                	<div style="overflow:auto;text-align:right;font-size:13px;">
												               	 <a href="javascript:;" onclick="zan(1417)">赞(0)</a>
												                | <a href="javascript:;" onclick="cai(1417)">踩(0)</a>
												                | <a href="javascript:;" onclick="replyto(1417,'严易易')">回复</a>
										                	</div>
									                	</div>
									              	</td>
									            </tr>
									           
									        </tbody>
									    </table><?php endforeach; endif; else: echo "" ;endif; ?>
									<div class="col-xs-12">
							            <div class="panel panel-default list-head reply-box" id="reply-box">
							            <div class="panel-heading title-breadcrumb"><div id="reply-to-box">发表：</div></div>
							            <div class="panel-body"><textarea id="replycontent" class="form-control" rows="8"></textarea></div>
							            <div class="panel-footer"><a><button id="re_btn" type="submit" class="btn btn-primary btn-block">发表</button></a></div>
								        </div>
								    </div>
								</div>
          					</div>
						</div>
					</div>
				</div>

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
				<!-- end right-->
			</div>
		</div>
	</section>
</body>

<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/admin/common.js"></script>
<script type="text/javascript" src="/Public/js/dialog/layer.js"></script>
<script type="text/javascript" src="/Public/js/dialog"></script>
<script type="text/javascript" src="/Public/js/dialog.js"></script>
<script type="text/javascript">

	$("#re_btn").click(function(){
		var postData = {};
	    postData['content'] = $("#replycontent").val();
	    var href = window.location.href;
	    var id = href.split('&id=')[1];
	    postData['id'] = id;

	    // 将获取到的数据post给服务器
	    var url ='/index.php?c=movie_detail&a=add&id='+id;
	   
	    $.post(url,postData,function(result){
	        if(result.status == 1) {
	            //成功
	            $("#replycontent").val('');
	            return dialog.success(result.message,'/index.php?c=movie_detail&a=view&id='+id);
	        }else if(result.status == 0) {
	            // 失败
	            return dialog.error(result.message);
	        }
	    },"JSON");
	});
// $(function() {
//     var options={"currentPage":1,"totalPages":1,"totalCount":5,"numberOfPages":10,"bootstrapMajorVersion":3,"size":"small","alignment":"right"};
//     options['itemContainerClass'] = function (type, page, current) {
//         return (page === current) ? "active" : "pointer-cursor";
//     }
//     options['pageUrl'] = function(type, page, current){
//         return "javascript:;";
//     }
//     options['onPageClicked'] = function(e,originalEvent,type,page){
//         originalEvent.preventDefault();
//         originalEvent.stopPropagation();
//         $.get('/comment/commentList/movie/204990/'+page,function(data,status){
//                 $('.comment').html(data);
//             }
//         );
//     };
//     $('#pager').bootstrapPaginator(options);
// });
</script>
</html>