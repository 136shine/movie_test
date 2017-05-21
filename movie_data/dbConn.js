var mysql = require('mysql');

function connectServer(){
    var client=mysql.createConnection({
        host:'localhost',
        user:'root',
        password:'root',
        database:'movie'
    });
    
    return client;
}


function insertFun(client ,tableSql, data, callback){
     client.query(tableSql, data , function(err,result){
         if( err ){
             console.log( "error:" + err.message);
             return err;
         }
           callback(err);
     });
}


exports.connect = connectServer;
exports.insert = insertFun;