/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : laravel

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 20/09/2020 19:08:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_permission_role`;
CREATE TABLE `admin_permission_role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of admin_permission_role
-- ----------------------------
INSERT INTO `admin_permission_role` VALUES (5, 6, 6, NULL, NULL);
INSERT INTO `admin_permission_role` VALUES (2, 5, 6, NULL, NULL);
INSERT INTO `admin_permission_role` VALUES (3, 5, 7, NULL, NULL);
INSERT INTO `admin_permission_role` VALUES (6, 7, 6, NULL, NULL);
INSERT INTO `admin_permission_role` VALUES (7, 7, 7, NULL, NULL);
INSERT INTO `admin_permission_role` VALUES (8, 7, 8, NULL, NULL);

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (6, 'posts', '文章模块', '2020-06-27 11:53:00', '2020-06-27 12:23:54');
INSERT INTO `admin_permissions` VALUES (7, 'topics', '专题模块', '2020-06-27 11:53:14', '2020-06-27 12:23:50');
INSERT INTO `admin_permissions` VALUES (8, 'system', '系统模块', '2020-06-28 20:42:28', '2020-06-28 20:42:28');

-- ----------------------------
-- Table structure for admin_role_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_user`;
CREATE TABLE `admin_role_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of admin_role_user
-- ----------------------------
INSERT INTO `admin_role_user` VALUES (8, 7, 15);
INSERT INTO `admin_role_user` VALUES (9, 6, 19);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_time` tinyint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (7, '管理员', '管理员', 0, '2020-06-28 20:42:56', '2020-06-28 20:42:56');

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_show` tinyint(3) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (19, 'admin1', '$2y$10$E9ELuLMEQjmq647QeZujQ.ISbfhsQF7u53deFnv1JQPzosAu6WUVO', 1, NULL, '2020-06-22 12:45:51', '2020-09-14 22:22:19');
INSERT INTO `admin_users` VALUES (15, 'admin', '$2y$10$coktYiH9rUl6Zhbv8vaKh.ruF.VqbOcDYuFX4AH/hsPnCIltySmoa', 1, NULL, '2020-06-22 12:34:35', '2020-06-28 20:43:16');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT 0,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (3, 50, '这是一条测试评论', 1, '2020-05-21 16:08:25', '2020-05-21 16:08:25');
INSERT INTO `comments` VALUES (4, 50, '这是一条测试评论', 1, '2020-05-21 17:03:55', '2020-05-21 17:03:55');
INSERT INTO `comments` VALUES (5, 50, '这是一条测试评论', 2, '2020-05-21 17:04:09', '2020-05-21 17:04:09');
INSERT INTO `comments` VALUES (6, 50, '这是一条测试评论', 2, '2020-05-21 17:09:15', '2020-05-21 17:09:15');
INSERT INTO `comments` VALUES (7, 49, '111', 1, '2020-05-21 17:44:09', '2020-05-21 17:44:09');
INSERT INTO `comments` VALUES (8, 51, '1', 1, '2020-06-08 09:36:18', '2020-06-08 09:36:18');

-- ----------------------------
-- Table structure for fans
-- ----------------------------
DROP TABLE IF EXISTS `fans`;
CREATE TABLE `fans`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fan_id` int(11) NOT NULL DEFAULT 0,
  `star_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of fans
-- ----------------------------
INSERT INTO `fans` VALUES (12, 1, 2, '2020-06-23 22:47:13', '2020-06-23 22:47:13');
INSERT INTO `fans` VALUES (11, 2, 1, '2020-06-23 21:07:53', '2020-06-23 21:07:53');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (3, '2020_05_15_070547_create_posts_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_05_21_151603_create_comments_table', 2);
INSERT INTO `migrations` VALUES (5, '2020_05_21_171122_create_zans_comments_table', 3);
INSERT INTO `migrations` VALUES (6, '2020_05_21_171336_create_zans_table', 4);
INSERT INTO `migrations` VALUES (7, '2020_06_02_185232_create_topics_table', 5);
INSERT INTO `migrations` VALUES (8, '2020_06_02_185502_create_post_topics_table', 5);
INSERT INTO `migrations` VALUES (9, '2020_06_03_113220_alter_usets_table', 6);
INSERT INTO `migrations` VALUES (10, '2020_06_08_095318_create_fans_table', 7);
INSERT INTO `migrations` VALUES (11, '2020_06_21_160605_create_admin_users_table', 8);
INSERT INTO `migrations` VALUES (12, '2020_06_24_102910_create_admin_roles_table', 9);
INSERT INTO `migrations` VALUES (13, '2020_06_24_104425_create_permission_and_roles_table', 10);

-- ----------------------------
-- Table structure for post_topics
-- ----------------------------
DROP TABLE IF EXISTS `post_topics`;
CREATE TABLE `post_topics`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT 0,
  `topic_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of post_topics
-- ----------------------------
INSERT INTO `post_topics` VALUES (19, 57, 2, '2020-06-23 22:47:04', '2020-06-23 22:47:04');
INSERT INTO `post_topics` VALUES (16, 57, 1, '2020-06-23 16:18:48', '2020-06-23 16:18:48');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT 0 COMMENT '0未知1通过，-1删除',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `delete_time` bigint(11) NOT NULL DEFAULT 0 COMMENT '删除时间，',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (58, '这里是标题', '<p>2222222222222222222</p>', 1, 1, 1592916586, '2020-06-23 16:19:38', '2020-06-23 20:49:46');
INSERT INTO `posts` VALUES (57, '这里是标题', '<p>``````````</p>', 1, 1, 0, '2020-06-23 16:18:36', '2020-06-23 19:28:52');

-- ----------------------------
-- Table structure for topics
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL,
  `delete_time` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES (8, '感情11111', 1, 0, '2020-06-24 10:03:11', '2020-06-24 16:37:11');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin1', 'admin@qq.com', NULL, '$2y$10$JVHf5obh4TpI2qIBY2lxR.D.vE85TRigPjpHGuvkAhauVx8Kw5wze', 'vxRHfzOy6Fbu5s7FL9viGu7s6FFRYlHanUiyjBE6WB51ptLkmtBS5mhIzZ4x', '2020-05-16 11:25:57', '2020-06-08 09:36:36', 'http://laravel.com/storage/2020-06/M338FwW1KFS670TGEvyTF3p50PkRZOx62CtmnYKs.jpeg');
INSERT INTO `users` VALUES (2, 'admins', 'admins@qq.com', NULL, '$2y$10$hi22qDsot.snh47YYBjN9OTRzwEeh/hpjNdXjifq/FM/3Nx5k70q2', 'JXBXpAFlwfxKGR7GkbiJllcOLHegOYWFrvaDPhHgtNL5WKT7h8JD5L5XfDlN', '2020-05-16 13:05:49', '2020-05-16 13:05:49', '');

-- ----------------------------
-- Table structure for zans
-- ----------------------------
DROP TABLE IF EXISTS `zans`;
CREATE TABLE `zans`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `post_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of zans
-- ----------------------------
INSERT INTO `zans` VALUES (11, 2, 57, '2020-06-23 21:07:44', '2020-06-23 21:07:44');

SET FOREIGN_KEY_CHECKS = 1;
