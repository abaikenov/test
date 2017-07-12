/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-12 19:36:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `task`
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8,
  `user` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `image` text,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('1', 'Заголовок 1', 'Task description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n', 'Василий Пупкин', 'v.pupkin@gmail.com', '1', null, '2017-07-12 13:48:31', '2017-07-12 13:48:31');
INSERT INTO `task` VALUES ('2', 'Заголовок 2', 'Task description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n', 'Иосиф Кабзон', 'i.kabzon@gmail.com', '1', null, '2017-07-12 15:39:40', '2017-07-12 15:39:40');
INSERT INTO `task` VALUES ('3', 'Заголовок 3', 'Task description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n', 'Анна Семенович', 'a.semenovich@gmail.com', '1', null, '2017-07-12 15:39:41', '2017-07-12 15:39:41');
INSERT INTO `task` VALUES ('4', 'Заголовок 4', 'Task description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n', 'Сергей Безруков', 's.bezrukov@gmail.com', '1', null, '2017-07-12 13:48:59', '2017-07-12 13:48:59');
INSERT INTO `task` VALUES ('5', 'Заголовок 5', 'Task description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n', 'Бил Гейтс', 'b.geits@gmail.com', '1', null, '2017-07-12 17:09:09', '2017-07-12 17:09:09');
INSERT INTO `task` VALUES ('11', 'wd', 'Решил быстро и надежно', 'asdasd', 'wwww@sdw', '1', null, '2017-07-12 17:09:13', '2017-07-12 17:09:13');
INSERT INTO `task` VALUES ('14', 'asd', 'asdasd', 'asdasd', 'Ami0790@mail.ru', '0', null, '2017-07-12 17:12:21', '2017-07-12 17:12:21');
INSERT INTO `task` VALUES ('15', 'dwdwd', 'wwdwd', 'asdasd', 'Ami0790@mail.ru', '0', '/uploads/c40572ba074a6186bd612a0e855aa37cd3401fac.jpg', '2017-07-12 19:19:31', '2017-07-12 19:19:31');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '2017-07-12 16:53:00', '2017-07-12 16:53:00');
