
var mysql = require('mysql');
var cheerio = require('cheerio'); //可以像jquer一样操作界面
var charset = require('superagent-charset'); //解决乱码问题:
var superagent = require('superagent'); //发起请求 
charset(superagent); 
var async = require('async'); //异步抓取
var express = require('express');  
var eventproxy = require('eventproxy');  //流程控制
var ep = eventproxy();
var app = express();

var movie = require('dbConn');
var conn = movie.connect();

var baseUrl = 'http://www.51oscar.com/review.html';  //迅雷首页链接
var arr=[]; 
var cont = '';
var contArr = [];
var arrUrl = [];
var errLength=[]; 

app.get('/', function (req, res, next) {

        //命令 ep 重复监听 emit事件(get_topic_html)，当get_topic_html爬取完毕之后执行
        ep.after('get_topic_html', 1, function (eps) {
            var concurrencyCount = 0;
            var num=-4; //因为是5个并发，所以需要减4
            //console.log(eps);

            // 利用callback函数将结果返回去，然后在结果中取出整个结果数组。
            var fetchUrl = function (myurl, callback) {
                var fetchStart = new Date().getTime();
                concurrencyCount++;
                num+=1
                console.log('现在的并发数是', concurrencyCount, '，正在抓取的是', myurl);
                superagent
                .get(myurl)
                .charset('utf-8') //解决编码问题
                .end(function (err, ssres) {

                    if (err) {
                        callback(err, myurl + ' error happened!');
                        errLength.push(myurl);
                        return next(err);
                    }

                    var time = new Date().getTime() - fetchStart;
                    console.log('抓取 ' + myurl + ' 成功', '，耗时' + time + '毫秒');
                    concurrencyCount--;

                    var $ = cheerio.load(ssres.text);
                   // var movie_id = myurl.split('subject/')[1].split('/')[0];
                    

                    // 对获取的结果进行处理函数
                    getDetail($,function(obj){
                        res.write('<br/>');
                        res.write(num+'、电影名称-->  '+obj.content);
                        
                       // console.log(myurl);
                        var idDetail = myurl.split('review/')[1].split('.')[0];
                        for (var i = 0; i < arr.length; i++) {
                            if(arr[i].id===idDetail){
                                res.write('标题-->  '+arr[i].title);
                                res.write('<br/>');
                                res.write('<br/>');
                                movie.insertFun3(conn,arr[i].title,arr[i].author,arr[i].avator,arr[i].cover,arr[i].movie_name,obj.content,obj.time, function(){});
                            }
                        }
                      
                    });
                     
                    var result = {
                         movieLink: myurl
                    };
                    callback(null, result);
                });
            };
          
           
        
            // 控制最大并发数为5，在结果中取出callback返回来的整个结果数组。
            // mapLimit(arr, limit, iterator, [callback])
            async.mapLimit(arrUrl, 5, function (movieList, callback) {
                fetchUrl(movieList, callback);
            }, function (err, result) {
                // 爬虫结束后的回调，可以做一些统计结果
                console.log('抓包结束，一共抓取了-->'+arrUrl.length+'条数据');
                console.log('出错-->'+errLength.length+'条数据');
                return false;
            });
        
        });

        //先抓取迅雷首页
        (function (page) {//抛出
            superagent
            .get(page)
            .charset('utf-8')
            .end(function (err, sres) {
                // 常规的错误处理
                if (err) {
                    console.log('抓取'+page+'这条信息的时候出错了')
                    return next(err);
                }
                var $=cheerio.load(sres.text);//用cheerio解析页面数据
                getMovieList($);
                /*
                *流程控制语句
                *当首页左侧的链接爬取完毕之后，我们就开始爬取里面的详情页
                */
                ep.emit('get_topic_html', 'get '+page+' successful');
            });
        })(baseUrl);


        
});
 

// 获取电影中电影列表
function getMovieList($){
    var len = $('.reviItem').length;
    
    $('.reviItem').each(function(index, el) {
        
        var avator = 'http://www.51oscar.com'+$(this).find('.L a>img').attr('src');
        var cover = 'http://www.51oscar.com'+$(this).find('.R a img').attr('src');
        var url = $(this).find('.t a').attr('href');
        var title = $(this).find('.t a').text();
        var author = $(this).find('.L .c_f60').text();
        var movie_name = $(this).find('.C .t').text().split('《')[1].split('》')[0];
        var urlT = 'http://www.51oscar.com'+url;
        var id = url.split('.')[0].split('review/')[1];

        obj = {
            'avator':avator,
            'cover':cover,
            'urlT':urlT,
            'title':title,
            'author':author,
            'movie_name':movie_name,
            'id':id
        }
        if(arr.indexOf(id)==-1){
            arr.push(obj);
            arrUrl.push(obj.urlT);
        }
    });


}

// 获取
function getDetail($,callback){

   
   $('.newCont').find('img').each(function(){
    var imgSrc = $(this).attr('src');
    $(this).attr('src','http://www.51oscar.com'+imgSrc);
   })
   var content = $('.newCont').html();
   var timeAll = $('.titB span').text().match(/\d{4}-\d{2}-\d{2}/);
   var time = timeAll[0];
   console.log(time); 
    

    var obj={
        'content':content,
        'time':time
        
    };
    
    callback(obj);
}

app.listen(3000, function (req, res) {
    console.log('app is running at port 3000');
});

