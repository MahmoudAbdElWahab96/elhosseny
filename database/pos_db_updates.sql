
ALTER TABLE `rose_attendances` ADD `ip_address` VARCHAR(255) NULL DEFAULT NULL AFTER `ins`, ADD `image` VARCHAR(120) NULL DEFAULT 'default.png' AFTER `ip_address`, ADD `latitude` VARCHAR(255) NULL DEFAULT NULL AFTER `image`, ADD `longtitude` VARCHAR(255) NULL DEFAULT NULL AFTER `latitude`;
ALTER TABLE `rose_attendances` ADD `attendance_type` TINYINT(1) NOT NULL DEFAULT '1' AFTER `longtitude`;
ALTER TABLE `rose_attendances` CHANGE `image` `image` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'default.png';
ALTER TABLE `rose_users` ADD `increment` VARCHAR(100) NULL DEFAULT NULL AFTER `deleted_at`;
ALTER TABLE `rose_hrm_metas` ADD `shift` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;
//28/7/2021
INSERT INTO `rose_permissions` (`id`, `name`, `display_name`, `sort`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'attendance', 'Attendance', '0', '1', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `rose_permission_role` (`id`, `permission_id`, `role_id`) VALUES (NULL, '74', '3'), (NULL, '74', '4');
INSERT INTO `rose_permission_role` (`id`, `permission_id`, `role_id`) VALUES (NULL, '74', '3'), (NULL, '74', '4');
INSERT INTO `rose_permission_role` (`id`, `permission_id`, `role_id`) VALUES (NULL, '74', '8');