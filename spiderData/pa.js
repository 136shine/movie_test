var express=require('express');//引入模块
var cheerio=require('cheerio');
var superagent=require('superagent');
var mysql = require('mysql');

var movie = require('dbConn');
var app=express();
app.get('/',function(req,res,next){
    superagent.get('https://movie.douban.com/j/search_subjects?type=movie&tag=%E6%9C%80%E6%96%B0&page_limit=20&page_start=0')//请求页面地址
        .end(function(err,sres){//页面获取到的数据
            if(err) return next(err);
            //var $=cheerio.load(sres.text);//用cheerio解析页面数据
          
            var arr=[];
            // $(".col-xs-1-5.movie-item").each(function(index,element){//类似于jquery的操作，前端的小伙伴们肯定很熟悉啦
                
            //     var img = $(element).find('.movie-item-in a img').attr('src');
            //     var title = $(element).find('.movie-item-in h1 a').text();
            //     var grade = $(element).find('.movie-item-in h1 em').text();
                
            //     arr.push(
            //         {
                        
            //             "img": $(element).find('.movie-item-in a img').attr('src'),
            //             "title": $(element).find('.meta h1 a').text(),
            //             "grade": $(element).find('.meta h1 em').text().match(/\d+\.\d/)

            //         }
            //     );

            // });
           
            res.send(sres);
            var data = sres.text;
            var arr = JSON.parse(data).subjects;
            var conn = movie.connect();
            for(var i = 0;i<arr.length; i++){
                movie.insertFun(conn,'',arr[i].id, arr[i].title, arr[i].cover,arr[i].rate,arr[i].url, function(){});
            }

            
        })
});

 

app.listen(5000, function () {
    console.log('app is listening at port 5000');
});