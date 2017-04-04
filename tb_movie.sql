/*
Navicat MySQL Data Transfer

Source Server         : blog
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : movie

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-03-31 18:18:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_movie
-- ----------------------------
DROP TABLE IF EXISTS `tb_movie`;
CREATE TABLE `tb_movie` (
  `movie_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(255) NOT NULL,
  `movie_type` int(3) DEFAULT NULL,
  `grade` float(8,1) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `up_time` date DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `listorder` smallint(5) DEFAULT NULL,
  `big_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`movie_id`),
  UNIQUE KEY `movie_name` (`movie_name`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_movie
-- ----------------------------
INSERT INTO `tb_movie` VALUES ('44', '一只狗的使命', '2', '9.2', '/upload/2017/03/22/58d2666c65d59.jpg', '2017-03-03', '1', '0', '/upload/2017/03/22/58d2667021b54.jpg');
INSERT INTO `tb_movie` VALUES ('43', '美女与野兽', '5', '7.0', '/upload/2017/03/22/58d2488d93075.jpg', '2017-03-17', '1', '3', '/upload/2017/03/22/58d2495223c4c.jpg');
INSERT INTO `tb_movie` VALUES ('45', '金刚：骷髅岛 ', '1', '6.4', '/upload/2017/03/24/58d4c0cfd9c45.jpg', '2017-03-24', '1', '2', '');
INSERT INTO `tb_movie` VALUES ('46', '金刚狼3：殊死一战 ', '1', '8.3', '/upload/2017/03/24/58d4c2540f002.jpg', '2017-03-03', '1', '0', '');
INSERT INTO `tb_movie` VALUES ('47', '爱乐之城', '5', '8.4', '/upload/2017/03/24/58d4d2b65ef0f.jpg', '2017-02-14', '-1', '0', '');
INSERT INTO `tb_movie` VALUES ('48', '你的名字', '5', '8.5', '/upload/2017/03/24/58d4d376c1d95.jpg', '2016-12-02', '1', '0', '');
INSERT INTO `tb_movie` VALUES ('49', '星球大战外传：侠盗一号', '4', '7.3', '/upload/2017/03/29/58db6a4ab3ffc.jpg', '2017-01-06', '1', '10', '/upload/2017/03/29/58db6a57708f1.jpg');
INSERT INTO `tb_movie` VALUES ('50', '生化危机：终章', '1', '6.7', '/upload/2017/03/29/58db6bb0a8137.jpg', '2017-02-24', '1', '9', '/upload/2017/03/29/58db6bbc2e680.jpg');
INSERT INTO `tb_movie` VALUES ('51', '刺客信条', '1', '5.5', '/upload/2017/03/29/58db6c8c8451d.jpg', '2017-02-24', '1', '8', '/upload/2017/03/29/58db6c9452950.jpg');
INSERT INTO `tb_movie` VALUES ('132', '湄公河行动', null, '8.0', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2380677316.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('133', '攻壳机动队', null, '6.3', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2441265742.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('134', '永不退缩3', null, '6.1', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2330649118.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('135', '疯狂的麦克斯4：狂暴之路', null, '8.5', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2236181653.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('136', '碟中谍5：神秘国度', null, '7.7', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2263582212.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('137', '长城', null, '5.0', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2394573821.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('138', '师父', null, '8.1', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2293405567.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('139', '极限特工3：终极回归', null, '5.8', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2410569976.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('140', '死侍', null, '7.5', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2309264172.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('141', '谍影重重5', null, '7.3', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2379032162.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('142', '杀破狼2', null, '7.3', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2246885606.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('143', '寻龙诀', null, '7.6', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2284620292.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('144', '釜山行', null, '8.2', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2360940399.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('145', '007：幽灵党', null, '6.2', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2276234635.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('146', '寒战2', null, '6.9', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2360072346.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('147', '机械师2：复活', null, '5.6', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2385311728.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('148', '自杀小队', null, '6.1', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2363084076.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('149', '暗杀', null, '8.0', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2265025290.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('150', '魔兽', null, '7.8', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2345947329.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('151', '提着心吊着胆', null, '7.6', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2450294642.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('152', '圣之青春', null, '7.8', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2377586169.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('153', '她唇之下', null, '6.1', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2382431336.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('154', '惊魂太空舱', null, '5.1', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2329945298.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('155', '单身骑士', null, '6.8', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2411571793.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('156', '人类削减计划', null, '5.3', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2387545773.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('157', '鬼话怪谈·祥云寺', null, '5.9', 'https://img5.doubanio.com/view/movie_poster_cover/lpst/public/p2434618486.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('158', '最坏的一天', null, '6.2', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2366699070.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('159', '办公室圣诞派对', null, '5.9', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2390189660.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('160', '少女', null, '5.6', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2392621450.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('161', '暗金丑岛君：完结篇', null, '7.8', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2449387990.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('162', '封面有男天', null, '6.3', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2263835058.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('163', '巴尼·汤姆森传奇', null, '7.0', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2316162241.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('164', '看不见的客人', null, '8.6', 'https://img1.doubanio.com/view/movie_poster_cover/lpst/public/p2404978988.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('165', '苦中带甜的滋味', null, '6.7', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2358538173.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('166', '契克', null, '8.0', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2369390663.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('167', '二次旅程', null, '7.7', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2363284681.jpg', null, '1', null, null);
INSERT INTO `tb_movie` VALUES ('168', '悍女', null, '6.6', 'https://img3.doubanio.com/view/movie_poster_cover/lpst/public/p2448526930.jpg', null, '1', null, null);
