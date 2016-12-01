/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50716
 Source Host           : localhost
 Source Database       : earmusic

 Target Server Type    : MySQL
 Target Server Version : 50716
 File Encoding         : utf-8

 Date: 12/01/2016 18:53:03 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `prefix_slideshow_home`
-- ----------------------------
DROP TABLE IF EXISTS `prefix_slideshow_home`;
CREATE TABLE `prefix_slideshow_home` (
  `in_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `in_cover` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `in_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `in_link` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `in_hide` int(11) DEFAULT '0',
  PRIMARY KEY (`in_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `prefix_slideshow_home`
-- ----------------------------
BEGIN;
INSERT INTO `prefix_slideshow_home` VALUES ('1', 'data/attachment/slideshow/home/cover/image2.png', '1', 'http://www.baidu.com', '0'), ('2', 'data/attachment/slideshow/home/cover/image3.png', '1', 'http://www.baidu.com', '0'), ('3', 'data/attachment/slideshow/home/cover/image4.png', '1', 'http://www.baidu.com', '0'), ('4', 'data/attachment/slideshow/home/cover/image5.png', '1', 'http://www.baidu.com', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
