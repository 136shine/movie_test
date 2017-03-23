/*
Navicat MySQL Data Transfer

Source Server         : blog
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : movie

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-03-23 20:22:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `admin_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('1', 'admin', 'd099d126030d3207ba102efa8e60630a', '0', '1490268936', 'tracywxh0830@126.com', 'singwa', '1');
INSERT INTO `tb_admin` VALUES ('2', 'singwa', 'a8ea3a23aa715c8772dd5b4a981ba6f4', '0', '1458139801', '', '王新华', '-1');
INSERT INTO `tb_admin` VALUES ('3', 'singwa', 'a8ea3a23aa715c8772dd5b4a981ba6f4', '0', '0', '', '', '-1');
INSERT INTO `tb_admin` VALUES ('4', 'singwa3', '79d4026540fdd95e4a0b627c77e6fa44', '0', '1458144621', '', 'singwa', '0');
INSERT INTO `tb_admin` VALUES ('5', 'singwa', '5ec68e6f496115b92ba5662a35922611', '0', '0', '', '1', '-1');
INSERT INTO `tb_admin` VALUES ('6', 'singwa222', '6f071d49b5122a7352d8f2cc21680079', '0', '0', '', 'singwa', '-1');
INSERT INTO `tb_admin` VALUES ('7', 'singwa222', '5ec68e6f496115b92ba5662a35922611', '0', '0', '', '1', '-1');
INSERT INTO `tb_admin` VALUES ('8', 'singwa123', '204c93175e725ca51d28633055536e09', '0', '1458485298', 'singcms@singwa.com', 'singcms123', '1');

-- ----------------------------
-- Table structure for tb_comment
-- ----------------------------
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `reply_id` int(8) DEFAULT NULL,
  `movie_id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `avator` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_comment
-- ----------------------------

-- ----------------------------
-- Table structure for tb_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`f`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_menu
-- ----------------------------
INSERT INTO `tb_menu` VALUES ('1', '', '0', '', '', '', '', '0', '-1', '0');
INSERT INTO `tb_menu` VALUES ('14', '电影管理', '0', 'admin', 'movie', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('15', '菜单管理', '0', 'admin', 'menu', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('16', '推荐位管理', '0', 'admin', 'position', 'index', '', '0', '-1', '1');
INSERT INTO `tb_menu` VALUES ('17', '推荐详情管理', '0', 'admin', 'recomment', 'index', '', '0', '-1', '1');
INSERT INTO `tb_menu` VALUES ('18', '相关音乐管理', '0', 'admin', 'music', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('19', '影评管理', '0', 'admin', 'comment', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('20', '留言管理', '0', 'admin', 'message', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('21', '电影推荐排行管理', '0', 'admin', 'rank_movie', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('22', '基本配置管理', '0', 'admin', 'basic', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('23', '电影推荐', '0', 'home', 'cat', 'index', '', '3', '1', '0');
INSERT INTO `tb_menu` VALUES ('24', '影视金曲', '0', 'home', 'music', 'index', '', '2', '1', '0');
INSERT INTO `tb_menu` VALUES ('25', '影评', '0', 'home', 'comment', 'index', '', '1', '1', '0');

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
  `up_time` date NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `listorder` smallint(5) NOT NULL,
  `big_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_movie
-- ----------------------------
INSERT INTO `tb_movie` VALUES ('44', '一只狗的使命', '2', '9.2', '/upload/2017/03/22/58d2666c65d59.jpg', '2017-03-03', '1', '0', '/upload/2017/03/22/58d2667021b54.jpg');
INSERT INTO `tb_movie` VALUES ('43', '美女与野兽', '5', '7.0', '/upload/2017/03/22/58d2488d93075.jpg', '2017-03-17', '1', '0', '/upload/2017/03/22/58d2495223c4c.jpg');

-- ----------------------------
-- Table structure for tb_movie_detail
-- ----------------------------
DROP TABLE IF EXISTS `tb_movie_detail`;
CREATE TABLE `tb_movie_detail` (
  `movie_detail_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(8) unsigned NOT NULL,
  `actors` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `describle` varchar(255) NOT NULL,
  `rank` int(20) NOT NULL,
  `count` int(50) NOT NULL,
  PRIMARY KEY (`movie_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_movie_detail
-- ----------------------------
INSERT INTO `tb_movie_detail` VALUES ('10', '17', 'a', 'b', '111', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('11', '18', 'a', 'b', '111', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('12', '19', 'a', 'b', '111', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('13', '20', 'a', 'b', '111', '199', '1');
INSERT INTO `tb_movie_detail` VALUES ('14', '21', 'a', 'b', '111', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('15', '22', 'a', 'b', '111', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('16', '23', 'a', 'b', '111', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('17', '24', '1', '5', '123', '4', '2');
INSERT INTO `tb_movie_detail` VALUES ('18', '25', '1', '1', '222', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('19', '26', '1', '1', 'dsa', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('20', '27', '1', '1', '1', '1', '1');
INSERT INTO `tb_movie_detail` VALUES ('21', '28', '12', '2', '小王子小王子', '2', '300');
INSERT INTO `tb_movie_detail` VALUES ('22', '29', 'asa lina', 'Alices', '爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城爱乐之城', '2', '16000000');
INSERT INTO `tb_movie_detail` VALUES ('23', '30', '孙悟空 白骨精', '唐曾', '三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精三打白骨精', '12', '2500000');
INSERT INTO `tb_movie_detail` VALUES ('24', '31', '你', '他', '万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到万万没想到', '1', '56000000');
INSERT INTO `tb_movie_detail` VALUES ('25', '32', '不知道', '未知', '谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫谁的青春不迷茫', '20', '340000');
INSERT INTO `tb_movie_detail` VALUES ('26', '33', 'aaa', 'bbbb', '美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽美女与野兽', '12', '6790000');
INSERT INTO `tb_movie_detail` VALUES ('27', '34', '1', '3', '三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体三体', '14', '2390000');
INSERT INTO `tb_movie_detail` VALUES ('28', '35', '2', '3', '疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城疯狂动画城', '11', '2320088');
INSERT INTO `tb_movie_detail` VALUES ('29', '36', '43', '2', '请求', '2', '5');
INSERT INTO `tb_movie_detail` VALUES ('30', '37', '9', '0', 'a', '1', '7');
INSERT INTO `tb_movie_detail` VALUES ('31', '38', '4', '1', '摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人摆渡人', '5', '2147483647');
INSERT INTO `tb_movie_detail` VALUES ('32', '39', '1', '3', '同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你同桌的你', '22', '230000');
INSERT INTO `tb_movie_detail` VALUES ('33', '40', '1', '3', '美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼美人鱼', '12', '3000011');
INSERT INTO `tb_movie_detail` VALUES ('34', '41', '133', '3', 'aefffaefgfd', '12', '3342341');
INSERT INTO `tb_movie_detail` VALUES ('35', '42', '9', '1', '速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情速度与激情', '4', '900000');
INSERT INTO `tb_movie_detail` VALUES ('36', '43', ' 艾玛·沃森 / 丹·史蒂文斯 / 卢克·伊万斯 / 凯文·克莱恩 / 乔什·加德', '比尔·康顿', '《美女与野兽》根据迪士尼1991年经典动画片及闻名全球的经典童话改编，讲述了少女贝儿的奇幻旅程——为了解救触怒野兽的父亲，勇敢善良的她只身一人来到古堡，代替父亲被囚禁其中。贝儿克服了恐惧，和城堡里的魔法家具们成为了朋友，也渐渐发现野兽其实是受了诅咒的王子，他可怖的外表下藏着一颗善良温柔的内心；这个故事也带领观众明白——美不仅仅是外表，更重要的是内心。', '1', '1200000');
INSERT INTO `tb_movie_detail` VALUES ('37', '44', '布丽特·罗伯森 / 丹尼斯·奎德 / 佩吉·利普顿 / 乔什·加德 / K·J·阿帕', '拉斯·霍尔斯道姆  ', '　影片以汪星人的视角展现狗狗和人类的微妙情感，一只狗狗陪伴小主人长大成人，甚至为他追到了女朋友，后来它年迈死去又转世投胎变成其他性别和类型的汪，第二次轮回狗狗变成了警犬威风凛凛，再次转轮回，又成了陪伴一位单身女青年的小柯基犬。在经历了多次轮回之后，最终回到最初的主人身边。', '6', '120000');

-- ----------------------------
-- Table structure for tb_music
-- ----------------------------
DROP TABLE IF EXISTS `tb_music`;
CREATE TABLE `tb_music` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `music_name` varchar(255) NOT NULL,
  `singer` varchar(255) NOT NULL,
  `movie_id` int(8) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_music
-- ----------------------------

-- ----------------------------
-- Table structure for tb_news
-- ----------------------------
DROP TABLE IF EXISTS `tb_news`;
CREATE TABLE `tb_news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(30) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) DEFAULT NULL COMMENT '标题颜色',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL COMMENT '文章描述',
  `posids` varchar(250) NOT NULL DEFAULT '',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT '来源',
  `username` char(20) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`),
  KEY `status` (`status`,`listorder`,`news_id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`news_id`),
  KEY `catid` (`catid`,`status`,`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_news
-- ----------------------------
INSERT INTO `tb_news` VALUES ('17', '3', 'test', 'test', '#5674ed', '/upload/2016/03/06/56dbdc0c483af.JPG', 'sss', 'sss', '', '1', '-1', '0', 'admin', '1455756856', '0', '0');
INSERT INTO `tb_news` VALUES ('18', '3', '你好ssss', '你好', '#ed568b', '/upload/2016/03/06/56dbdc015e662.JPG', '你好', '你好sssss  ss', '', '2', '-1', '3', 'admin', '1455756999', '0', '0');
INSERT INTO `tb_news` VALUES ('19', '8', '1', '11', '#5674ed', '/upload/2016/02/28/56d312b12ccec.png', '1', '1', '', '0', '-1', '0', 'admin', '1456673467', '0', '0');
INSERT INTO `tb_news` VALUES ('20', '3', '事实上', '11', '', '/upload/2016/02/28/56d3185781237.png', '1', '11', '', '0', '-1', '0', 'admin', '1456674909', '0', '0');
INSERT INTO `tb_news` VALUES ('21', '3', '习近平今日下午出席解放军代表团全体会议', '习近平出席解放军代表团全体会议', '', '/upload/2016/03/13/56e519a185c93.png', '中共中央总书记 国家主席 中央军委主席 习近平', '中共中央总书记', '', '2', '1', '1', 'admin', '1457854896', '0', '60');
INSERT INTO `tb_news` VALUES ('22', '12', '李克强让部长们当第一新闻发言人', '李克强让部长们当第一新闻发言人', '', '/upload/2016/03/13/56e51b6ac8ce2.jpg', '李克强  新闻发言人', '部长直接面对媒体回应关切，还能直接读到民情民生民意，而不是看别人的舆情汇报。', '', '0', '1', '0', 'admin', '1457855362', '0', '33');
INSERT INTO `tb_news` VALUES ('23', '3', '重庆美女球迷争芳斗艳', '重庆美女球迷争芳斗艳', '', '/upload/2016/03/13/56e51cbd34470.png', '重庆美女 球迷 争芳斗艳', '重庆美女球迷争芳斗艳', '', '10', '1', '0', 'admin', '1457855680', '0', '22');
INSERT INTO `tb_news` VALUES ('24', '3', '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '', '/upload/2016/03/13/56e51fc82b13a.png', '中超 汪嵩世界波  富力客场 1-0力擒泰达', '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '', '1', '1', '0', 'admin', '1457856460', '0', '26');

-- ----------------------------
-- Table structure for tb_news_content
-- ----------------------------
DROP TABLE IF EXISTS `tb_news_content`;
CREATE TABLE `tb_news_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` mediumint(8) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_news_content
-- ----------------------------
INSERT INTO `tb_news_content` VALUES ('7', '17', '&lt;p&gt;\r\n	gsdggsgsgsgsg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	sgsg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	gsdgsg \r\n&lt;/p&gt;\r\n&lt;p style=&quot;text-align:center;&quot;&gt;\r\n	       ggg\r\n&lt;/p&gt;', '1455756856', '0');
INSERT INTO `tb_news_content` VALUES ('8', '18', '&lt;p&gt;\r\n	你好\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	我很好dsggfg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	gsgfgdfgd\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	gggg\r\n&lt;/p&gt;', '1455756999', '0');
INSERT INTO `tb_news_content` VALUES ('9', '19', '111', '1456673467', '0');
INSERT INTO `tb_news_content` VALUES ('10', '20', '111', '1456674909', '0');
INSERT INTO `tb_news_content` VALUES ('11', '21', '&lt;p&gt;\r\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;font-size:16px;line-height:32px;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3月13日下午，中共中央总书记、国家主席、中央军委主席习近平出席十二届全国人大四次会议解放军代表团全体会议，并发表重要讲话。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;font-size:16px;line-height:32px;&quot;&gt;&lt;img src=&quot;/upload/2016/03/13/56e519acb12ee.png&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;/span&gt;\r\n&lt;/p&gt;', '1457854896', '0');
INSERT INTO `tb_news_content` VALUES ('12', '22', '&lt;p style=&quot;font-size:16px;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&amp;nbsp; &amp;nbsp; “部长通道”是今年两会一大亮点，成为两会开放透明和善待媒体的一个象征。在这个通道上，以往记者拉着喊着部长接受采访的场景不见了，变为部长主动站出来回应关切，甚至变成部长排队10多分钟等着接受采访。媒体报道称，两会前李克强总理接连两次“发话”，要求各部委主要负责人“要积极回应舆论关切”。部长主动放料，使这个通道上传出了很多新闻，如交通部长对拥堵费传闻的回应，人社部部长称网传延迟退休时间表属误读等。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;img src=&quot;/upload/2016/03/13/56e51b7fcd445.jpg&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 记者之所以喜欢跑两会，原因之一是两会上高官云集，能“堵”到、“逮”到、“抢”到很多大新闻——现在不需要堵、逮和抢，部长们主动曝料，打通了各种阻隔，树立了开明开放的政府形象。期待“部长通道”不只在两会期间存在，最好能成为一种官媒交流、官民沟通的常态化新闻通道。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;font-size:16px;line-height:32px;&quot;&gt;部长们多面对媒体多发言，不仅能提高自身的媒介素养，也带动部门新闻发言人，更加重视与媒体沟通。部长直接面对媒体回应关切，还能直接读到民情民生民意，而不是看别人的舆情汇报。&lt;/span&gt;\r\n&lt;/p&gt;', '1457855362', '0');
INSERT INTO `tb_news_content` VALUES ('13', '23', '&lt;p&gt;\r\n	&lt;span style=&quot;color:#666666;font-family:\'Microsoft Yahei\', 微软雅黑, SimSun, 宋体, \'Arial Narrow\', serif;font-size:14px;line-height:28px;background-color:#FFFFFF;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2016年3月13日，2016年中超联赛第2轮：重庆力帆vs河南建业，主场美女球迷争芳斗艳。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;color:#666666;font-family:\'Microsoft Yahei\', 微软雅黑, SimSun, 宋体, \'Arial Narrow\', serif;font-size:14px;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/upload/2016/03/13/56e51cb17542e.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/upload/2016/03/13/56e51cb180f8a.png&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;/span&gt;\r\n&lt;/p&gt;', '1457855680', '0');
INSERT INTO `tb_news_content` VALUES ('14', '24', '<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	新浪体育讯　　北京时间2016年3月12日晚7点35分，2016年中超联赛第2轮的一场比赛在天津水滴体育场进行。由天津泰达主场对阵广州富力。上半场双方机会都不多，<strong>下半场第57分钟，常飞亚左路护住皮球回做，汪嵩迎球直接远射世界波破门。随后天津泰达尽管全力进攻，但伊万诺维奇和迪亚涅都浪费了近在咫尺的机会</strong>，最终不得不0-1主场告负。\r\n</p>\r\n<p>\r\n	<img src=\"/upload/2016/03/13/56e51f63a5742.png\" alt=\"\" width=\"474\" height=\"301\" title=\"\" align=\"\" /> \r\n</p>\r\n<p>\r\n	由于首轮中超对阵北京国安的比赛延期举行，因此本场比赛实际上是天津泰达本赛季的首次亮相。新援蒙特罗领衔锋线，两名外援中后卫均首发出场。另一方面，在首轮主场不敌中超新贵河北华夏之后，本赛季球员流失较多的广州富力也许不得不早早开始他们的保级谋划。本场陈志钊红牌停赛，澳大利亚外援吉安努顶替了上轮首发的肖智。\r\n</p>\r\n<p>\r\n	广州富力显然更快地适应了比赛节奏。第3分钟，吉安努前插领球大步杀入禁区形成单刀，回防的赞纳迪内果断放铲化解险情。第8分钟，雷纳尔迪尼奥左路踩单车过人后低平球传中，约万诺维奇伸出大长腿将球挡出底线。第14分钟，富力队左路传中到远点，聂涛头球解围险些失误，送出本场比赛第一个角球。\r\n</p>\r\n<p>\r\n	天津队中场的配合逐渐找到一些感觉。第23分钟，天津队通过一连串小配合打到左路，周海滨下底传中被挡出底线。角球被富力队顶出后天津队二次将球传到禁区前沿，蒙特罗转身后射门但软弱无力被程月磊得到。第27分钟，约万诺维奇断球后直塞蒙特罗，蒙特罗转身晃开后卫在禁区外大力轰门打高。第29分钟，瓦格纳任意球吊入禁区，程月磊出击失误没有击到球，天津队后点将球再次传中，姜至鹏在对方夹击下奋力将球顶出底线。\r\n</p>\r\n<p>\r\n	双方都没有太好的打开僵局的办法，开始陷入苦战。第33分钟，常飞亚左路晃开空档突然起脚，皮球擦着近门柱稍稍偏出底线。第43分钟，白岳峰被雷纳尔迪尼奥断球得手，后者利用速度甩开约万诺维奇，低平球传中又躲过了赞纳迪内的滑铲，但吉安努门前近在咫尺的推射被杨启鹏神奇地单腿挡出！双方半场只得0-0互交白卷。\r\n</p>\r\n<p>\r\n	中场休息双方都没有换人。第47分钟，蒙特罗前场扣过多名对方队员后将球交给周海滨，但周海滨传中时禁区内的胡人天越位在先。第51分钟，王嘉楠右路晃开聂涛下底，但传中球又高又远。第54分钟，雷纳尔迪尼奥中场拿球挑过李本舰，后者无奈将其放倒吃到黄牌。第57分钟，常飞亚左路护住皮球回做，汪嵩迎球直接远射，杨启鹏鞭长莫及，皮球呼啸着直挂远角！世界波！富力队客场1-0取得领先。\r\n</p>\r\n<p>\r\n	第62分钟，瓦格纳任意球吊到禁区，程月磊再次拿球脱手，幸亏张耀坤将球踢出了边线。天津队率先做出调整，迪亚涅和周通两名前锋登场换下郭皓和瓦格纳。第64分钟，天津队右路传中，周通禁区内甩头攻门，程月磊侧扑将球得到。富力队并未保守。第66分钟，常飞亚左路连续盘带杀入禁区，小角度射门打偏。不过一分钟，雷纳尔迪尼奥禁区右角远射，皮球在门前反弹后稍稍偏出。\r\n</p>\r\n<p>\r\n	第71分钟，吉安努禁区角上回做，常飞亚跟进远射，杨启鹏单掌将球托出。天津队马上打出反击，蒙特罗禁区内转身将球分到右路，胡人天的传中找到后排插上的周海滨，但后者的大力头球顶得太正被程月磊侯个正着。富力队肖智换下卢琳。第74分钟，迪亚涅依靠强壮的身体杀入禁区直塞，蒙特罗停球后射门被密集防守的后卫挡出。\r\n</p>\r\n<p>\r\n	于洋换下雷纳尔迪尼奥，富力队加强防守。第81分钟，天津队角球开出，迪亚涅甩头攻门顶偏。天津队连续得到角球机会。第85分钟，天津队角球二次进攻，周通传中，蒙特罗后点头球回做，约万诺维奇离门不到两米处转身扫射竟然将球踢飞！\r\n</p>\r\n<div id=\"ad_33\" class=\"otherContent_01\" style=\"margin:10px 20px 10px 0px;padding:4px;\">\r\n	<iframe width=\"300px\" height=\"250px\" frameborder=\"0\" src=\"http://img.adbox.sina.com.cn/ad/28543.html\">\r\n	</iframe>\r\n</div>\r\n<p>\r\n	天津队范柏群换下李本舰。富力队用宁安换下常飞亚。第88分钟，胡人天战术犯规吃到黄牌。天津队久攻不下，第90分钟，赞纳迪内40米开外远射打偏。第93分钟，蒙特罗左路传中，迪亚涅头球争顶下来之后顺势扫射，皮球贴着横梁高出。广州富力最终将优势保持到了终场取得三分。\r\n</p>\r\n<p>\r\n	进球信息：\r\n</p>\r\n<p>\r\n	天津泰达：无。\r\n</p>\r\n<p>\r\n	广州富力：第58分钟，卢琳左路回做，汪嵩跟上远射破网。\r\n</p>\r\n<p>\r\n	黄牌信息：\r\n</p>\r\n<p>\r\n	天津泰达：第54分钟，李本舰。第88分钟，胡人天。\r\n</p>\r\n<p>\r\n	广州富力：无。\r\n</p>\r\n<p>\r\n	红牌信息：\r\n</p>\r\n<p>\r\n	无。\r\n</p>\r\n<p>\r\n	双方出场阵容：\r\n</p>\r\n<p>\r\n	天津泰达（4-5-1）：29-杨启鹏，23-聂涛、3-赞纳迪内、5-约万诺维奇、19-白岳峰，6-周海滨、7-李本舰（86分钟，28-范柏群）、8-胡人天、11-瓦格纳（63分钟，9-迪亚涅）、22-郭皓（63分钟，33-周通），10-蒙特罗；\r\n</p>\r\n<p>\r\n	广州富力（4-5-1）：1-程月磊，11-姜至鹏、5-张耀坤、22-张贤秀、28-王嘉楠，7-斯文森、21-常飞亚（88分钟，15-宁安）、23-卢琳（73分钟，29-肖智）、31-雷纳尔迪尼奥（77分钟，3-于洋）、33-汪嵩，9-吉安努。\r\n</p>\r\n<p>\r\n	（卢小挠）\r\n</p>\r\n<div>\r\n</div>\r\n<div style=\"font-size:0px;\">\r\n</div>\r\n<p>\r\n	<br />\r\n</p>', '1457856460', '0');

-- ----------------------------
-- Table structure for tb_position
-- ----------------------------
DROP TABLE IF EXISTS `tb_position`;
CREATE TABLE `tb_position` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_position
-- ----------------------------
INSERT INTO `tb_position` VALUES ('6', '首页主推', '1', '电影推荐', '1489223056', '0');
INSERT INTO `tb_position` VALUES ('7', '排行推荐', '1', '电影排行推荐', '1489223155', '0');
INSERT INTO `tb_position` VALUES ('8', '排行推荐', '1', '相关音乐推荐', '1489223206', '0');
INSERT INTO `tb_position` VALUES ('9', '', '1', null, '1489230400', '0');

-- ----------------------------
-- Table structure for tb_position_content
-- ----------------------------
DROP TABLE IF EXISTS `tb_position_content`;
CREATE TABLE `tb_position_content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(5) unsigned NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) unsigned NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_position_content
-- ----------------------------

-- ----------------------------
-- Table structure for tb_rank_movie
-- ----------------------------
DROP TABLE IF EXISTS `tb_rank_movie`;
CREATE TABLE `tb_rank_movie` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(8) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `pic` varchar(255) NOT NULL,
  `grade` double(5,0) NOT NULL,
  `listorder` int(8) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `push_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_rank_movie
-- ----------------------------
INSERT INTO `tb_rank_movie` VALUES ('124', '27', '1', '', '/upload/2017/03/11/58c3b4f626fe3.jpg', '0', '0', '-1', '0');
INSERT INTO `tb_rank_movie` VALUES ('125', '17', 'aaaaaa', '', '/upload/2017/03/07/58be9b1210494.jpg', '0', '0', '-1', '0');
INSERT INTO `tb_rank_movie` VALUES ('126', '24', '444', null, '/upload/2017/03/08/58c021118ab4d.jpg', '0', '0', '-1', '0');
INSERT INTO `tb_rank_movie` VALUES ('127', '28', '小王子2', '', '/upload/2017/03/16/58caa29e6697a.jpg', '0', '0', '1', '1489674976');

-- ----------------------------
-- Table structure for tb_rank_music
-- ----------------------------
DROP TABLE IF EXISTS `tb_rank_music`;
CREATE TABLE `tb_rank_music` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `music_id` int(8) NOT NULL,
  `music_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `num` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_rank_music
-- ----------------------------

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `user_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLoginTime` datetime NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `status` tinyint(6) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'admin', '123456', '0000-00-00 00:00:00', null, null, '1');
INSERT INTO `tb_user` VALUES ('2', 'jvbdsjvnaj', 'fhdfkdfnkds', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('3', 'xxxl', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00 00:00:00', null, null, '1');
INSERT INTO `tb_user` VALUES ('4', 'xxll', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('5', 'ada', '68053af2923e00204c3ca7c6a3150cf7', '0000-00-00 00:00:00', null, null, '1');
INSERT INTO `tb_user` VALUES ('6', 'aaaaaa', '93279e3308bdbbeed946fc965017f67a', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('7', 'aaaaa2', '7fa8282ad93047a4d6fe6111c93b308a', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('8', 'aaaaa3', '3d2172418ce305c7d16d4b05597c6a59', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('9', 'aaaaa6', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('10', '136aaa', '388c0c4fc22d8c2f74695413ee0e8e04', '0000-00-00 00:00:00', null, null, '0');
INSERT INTO `tb_user` VALUES ('11', '136ass', '388c0c4fc22d8c2f74695413ee0e8e04', '0000-00-00 00:00:00', null, null, '0');
