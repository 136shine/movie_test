
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

var movie1 = require('dbConn.js');
console.log(movie1);
var conn = movie1.connect();


var baseUrl = 'https://movie.douban.com/j/search_subjects?type=movie&tag=%E8%B1%86%E7%93%A3%E9%AB%98%E5%88%86&sort=recommend&page_limit=20&page_start=0';  //迅雷首页链接
var arrNew=[]; 
var arrUrl = [];
var errLength=[]; 

app.get('/', function (req, res, next) {

        // 命令 ep 重复监听 emit事件(get_topic_html)，当get_topic_html爬取完毕之后执行
        ep.after('get_topic_html', 1, function (eps) {
            var concurrencyCount = 0;
            var num=-4; //因为是5个并发，所以需要减4

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
                    var movie_id = myurl.split('subject/')[1].split('/')[0];
                    

                    // 对获取的结果进行处理函数
                    getDetail($,function(obj){
                        res.write('<br/>');
                        res.write('id-->  '+obj.id);
                        res.write('<br/>');
                        res.write(num+'、电影名称-->  '+obj.title);
                        res.write('<br/>');
                        res.write('图片-->  '+obj.cover);
                        res.write('<br/>');
                        
                        res.write('评分 -->  '+obj.rate);
                        res.write('<br/>');
                        res.write('导演-->  '+obj.director);
                        res.write('<br/>');
                        res.write('主演-->  '+obj.actors);
                        res.write('<br/>');
                        res.write('时间-->  '+obj.time);
                        res.write('<br/>');
                        res.write('编剧-->  '+obj.adaptor);
                        res.write('<br/>');

                        var tableSql2 = 'insert into tb_movie_detail(movie_id, director, actors, describle, up_time)';
                        var data2 = [movie_id, obj.director, obj.actors, obj.desc, obj.time];        

                        movie1.insert(conn, tableSql2, data2, function(){});
                        // movie1.insertFun2(conn, movie_id, obj.director, obj.actors, obj.desc, obj.time, function(){});
                      
                      
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
                //console.log(obj);
                console.log('抓包结束，一共抓取了-->'+arrUrl.length+'条数据');
                console.log('出错-->'+errLength.length+'条数据');
                return false;
            });
        
        });

        //先抓取首页
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
                getMovieList(sres);
             
                ep.emit('get_topic_html', 'get '+page+' successful');
            });
        })(baseUrl);


        
});


// 获取电影中电影列表
function getMovieList(sres){
    var data = sres.text;
    var arr = JSON.parse(data).subjects;
    // var conn = movie.connect();

    for(var i = 0;i<arr.length; i++){
        if(arrNew.indexOf(arr[i].id) == -1){
            arrNew.push(arr[i]);
            arrUrl.push(arr[i].url);
            var tableSql1 = 'insert into tb_movie(movie_id,movie_name,pic,grade)';
            var data1 = [arr[i].id, arr[i].title, arr[i].cover,arr[i].rate];
            movie1.insert(conn, tableSql1, data1, function(){});

            // movie1.insertFun1(conn,arr[i].id, arr[i].title, arr[i].cover,arr[i].rate, function(){});
        }
    }

}

// 获取
function getDetail($,callback){
    var title=$('#content h1 span:first-child').text();
    var cover = $('.article .subject a img').attr('src');
    var director = $('#info span').eq(0).find('.attrs a').text();
    var adaptor = $('#info span').eq(0).find('.attrs a').text();
    var actors = $('#info .actor .attrs a').text();
    var time = $('#info span[property="v:initialReleaseDate"]').text();
    var desc = $('#link-report span').text();
   // var type = $('#info span').eq(4).find('.attrs a').text();

    var obj={
        'title':title,
        'cover':cover,
        'director':director,
        'adaptor':adaptor,
        'actors':actors,
        'time':time
    };
    // if(!downLink){
    //     downLink='该电影暂无链接';
    // }
    callback(obj);
}

app.listen(3000, function (req, res) {
    console.log('app is running at port 3000');
});

