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

var baseUrl = 'http://www.kugou.com/yy/rank/home/1-22096.html';  
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

                    var data = ssres.text;
                    var info = JSON.parse(data).data;
                    var song = info.audio_name;
                    var singer = info.author_name;
                    var img = info.img;
                    var lyrics = info.lyrics;
                    var play_url = info.play_url;
                    var hash = info.hash;

                    // var idDetail = myurl.split('&hash=')[1].split('&')[0];
                    // console.log(typeof idDetail);
                    // console.log(typeof arr[0].hash);
                    console.log(arr.length);
                        for (var i = 0; i < arr.length; i++) {
                            if(arr[i].hash === hash){
                                // console.log(i);
                                // console.log(arr[i].hash);
                                // console.log(arr[i].music);
                                // console.log(hash+'</br>');
                 //            	res.write('图片-->  '+img);
                 //                res.write('<br/>');
                 //                res.write('歌词-->  '+lyrics);
                 //                res.write('<br/>');
                 //                res.write('播放路径-->  '+play_url);
                 //                res.write('<br/>');
					            // res.write('歌曲-->  '+arr[i].music);
                 //                res.write('<br/>');
                 //                res.write('歌手-->  '+arr[i].singer);
                 //                res.write('<br/>');
                 //                res.write('电影-->  '+arr[i].movie);
                 //                res.write('<br/>');
                 //                res.write('<br/>');
                                movie.insertFun4(conn,arr[i].singer,arr[i].music,arr[i].movie,arr[i].time,img,lyrics,play_url, function(){});
                            
                            }
                        }
                    // B274BD2549B723B966A52DBC5921AA7B
                    // B274BD2549B723B966A52DBC5921AA7B
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
                ep.emit('get_topic_html', 'get '+page+' successful');
            });
        })(baseUrl);
});
 

// 获取电影中电影列表
function getMovieList($){
	var global = {
        // 域名
        kg_domain : "http://www.kugou.com/yy",
        jscssdate: "201505211743",
        page: '1', // 当期页
        pagesize: '22', // 页条数
        total: '580' // 总数
    };

	// 列表数据
global.features = [{"Hash":"C83EA467946EB1D7DFDB04278CF5A85C","FileName":"\u5218\u5fb7\u534e - \u6162\u6162\u4e60\u60ef\u3010\u62c6\u5f39\u4e13\u5bb6\u3011","timeLen":262,"privilege":0,"size":4203911,"album_id":0,"encrypt_id":"fkirl11"},{"Hash":"F044F255490A238F09C7EDD24E5E0F83","FileName":"\u8c2d\u7ef4\u7ef4 - \u5931\u843d\u7684\u7f18\u3010\u7ee7\u627f\u4eba\u3011","timeLen":331,"privilege":0,"size":5300050,"album_id":0,"encrypt_id":"fkdbb2a"},{"Hash":"EA039633EC47026CEB5A6BC34449FA45","FileName":"\u8fea\u739b\u5e0c - \u62ff\u4e0d\u8d70\u7684\u8bb0\u5fc6\u3010\u8bb0\u5fc6\u5927\u5e08\u3011","timeLen":257,"privilege":0,"size":4124423,"album_id":0,"encrypt_id":"fj29x13"},{"Hash":"3090E699AF002DC8A87886623978C50D","FileName":"\u5409\u514b\u96bd\u9038 - \u73cd\u73e0\u3010\u5927\u5510\u8363\u80002\u3011","timeLen":296,"privilege":0,"size":4739547,"album_id":0,"encrypt_id":"fj17mdd"},{"Hash":"8DCDAA91756520D3C5E09E09C1C4BD36","FileName":"\u9ad8\u80fd\u5c11\u5e74\u56e2 - \u9a84\u50b2\u7684\u5c11\u5e74\u3010\u9ad8\u80fd\u5c11\u5e74\u56e2\u3011","timeLen":261,"privilege":0,"size":4181426,"album_id":0,"encrypt_id":"ff6g595"},{"Hash":"F101304DC27549C70324FC216B81DE53","FileName":"\u963f\u6084\u3001\u6731\u5143\u51b0 - \u56e0\u4e3a\u9047\u89c1\u4f60\u3010\u56e0\u4e3a\u9047\u89c1\u4f60\u3011","timeLen":254,"privilege":10,"size":4059263,"album_id":0,"encrypt_id":"f1qbu9c"},{"Hash":"D2585EF1EC1F35287B035E876B0B58B5","FileName":"\u8bb8\u9e64\u7f24 - \u8a93\u5982\u5f53\u521d\u3010\u4eba\u6c11\u7684\u540d\u4e49\u3011","timeLen":139,"privilege":0,"size":2219397,"album_id":0,"encrypt_id":"fkdasad"},{"Hash":"4AD0FDBB1C351C96095364CB9E5253DE","FileName":"\u5f90\u826f - \u7b80\u5355\u7684\u6e29\u70ed\u3010\u4e0d\u4e00\u6837\u7684\u7f8e\u7537\u5b502\u3011","timeLen":230,"privilege":0,"size":3678502,"album_id":0,"encrypt_id":"f90sc70"},{"Hash":"AE98B84033A1F02F36AA2387DBA26F3E","FileName":"\u5f20\u6770 - \u4e09\u751f\u4e09\u4e16\u3010\u4e09\u751f\u4e09\u4e16\u5341\u91cc\u6843\u82b1\u3011","timeLen":257,"privilege":10,"size":4120959,"album_id":0,"encrypt_id":"erfb00b"},{"Hash":"9203DBD272361580DABE9184EFB1A746","FileName":"\u97e9\u78ca\u3001\u6c5f\u6620\u84c9 - \u4ee5\u4eba\u6c11\u7684\u540d\u4e49\u3010\u4eba\u6c11\u7684\u540d\u4e49\u3011","timeLen":268,"privilege":0,"size":4300212,"album_id":0,"encrypt_id":"fg4amc5"},{"Hash":"3414E485BFE4E64CE1787C10642890E1","FileName":"\u5f20\u4fe1\u54f2 - \u590f\u591c\u661f\u7a7a\u6d77\u3010\u90a3\u7247\u661f\u7a7a\u90a3\u7247\u6d77\u3011","timeLen":222,"privilege":0,"size":3559131,"album_id":0,"encrypt_id":"ex6cm54"},{"Hash":"A231178B69E6811AF6DB650359195DF8","FileName":"\u738b\u4e3d\u5764\u3001\u6731\u4e9a\u6587 - \u6f02\u6d0b\u8fc7\u6d77\u6765\u770b\u4f60\u3010\u6f02\u6d0b\u8fc7\u6d77\u6765\u770b\u4f60\u3011","timeLen":280,"privilege":4,"size":4493243,"album_id":0,"encrypt_id":"feku0b6"},{"Hash":"895F591095A17B4334038E0DF49FC3A4","FileName":"\u5b89\u7425\u3001\u738b\u7425 - \u5929\u957f\u5730\u4e45\u3010\u7b2c7\u79d2\u8425\u6551\u3011","timeLen":215,"privilege":0,"size":3445400,"album_id":0,"encrypt_id":"fie4kaf"},{"Hash":"AD0B34CF583F2BCBDB3723932A94B5EA","FileName":"\u7530\u99a5\u7504\u3001\u4e95\u67cf\u7136 - \u7f8e\u5973\u4e0e\u91ce\u517d\u3010\u7f8e\u5973\u4e0e\u91ce\u517d\u3011","timeLen":265,"privilege":0,"size":4255917,"album_id":0,"encrypt_id":"extr33e"},{"Hash":"ED141239C745834A797C48303D36B16A","FileName":"\u5218\u601d\u6db5 - \u68a6\u3010\u88ab\u50ac\u7720\u7684\u50ac\u7720\u5e08\u3011","timeLen":269,"privilege":0,"size":4304187,"album_id":0,"encrypt_id":"fgtoz18"},{"Hash":"65AD398DB3C70A81757108BF32D6367D","FileName":"\u9648\u6653 - \u60b2\u524d\u559c\u5267\u3010\u4e91\u5dc5\u4e4b\u4e0a\u3011","timeLen":292,"privilege":10,"size":4684959,"album_id":0,"encrypt_id":"f9021ac"},{"Hash":"B4094E0821995FDFF20997A84C75C249","FileName":"\u6768\u4e43\u6587 - \u9003\u5175\u3010\u7ed1\u67b6\u8005\u3011","timeLen":224,"privilege":0,"size":3580237,"album_id":0,"encrypt_id":"feallaf"},{"Hash":"4D24D2B011F75C30DFAF30BE87015EAB","FileName":"\u9648\u7c92 - \u5e86\u795d\u3010\u95ee\u9898\u9910\u5385\u3011","timeLen":199,"privilege":10,"size":3185926,"album_id":0,"encrypt_id":"fgbkj10"},{"Hash":"C73578704493D417707B9C3C6ADE148A","FileName":"\u6d77\u9e23\u5a01 - \u4eba\u6d77\u3010\u6076\u9b54\u5c11\u7237\u522b\u543b\u6211\u3011","timeLen":222,"privilege":10,"size":3548245,"album_id":0,"encrypt_id":"exl4661"},{"Hash":"DC877020EAD115ACE09340A0945E8844","FileName":"\u5357\u5f81\u5317\u6218 - \u975e\u51e1\u65f6\u4ee3\u3010\u975e\u51e1\u4efb\u52a1\u3011","timeLen":212,"privilege":0,"size":3396362,"album_id":0,"encrypt_id":"fe96481"},{"Hash":"BB149715B398C78D7CA4A48AB410CDC9","FileName":"\u9ec4\u8f69 - \u8709\u8763\u3010\u975e\u51e1\u4efb\u52a1\u3011","timeLen":246,"privilege":0,"size":4109918,"album_id":0,"encrypt_id":"fh71w0d"},{"Hash":"2F131F523E32BDF4C60608392745F79E","FileName":"\u8c2d\u6676 - \u5510\u97f5\u3010\u5927\u5510\u8363\u8000\u3011","timeLen":323,"privilege":10,"size":5164032,"album_id":0,"encrypt_id":"eurokf6"}];

	    
    $('.pc_temp_songlist li').each(function(index, el) {
    	var hash = global.features[index].Hash;
    	var href = $(this).find('a').attr('href');
    	var url = 'http://www.kugou.com/yy/index.php?r=play/getdata&hash='+hash+'&album_id=0';
    	//console.log(url);
    	var info = $(this).find('a').text();
    	var singer = info.split('-')[0];
    	var music= info.split('-')[1].split('【')[0]; 
    	var movie = info.split('-')[1].split('【')[1].split('】')[0]; 
    	var time = $(this).find('.pc_temp_time').text();
    	var id = href.split('song/')[1].split('.')[0];
        obj = {
        	'info':info,
            'singer':singer,
            'music':music,
            'movie':movie,
            'id':id,
            'url':url,
            'hash':hash,
            'time':time
        }
        if(arr.indexOf(hash)==-1){
            arr.push(obj);
            arrUrl.push(url);
        }
    });
}

// 获取
// function getDetail($,callback){
	
//    var img = $('.singerContent .albumImg').find('img').attr('src');
  
//    var cont = $('.songName').find('.audioName').text();
//    var singer = $('.singerName').text();
//    var content = $('.jspPane').html();

//     var obj={
//     	'img':img,
//     	'cont':cont,
//     	'singer':singer,
//         'content':content
//     };
//      console.log(obj);
//     callback(obj);
// }

app.listen(3000, function (req, res) {
    console.log('app is running at port 3000');
});

