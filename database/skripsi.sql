/*
 Navicat Premium Data Transfer

 Source Server         : MySql
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : skripsi

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 08/05/2021 11:05:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for applications
-- ----------------------------
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `applications_project_id_index`(`project_id`) USING BTREE,
  CONSTRAINT `applications_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of applications
-- ----------------------------
INSERT INTO `applications` VALUES (1, 3, 'SIMULTAN', '2021-03-09 07:27:20', '2021-03-09 01:20:29');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for forums
-- ----------------------------
DROP TABLE IF EXISTS `forums`;
CREATE TABLE `forums`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT NULL,
  `komentar` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 376 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of forums
-- ----------------------------
INSERT INTO `forums` VALUES (366, NULL, 'test dis kusi', '6', '2021-04-27 02:47:07', NULL, '2021-04-27 02:47:07');
INSERT INTO `forums` VALUES (367, 366, '@Lauren ngapain', '7', '2021-04-27 02:47:17', NULL, '2021-04-27 02:47:17');
INSERT INTO `forums` VALUES (368, 366, '@dimas gapgap', '6', '2021-04-27 02:47:25', NULL, '2021-04-27 02:47:25');
INSERT INTO `forums` VALUES (369, 366, '@Lauren yaudah', '7', '2021-04-27 02:47:32', NULL, '2021-04-27 02:47:32');
INSERT INTO `forums` VALUES (370, 366, '@dimas oke', '7', '2021-04-27 02:55:25', NULL, '2021-04-27 02:55:25');
INSERT INTO `forums` VALUES (371, 366, '@Lauren 2323', '7', '2021-04-27 03:00:54', NULL, '2021-04-27 03:00:54');
INSERT INTO `forums` VALUES (372, NULL, 'tst', '6', '2021-04-27 03:06:57', NULL, '2021-04-27 03:06:57');
INSERT INTO `forums` VALUES (373, NULL, 'knnn', '7', '2021-04-27 03:07:31', NULL, '2021-04-27 03:07:31');
INSERT INTO `forums` VALUES (374, NULL, 'kntl', '7', '2021-04-27 03:10:33', NULL, '2021-04-27 03:10:33');
INSERT INTO `forums` VALUES (375, 374, '@dimas Hallo', '6', '2021-04-27 03:11:07', NULL, '2021-04-27 03:11:07');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (3, '2021_01_29_183409_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (4, '2021_01_29_183650_create_products_table', 2);
INSERT INTO `migrations` VALUES (5, '2014_10_12_100000_create_password_resets_table', 3);
INSERT INTO `migrations` VALUES (6, '2021_04_18_091349_create_projects_table', 4);
INSERT INTO `migrations` VALUES (7, '2021_04_18_091616_create_applications_table', 5);
INSERT INTO `migrations` VALUES (8, '2021_04_18_091736_create_schedule_activities_table', 6);
INSERT INTO `migrations` VALUES (9, '2021_04_18_095820_create_schedule_activities_table', 7);
INSERT INTO `migrations` VALUES (10, '2021_04_18_102000_create_schedule_activities_table', 8);
INSERT INTO `migrations` VALUES (11, '2021_04_18_104249_create_schedule_activities_table', 9);
INSERT INTO `migrations` VALUES (12, '2021_04_18_115142_create_new_assignments_table', 10);
INSERT INTO `migrations` VALUES (13, '2021_04_18_115414_create_new_assignment_employees_table', 11);
INSERT INTO `migrations` VALUES (14, '2021_04_18_125542_add_status_new_assignment_employees_table', 12);
INSERT INTO `migrations` VALUES (15, '2021_04_18_154527_add_status_schedule_activities_table', 13);
INSERT INTO `migrations` VALUES (16, '2021_04_18_160058_add_status_schedule_activities_table', 14);
INSERT INTO `migrations` VALUES (17, '2021_04_18_205114_add_fk_schedule_activities_table', 15);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 6);
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 7);
INSERT INTO `model_has_roles` VALUES (5, 'App\\User', 9);

-- ----------------------------
-- Table structure for new_assignment_employees
-- ----------------------------
DROP TABLE IF EXISTS `new_assignment_employees`;
CREATE TABLE `new_assignment_employees`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `new_assignment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `new_assignment_employees_created_by_index`(`created_by`) USING BTREE,
  INDEX `new_assignment_employees_new_assignment_id_index`(`new_assignment_id`) USING BTREE,
  INDEX `new_assignment_employees_user_id_index`(`user_id`) USING BTREE,
  CONSTRAINT `new_assignment_employees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `new_assignment_employees_new_assignment_id_foreign` FOREIGN KEY (`new_assignment_id`) REFERENCES `new_assignments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `new_assignment_employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of new_assignment_employees
-- ----------------------------

-- ----------------------------
-- Table structure for new_assignments
-- ----------------------------
DROP TABLE IF EXISTS `new_assignments`;
CREATE TABLE `new_assignments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `alarm` time(0) NULL DEFAULT NULL,
  `file` json NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `new_assignments_created_by_index`(`created_by`) USING BTREE,
  INDEX `new_assignments_project_id_index`(`project_id`) USING BTREE,
  INDEX `new_assignments_application_id_index`(`application_id`) USING BTREE,
  CONSTRAINT `new_assignments_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `new_assignments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `new_assignments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of new_assignments
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'role-list', 'web', '2021-01-29 18:59:32', '2021-01-29 18:59:32');
INSERT INTO `permissions` VALUES (2, 'role-create', 'web', '2021-01-29 18:59:32', '2021-01-29 18:59:32');
INSERT INTO `permissions` VALUES (3, 'role-edit', 'web', '2021-01-29 18:59:32', '2021-01-29 18:59:32');
INSERT INTO `permissions` VALUES (4, 'role-delete', 'web', '2021-01-29 18:59:32', '2021-01-29 18:59:32');
INSERT INTO `permissions` VALUES (5, 'dashboard-list', 'web', '2021-01-29 18:59:32', '2021-01-29 18:59:32');
INSERT INTO `permissions` VALUES (9, 'user-list', 'web', '2021-03-08 06:37:15', '2021-03-08 06:37:15');
INSERT INTO `permissions` VALUES (10, 'user-create', 'web', '2021-03-08 06:37:15', '2021-03-08 06:37:15');
INSERT INTO `permissions` VALUES (11, 'user-edit', 'web', '2021-03-08 06:37:15', '2021-03-08 06:37:15');
INSERT INTO `permissions` VALUES (12, 'user-delete', 'web', '2021-03-08 06:37:15', '2021-03-08 06:37:15');
INSERT INTO `permissions` VALUES (13, 'project-list', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (14, 'project-create', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (15, 'project-edit', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (16, 'project-delete', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (17, 'application-list', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (18, 'application-create', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (19, 'application-edit', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (20, 'application-delete', 'web', '2021-03-09 00:06:20', '2021-03-09 00:06:20');
INSERT INTO `permissions` VALUES (21, 'new-assignment-list', 'web', '2021-03-10 00:11:44', '2021-03-10 00:11:44');
INSERT INTO `permissions` VALUES (22, 'new-assignment-create', 'web', '2021-03-10 00:11:44', '2021-03-10 00:11:44');
INSERT INTO `permissions` VALUES (23, 'new-assignment-edit', 'web', '2021-03-10 00:11:44', '2021-03-10 00:11:44');
INSERT INTO `permissions` VALUES (24, 'new-assignment-delete', 'web', '2021-03-10 00:11:44', '2021-03-10 00:11:44');
INSERT INTO `permissions` VALUES (25, 'schedule-activity-list', 'web', '2021-03-16 03:24:03', '2021-03-16 03:24:03');
INSERT INTO `permissions` VALUES (26, 'schedule-activity-create', 'web', '2021-03-16 03:24:03', '2021-03-16 03:24:03');
INSERT INTO `permissions` VALUES (27, 'schedule-activity-edit', 'web', '2021-03-16 03:24:03', '2021-03-16 03:24:03');
INSERT INTO `permissions` VALUES (28, 'schedule-activity-delete', 'web', '2021-03-16 03:24:03', '2021-03-16 03:24:03');
INSERT INTO `permissions` VALUES (29, 'schedule-activity-show', 'web', '2021-03-16 03:27:07', '2021-03-16 03:27:07');
INSERT INTO `permissions` VALUES (38, 'priority-list', 'web', '2021-04-18 12:45:42', '2021-04-18 12:45:42');
INSERT INTO `permissions` VALUES (39, 'priority-show', 'web', '2021-04-18 12:45:42', '2021-04-18 12:45:42');

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (2, 'PTM', '2021-04-18 16:15:36', '2021-04-18 16:15:38');
INSERT INTO `projects` VALUES (3, 'BBLK', '2021-04-18 16:15:36', '2021-04-18 16:15:38');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 3);
INSERT INTO `role_has_permissions` VALUES (2, 3);
INSERT INTO `role_has_permissions` VALUES (3, 3);
INSERT INTO `role_has_permissions` VALUES (4, 3);
INSERT INTO `role_has_permissions` VALUES (5, 3);
INSERT INTO `role_has_permissions` VALUES (9, 3);
INSERT INTO `role_has_permissions` VALUES (10, 3);
INSERT INTO `role_has_permissions` VALUES (11, 3);
INSERT INTO `role_has_permissions` VALUES (12, 3);
INSERT INTO `role_has_permissions` VALUES (13, 3);
INSERT INTO `role_has_permissions` VALUES (14, 3);
INSERT INTO `role_has_permissions` VALUES (15, 3);
INSERT INTO `role_has_permissions` VALUES (16, 3);
INSERT INTO `role_has_permissions` VALUES (17, 3);
INSERT INTO `role_has_permissions` VALUES (18, 3);
INSERT INTO `role_has_permissions` VALUES (19, 3);
INSERT INTO `role_has_permissions` VALUES (20, 3);
INSERT INTO `role_has_permissions` VALUES (21, 3);
INSERT INTO `role_has_permissions` VALUES (22, 3);
INSERT INTO `role_has_permissions` VALUES (23, 3);
INSERT INTO `role_has_permissions` VALUES (24, 3);
INSERT INTO `role_has_permissions` VALUES (25, 3);
INSERT INTO `role_has_permissions` VALUES (26, 3);
INSERT INTO `role_has_permissions` VALUES (27, 3);
INSERT INTO `role_has_permissions` VALUES (28, 3);
INSERT INTO `role_has_permissions` VALUES (29, 3);
INSERT INTO `role_has_permissions` VALUES (38, 3);
INSERT INTO `role_has_permissions` VALUES (39, 3);
INSERT INTO `role_has_permissions` VALUES (5, 4);
INSERT INTO `role_has_permissions` VALUES (25, 4);
INSERT INTO `role_has_permissions` VALUES (26, 4);
INSERT INTO `role_has_permissions` VALUES (27, 4);
INSERT INTO `role_has_permissions` VALUES (28, 4);
INSERT INTO `role_has_permissions` VALUES (29, 4);
INSERT INTO `role_has_permissions` VALUES (38, 4);
INSERT INTO `role_has_permissions` VALUES (39, 4);
INSERT INTO `role_has_permissions` VALUES (5, 5);
INSERT INTO `role_has_permissions` VALUES (21, 5);
INSERT INTO `role_has_permissions` VALUES (25, 5);
INSERT INTO `role_has_permissions` VALUES (26, 5);
INSERT INTO `role_has_permissions` VALUES (27, 5);
INSERT INTO `role_has_permissions` VALUES (28, 5);
INSERT INTO `role_has_permissions` VALUES (29, 5);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (3, 'Manager', 'web', '2021-01-29 19:06:15', '2021-01-29 19:06:15');
INSERT INTO `roles` VALUES (4, 'Employee', 'web', '2021-03-08 05:34:24', '2021-03-08 05:34:24');
INSERT INTO `roles` VALUES (5, 'Admin', 'web', '2021-03-16 07:44:32', '2021-03-16 07:44:32');

-- ----------------------------
-- Table structure for schedule_activities
-- ----------------------------
DROP TABLE IF EXISTS `schedule_activities`;
CREATE TABLE `schedule_activities`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `constraint` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `hour_start` time(0) NULL DEFAULT NULL,
  `hour_end` time(0) NULL DEFAULT NULL,
  `file` json NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `new_assignment_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `schedule_activities_created_by_index`(`created_by`) USING BTREE,
  INDEX `schedule_activities_project_id_index`(`project_id`) USING BTREE,
  INDEX `schedule_activities_application_id_index`(`application_id`) USING BTREE,
  INDEX `schedule_activities_new_assignment_id_index`(`new_assignment_id`) USING BTREE,
  CONSTRAINT `schedule_activities_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `schedule_activities_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `schedule_activities_new_assignment_id_foreign` FOREIGN KEY (`new_assignment_id`) REFERENCES `new_assignments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `schedule_activities_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schedule_activities
-- ----------------------------
INSERT INTO `schedule_activities` VALUES (1, 6, 6, 3, 1, '2021-04-18', '<p>asdasd</p>', 'Ada', '<p>123123123</p>', '12:00:00', '05:00:00', '[\"assets/NewAss/35989.WhatsApp Image 2021-03-24 at 15.25.04 (1).jpeg\"]', '2021-04-18 10:45:19', '2021-04-18 17:24:57', 1, NULL);

-- ----------------------------
-- Table structure for t1
-- ----------------------------
DROP TABLE IF EXISTS `t1`;
CREATE TABLE `t1`  (
  `rec_num` int(11) NULL DEFAULT NULL,
  `jdoc` json NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t1
-- ----------------------------
INSERT INTO `t1` VALUES (1, '{\"fish\": [\"red\", \"blue\"]}');
INSERT INTO `t1` VALUES (2, '{\"fish\": [\"one\", \"two\", \"three\"]}');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone_number` bigint(20) NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (6, 'Lauren', 'Dhanty.ramamif@gmail.com', NULL, '$2y$10$hGvzIakfvGs9ANheMNevW.BPD8hAwstAn8I1KAnB0e8ViPK7GQQ9q', NULL, NULL, NULL, '2021-01-29 19:06:15', '2021-02-05 00:38:45', 4);
INSERT INTO `users` VALUES (7, 'dimas', 'dimas.yogi.777@gmail.com', NULL, '$2y$10$z2R9rOlH35nx1G4CPJHpeeb2iN5tsjOiDULfNVne1JWd4y7J/R8DG', NULL, 1234567, 'assets/user/ouFppsWC63KzEdzlQeC7tthpzT9ARn7fA4c30OmH.jpg', '2021-03-08 07:03:00', '2021-03-08 07:03:00', 4);
INSERT INTO `users` VALUES (8, 'Pratama', 'laurenpratama777@gmail.com', NULL, '$2y$10$z2R9rOlH35nx1G4CPJHpeeb2iN5tsjOiDULfNVne1JWd4y7J/R8DG', NULL, 1234567, 'assets/user/ouFppsWC63KzEdzlQeC7tthpzT9ARn7fA4c30OmH.jpg', '2021-03-08 07:03:00', '2021-03-08 07:03:00', 4);
INSERT INTO `users` VALUES (9, 'Rahul Shukla', 'admin@rscoder.com', NULL, '$2y$10$L1mztX4d40PBHZ/YVDAuHecgIa7vl5bbZEGYxzcvaFN624BTmwTje', NULL, NULL, NULL, '2021-03-16 07:44:32', '2021-03-16 07:44:32', NULL);

SET FOREIGN_KEY_CHECKS = 1;
