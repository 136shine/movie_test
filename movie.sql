/*
Navicat MySQL Data Transfer

Source Server         : blog
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : movie

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-03-30 17:10:32
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
  `lastlogintime` datetime DEFAULT '0000-00-00 00:00:00',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('1', 'admin', 'd099d126030d3207ba102efa8e60630a', '0', '0000-00-00 00:00:00', 'tracywxh0830@126.com', 'singwa', '1');

-- ----------------------------
-- Table structure for tb_comment
-- ----------------------------
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(50) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `time` datetime NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `listorder` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_comment
-- ----------------------------
INSERT INTO `tb_comment` VALUES ('4', '血战钢锯岭', '未知', '<div style=\"color:#666666;font-family:宋体, Arial, Helvetica, sans-serif;font-size:14px;background-color:#FFFFFF;\">\r\n	真的已经快忘记了梅尔·吉布森这个曾经的大明星，以至于一时间都实在想不起来《勇敢的心》的片名，还是在上网查了一下才想起他曾经最为经典的一部作品。据说被好莱坞封杀了10年，这部《血战钢锯岭》也算是梅尔·吉布森的一次回归，若非本片有关梅尔·吉布森的话题也已经很久没有被人提起，好在这部', '1', '0000-00-00 00:00:00', '影评网', '2', '《血战钢锯岭》：敢于直面惨淡的人生才是真正的勇士', '');
INSERT INTO `tb_comment` VALUES ('3', '一只狗的使命', '90后作家罗毅祥  ', '<img src=\"http://www.51oscar.com/Uploads/image/20170307/water_17223443882.jpg\" width=\"400\" height=\"260\" title=\"pic-0\" alt=\"pic-0\" /><p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\"><br />\r\n	</p>\r\n<p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\">\r\n	凡是涉及到小猫小狗小动物题材的电影，如果不是让人发笑的喜剧，便一定是能把人虐哭的正剧。\r\n</p>\r\n<p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\"><br />\r\n	</p>\r\n<p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\">\r\n	《一条狗的使命》便是这样一部能让人泪湿春衫袖却又温情四溢的关于一只小狗前世今生轮回转世的悲喜自传。\r\n</p>\r\n<p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\">\r\n	不错，这部电影是一只狗的自传，导演用一只狗的视角和狗的心理依次讲述了自己在轮回转世中所经历的五个主人的故事。五个故事，五次轮回，五段生死，其中最长的故事耗时一个小时，最短的则不超过五分钟。\r\n	</p>\r\n<p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\">\r\n	这部电影的导演是莱塞·霍尔斯道姆。也许你不认识他，但你一定知道《忠犬八公的故事》——一只叫小八的秋田犬用它至死不渝的忠诚和爱感动过亿万观众的故事。《一条狗的使命》正是莱塞导演最新的力作。\r\n</p>\r\n<p style=\"color:#333333;font-family:arial, \" font-size:16px;text-indent:32px;\"=\"\">\r\n	如果《八公》让你哭得泣不成声，那么《使命》绝对能让你哭得肝肠寸断。\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>', '1', '2017-03-22 00:00:00', '大众影评网', '0', '电影《一条狗的使命》：爱与被爱的使命', '/upload/2017/03/26/58d790a37c9b8.jpg');
INSERT INTO `tb_comment` VALUES ('5', '123666', '1', '<p>\r\n	<img src=\"/upload/2017/03/26/58d7904ce9abd.png\" alt=\"\" />\r\n</p>\r\n<p>\r\n	场女爱索多女错扩\r\n</p>', '-1', '2016-09-23 00:00:00', '3', '0', '23', '/upload/2017/03/26/58d7902f57dff.png');

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_menu
-- ----------------------------
INSERT INTO `tb_menu` VALUES ('1', '', '0', '', '', '', '', '0', '-1', '0');
INSERT INTO `tb_menu` VALUES ('14', '电影管理', '0', 'admin', 'movie', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('15', '菜单管理', '0', 'admin', 'menu', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('26', '用户管理', '0', 'admin', 'user', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('17', '推荐详情管理', '0', 'admin', 'recomment', 'index', '', '0', '-1', '1');
INSERT INTO `tb_menu` VALUES ('18', '相关音乐管理', '0', 'admin', 'music', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('19', '影评管理', '0', 'admin', 'comment', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('20', '留言管理', '0', 'admin', 'message', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('21', '电影推荐排行管理', '0', 'admin', 'rank_movie', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('22', '基本配置管理', '0', 'admin', 'basic', 'index', '', '0', '1', '1');
INSERT INTO `tb_menu` VALUES ('23', '电影推荐', '0', 'home', 'movie', 'index', '', '3', '1', '0');
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
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_movie_detail
-- ----------------------------
INSERT INTO `tb_movie_detail` VALUES ('42', '49', '菲丽希缇·琼斯 / 迭戈·鲁纳 / 甄子丹 / 本·门德尔森 / 麦斯·米科尔森 / 艾伦·图代克 / 福里斯特·惠特克 / 姜文 / 里兹·阿迈德 / 乔纳森·阿里斯 / 尤妮斯·奥卢米德 / 克莱尔·陈 / 吉米·斯密茨 / 沃维克·戴维斯 / 马克·普雷斯顿 / 吉娜薇·欧瑞丽 / 詹姆斯·厄尔·琼斯 ', '加里斯·爱德华斯', '&lt;span style=&quot;color:#666666;font-family:&amp;quot;font-size:14px;background-color:#FFFFFF;&quot;&gt;这是一个战火频燃、纷争不断的动荡时代，一群有志之士集结在一起，计划盗走帝国大规模杀伤性武器“死星”的设计图。这个在《星球大战》系列里非常著名的重点事件 ，让一群平凡普通人结成了同盟，决定为世界的改变做出贡献；而在绝密行动的进行中，他们也逐渐成长为顶天立地的英雄。&lt;/span&gt;', '10', '6730000');
INSERT INTO `tb_movie_detail` VALUES ('43', '50', '米拉·乔沃维奇 / 伊恩·格雷 / 艾丽·拉特 / 鲁比·罗丝 / 李准基 / 肖恩·罗伯茨 / 威廉·莱维 / 欧文·马肯 / 罗拉 / 艾尔·安德森 / 密尔顿·施尔 / 西沃恩·霍奇森 / 凯文·奥托 / 保罗·汉普赛尔', '保罗·安德森', '&lt;span style=&quot;color:#666666;font-family:&amp;quot;font-size:14px;background-color:#FFFFFF;&quot;&gt;爱丽丝（米拉·乔沃维奇 Milla Jovovich 饰）在华盛顿特区被威斯克背叛后身陷险境，人类几乎要失去最后的希望。作为唯一的幸存者，也是人类对抗僵尸大军的最后防线，爱丽丝必须回到噩梦开始的地方——浣熊市，才能完成拯救世界救赎人类的正义使命。回归故事发生的起点浣熊市，爱丽丝将和昔日的朋友一起', '18', '87340000');
INSERT INTO `tb_movie_detail` VALUES ('44', '51', '迈克尔·法斯宾德 / 玛丽昂·歌迪亚 / 杰瑞米·艾恩斯 / 布莱丹·格里森 / 夏洛特·兰普林 / 迈克尔·威廉姆斯 / 丹尼斯·门诺切特 / 亚里安妮·拉贝德 / 赫立德·阿卜杜拉 / 艾斯·戴维斯 / 马蒂亚斯·瓦雷拉 / 卡勒姆·特纳 / 卡洛斯·巴登 / 哈维尔·古铁雷斯 / 霍威克·库区科利安', '贾斯汀·库泽尔', '&lt;span style=&quot;color:#666666;font-family:&amp;quot;font-size:14px;background-color:#FFFFFF;&quot;&gt;卡勒姆·林奇（迈克尔·法斯宾德 饰）在死刑即将执行之前清醒过来，发现他被索菲娅（玛丽昂·歌迪亚 饰）选中，来参加一个能让人类摆脱暴力冲动的计划。虚拟现实机器Animus能让用户体验祖先的记忆，被绑在机器上之后，卡勒姆·林奇意识到他是生活在西班牙宗教法庭时期一位刺客阿圭拉的后裔，他们寻找的是可以控', '23', '5623000');
INSERT INTO `tb_movie_detail` VALUES ('36', '43', ' 艾玛·沃森 / 丹·史蒂文斯 / 卢克·伊万斯 / 凯文·克莱恩 / 乔什·加德', '比尔·康顿', '《美女与野兽》根据迪士尼1991年经典动画片及闻名全球的经典童话改编，讲述了少女贝儿的奇幻旅程——为了解救触怒野兽的父亲，勇敢善良的她只身一人来到古堡，代替父亲被囚禁其中。贝儿克服了恐惧，和城堡里的魔法家具们成为了朋友，也渐渐发现野兽其实是受了诅咒的王子，他可怖的外表下藏着一颗善良温柔的内心；这个故事也带领观众明白——美不仅仅是外表，更重要的是内心。', '1', '1200000');
INSERT INTO `tb_movie_detail` VALUES ('37', '44', '布丽特·罗伯森 / 丹尼斯·奎德 / 佩吉·利普顿 / 乔什·加德 / K·J·阿帕', '拉斯·霍尔斯道姆  ', '　影片以汪星人的视角展现狗狗和人类的微妙情感，一只狗狗陪伴小主人长大成人，甚至为他追到了女朋友，后来它年迈死去又转世投胎变成其他性别和类型的汪，第二次轮回狗狗变成了警犬威风凛凛，再次转轮回，又成了陪伴一位单身女青年的小柯基犬。在经历了多次轮回之后，最终回到最初的主人身边。', '6', '120000');
INSERT INTO `tb_movie_detail` VALUES ('38', '45', ' 汤姆·希德勒斯顿 / 布丽·拉尔森 / 塞缪尔·杰克逊 / 约翰·古德曼 / 景甜', '乔丹·沃格特-罗伯茨', '上世纪70年代，一支集结了科考队员、探险家、战地摄影记者、军人的探险队，冒险前往南太平洋上的神秘岛屿——骷髅岛。他们的到来惊扰了岛上之神——史上最大金刚。经过一番惨烈的激战之后，探险队员散落在了岛屿各处。此时，队员们才意识到这次探险并不是一次单纯的科考任务，而是去探索怪兽存在的证明。 \r\n　　在这片与世隔绝、危险密布的丛林，无数怪异的史前生物暗藏其中，时刻威胁着他们的生命。队员们还遇到了神秘的原始部落，金刚的身世和其守护岛屿的原因也被逐渐揭开，原来，恐怖阴森的骷髅岛上还蛰伏着更凶狠残暴的怪兽……', '10', '23090000');
INSERT INTO `tb_movie_detail` VALUES ('39', '46', '休·杰克曼 / 帕特里克·斯图尔特 / 达芙妮·基恩 / 波伊德·霍布鲁克 / 斯戴芬·莫昌特 ', '詹姆斯·曼高德', '故事发生在2029年，彼时，X战警早已经解散，作为为数不多的仅存的变种人，金刚狼罗根（休·杰克曼 Hugh Jackman 饰）和卡利班（斯戴芬·莫昌特 Stephen Merchant 饰）照顾着年迈的X教授（帕特里克·斯图尔特 Patrick Stewart 饰），由于衰老，X教授已经丧失了对于自己超能力的控制，如果不依赖药物，他的超能力就会失控，在全球范围内制造无法挽回的灾难。不仅如此，金刚狼的自愈能力亦随着时间的流逝逐渐减弱，体能和力量都早已经大不如从前。 \r\n　　某日，一位陌生女子找到了金刚狼，', '12', '4580000');
INSERT INTO `tb_movie_detail` VALUES ('40', '47', '瑞恩·高斯林 / 艾玛·斯通 / 约翰·传奇 / 罗丝玛丽·德薇特 / 芬·维特洛克', '达米恩·查泽雷', '米娅（艾玛·斯通 Emma Stone 饰）渴望成为一名演员，但至今她仍旧只是片场咖啡厅里的一名平凡的咖啡师，尽管不停的参加着大大小小的试镜，但米娅收获的只有失败。某日，在一场派对之中，米娅邂逅了名为塞巴斯汀（瑞恩·高斯林 Ryan Gosling 饰）的男子，起初两人之间产生了小小的矛盾，但很快，米娅便被塞巴斯汀身上闪耀的才华以及他对爵士乐的纯粹追求所吸引，最终两人走到了一起。 \r\n　　在塞巴斯汀的鼓励下，米娅辞掉了咖啡厅的工作，专心为自己写起了剧本，与此同时，塞巴斯汀为了获得一份稳定的收入，加入了一支', '6', '78230000');
INSERT INTO `tb_movie_detail` VALUES ('41', '48', ' 神木隆之介 / 上白石萌音 / 长泽雅美 / 市原悦子 / 成田凌 ', ' 新海诚', '在远离大都会的小山村，住着巫女世家出身的高中女孩宫水三叶（上白石萌音 配音）。校园和家庭的原因本就让她充满烦恼，而近一段时间发生的奇怪事件，又让三叶摸不清头脑。不知从何时起，三叶在梦中就会变成一个住在东京的高中男孩。那里有陌生的同学和朋友，有亲切的前辈和繁华的街道，一切都是如此诱人而真实。另一方面，住在东京的高中男孩立花泷（神木隆之介 配音）则总在梦里来到陌生的小山村，以女孩子的身份过着全新的生活。许是受那颗神秘彗星的影响，立花和三叶在梦中交换了身份。他们以他者的角度体验着对方的人生，这期间有愤怒、有欢笑', '13', '45000000');

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
  `push_time` datetime NOT NULL,
  `rank` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_rank_movie
-- ----------------------------
INSERT INTO `tb_rank_movie` VALUES ('128', '44', '一只狗的使命', null, '/upload/2017/03/22/58d2666c65d59.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('129', '43', '美女与野兽', null, '/upload/2017/03/22/58d2488d93075.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('130', '45', '金刚：骷髅岛 ', null, '/upload/2017/03/24/58d4c0cfd9c45.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('131', '47', '爱乐之城', null, '/upload/2017/03/24/58d4d2b65ef0f.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('132', '48', '你的名字', null, '/upload/2017/03/24/58d4d376c1d95.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('133', '44', '一只狗的使命', null, '/upload/2017/03/22/58d2666c65d59.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('134', '43', '美女与野兽', null, '/upload/2017/03/22/58d2488d93075.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('135', '45', '金刚：骷髅岛 ', null, '/upload/2017/03/24/58d4c0cfd9c45.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('136', '47', '爱乐之城', null, '/upload/2017/03/24/58d4d2b65ef0f.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('137', '48', '你的名字', null, '/upload/2017/03/24/58d4d376c1d95.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('138', '44', '一只狗的使命', null, '/upload/2017/03/22/58d2666c65d59.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('139', '43', '美女与野兽', null, '/upload/2017/03/22/58d2488d93075.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('188', '47', '爱乐之城', null, '/upload/2017/03/24/58d4d2b65ef0f.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('189', '48', '你的名字', null, '/upload/2017/03/24/58d4d376c1d95.jpg', '0', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('191', '44', '一只狗的使命', null, '/upload/2017/03/22/58d2666c65d59.jpg', '9', '0', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `tb_rank_movie` VALUES ('192', '45', '金刚：骷髅岛 ', null, '/upload/2017/03/24/58d4c0cfd9c45.jpg', '6', '2', '1', '0000-00-00 00:00:00', '13');
INSERT INTO `tb_rank_movie` VALUES ('193', '48', '你的名字', null, '/upload/2017/03/24/58d4d376c1d95.jpg', '8', '0', '1', '0000-00-00 00:00:00', '13');
INSERT INTO `tb_rank_movie` VALUES ('194', '44', '一只狗的使命', null, '/upload/2017/03/22/58d2666c65d59.jpg', '9', '0', '1', '0000-00-00 00:00:00', '12');
INSERT INTO `tb_rank_movie` VALUES ('195', '46', '金刚狼3：殊死一战 ', null, '/upload/2017/03/24/58d4c2540f002.jpg', '8', '0', '1', '0000-00-00 00:00:00', '12');
INSERT INTO `tb_rank_movie` VALUES ('196', '43', '美女与野兽', null, '/upload/2017/03/22/58d2488d93075.jpg', '7', '3', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `tb_rank_movie` VALUES ('197', '46', '金刚狼3：殊死一战 ', null, '/upload/2017/03/24/58d4c2540f002.jpg', '8', '0', '1', '0000-00-00 00:00:00', '12');

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
-- Table structure for tb_review
-- ----------------------------
DROP TABLE IF EXISTS `tb_review`;
CREATE TABLE `tb_review` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `avator` varchar(255) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_review
-- ----------------------------
INSERT INTO `tb_review` VALUES ('63', '43', '13', null, '66666', '2017-03-26 12:17:21', '123');
INSERT INTO `tb_review` VALUES ('62', '43', '13', null, '4545', '2017-03-26 12:15:35', '123');

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
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('12', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-28 10:13:14', '1262359762@qq.com', '15779707825', '1', '', '0');
INSERT INTO `tb_user` VALUES ('13', '123', '202cb962ac59075b964b07152d234b70', '2017-03-28 09:37:19', null, null, '-1', null, '0');
