/*
Navicat MySQL Data Transfer

Source Server         : 127
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : escape

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-30 16:57:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for e_config
-- ----------------------------
DROP TABLE IF EXISTS `e_config`;
CREATE TABLE `e_config` (
  `id` int(1) NOT NULL,
  `sysemname` varchar(20) DEFAULT NULL COMMENT '公司名称',
  `asrega` varchar(60) DEFAULT NULL COMMENT '地址',
  `edition` varchar(10) DEFAULT NULL COMMENT '联系手机',
  `addtime` int(10) DEFAULT NULL,
  `defaultnick` varchar(80) DEFAULT NULL COMMENT '联系电话',
  `content` text,
  `contents` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e_config
-- ----------------------------
INSERT INTO `e_config` VALUES ('1', '海南世纪畅想旅游咨询有限公司', '中国北京', '1311313111', '1538221302', '0539455555', '1', '1');

-- ----------------------------
-- Table structure for e_manage
-- ----------------------------
DROP TABLE IF EXISTS `e_manage`;
CREATE TABLE `e_manage` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL COMMENT '后台y用户',
  `pasword` varchar(60) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e_manage
-- ----------------------------
INSERT INTO `e_manage` VALUES ('1', 'admin', '550e1bafe077ff0b0b67f4e32f29d751');

-- ----------------------------
-- Table structure for e_slideshow
-- ----------------------------
DROP TABLE IF EXISTS `e_slideshow`;
CREATE TABLE `e_slideshow` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `imgs` varchar(150) DEFAULT NULL,
  `addtime` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e_slideshow
-- ----------------------------
INSERT INTO `e_slideshow` VALUES ('1', 'public/images/image_banner_01.png', '1538219225', '1');
INSERT INTO `e_slideshow` VALUES ('2', 'public/images/image_banner_02.png', null, '1');
INSERT INTO `e_slideshow` VALUES ('3', '', null, '1');
INSERT INTO `e_slideshow` VALUES ('4', '', null, '1');

-- ----------------------------
-- Table structure for e_video
-- ----------------------------
DROP TABLE IF EXISTS `e_video`;
CREATE TABLE `e_video` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vname` varchar(100) DEFAULT NULL,
  `addtime` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e_video
-- ----------------------------
INSERT INTO `e_video` VALUES ('1', 'uploads/video/5bb06f0bb8ad0.mp4', '1538289419');
INSERT INTO `e_video` VALUES ('2', 'uploads/video/5bb070f6b6983.mp4', '1538289910');
INSERT INTO `e_video` VALUES ('3', 'uploads/video/5bb072508dc26.mp4', '1538290256');
INSERT INTO `e_video` VALUES ('4', 'uploads/video/5bb075a0057d3.mp4', '1538291104');
INSERT INTO `e_video` VALUES ('5', 'uploads/video/5bb075e418146.mp4', '1538291172');
INSERT INTO `e_video` VALUES ('6', 'uploads/video/5bb07aa917629.mp4', '1538292393');
INSERT INTO `e_video` VALUES ('7', 'uploads/video/5bb07b7879172.mp4', '1538292600');
INSERT INTO `e_video` VALUES ('8', 'uploads/video/5bb07b87cc9b8.mp4', '1538292615');
INSERT INTO `e_video` VALUES ('9', 'uploads/video/5bb07c4380e4d.mp4', '1538292803');
INSERT INTO `e_video` VALUES ('10', 'uploads/video/5bb07c74480a1.mp4', '1538292852');
INSERT INTO `e_video` VALUES ('11', 'uploads/video/5bb07caa8b3cc.mp4', '1538292906');
