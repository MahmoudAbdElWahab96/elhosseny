ALTER TABLE `rose_cost_centers` ADD `cost_balance` FLOAT NULL AFTER `code`;

CREATE TABLE `pos`.`rose_account_cost_center` ( `id` INT NOT NULL AUTO_INCREMENT , `account_id` INT(11) NOT NULL , `cost_center_id` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `rose_accounts` CHANGE `account_type` `account_type` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `rose_accounts`
  DROP `cost_center_screens`,
  DROP `cost_center_screens_names`;


  ALTER TABLE `rose_accounts` ADD `debit` DECIMAL NULL DEFAULT '0.00' AFTER `holder`, ADD `credit` DECIMAL NULL DEFAULT '0.00' AFTER `debit`;
#######################################################################################

CREATE TABLE `rose_settings_required_fields` ( `id` INT NOT NULL AUTO_INCREMENT , `model_id` INT(11) NULL , `model_type` VARCHAR(256) NULL , `is_require` BOOLEAN NULL DEFAULT FALSE , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , `deleted_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `rose_settings_required_fields` ADD `field` VARCHAR(256) NULL AFTER `model_type`;

ALTER TABLE `rose_settings_required_fields` DROP `model_id`;

CREATE TABLE `rose_ordered_supply` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tid` bigint(20) unsigned NOT NULL,
  `orderedSupplydate` date NOT NULL,
  `orderedSupplyduedate` date NOT NULL,
  `subtotal` decimal(16,4) DEFAULT 0.0000,
  `shipping` decimal(16,4) DEFAULT 0.0000,
  `ship_tax` decimal(16,4) DEFAULT 0.0000,
  `ship_tax_type` enum('inclusive','exclusive','off','none') DEFAULT 'off',
  `ship_tax_rate` decimal(16,4) DEFAULT 0.0000,
  `discount` decimal(16,4) DEFAULT 0.0000,
  `extra_discount` decimal(16,4) DEFAULT 0.0000,
  `discount_rate` decimal(10,4) DEFAULT 0.0000,
  `tax` decimal(16,4) DEFAULT 0.0000,
  `total` decimal(16,4) DEFAULT 0.0000,
  `pmethod` varchar(25) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial','pending','overdue') NOT NULL DEFAULT 'due',
  `customer_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL,
  `pamnt` decimal(16,4) DEFAULT 0.0000,
  `items` decimal(10,4) NOT NULL,
  `tax_format` enum('exclusive','inclusive','off','cgst','igst') NOT NULL DEFAULT 'exclusive',
  `tax_id` bigint(20) DEFAULT 0,
  `discount_format` enum('%','flat','b_flat','b_per') NOT NULL DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term_id` bigint(20) unsigned DEFAULT NULL,
  `currency` int(4) DEFAULT NULL,
  `i_class` int(1) NOT NULL DEFAULT 0,
  `r_time` varchar(10) NOT NULL,
  `ins` int(4) unsigned NOT NULL DEFAULT 0,
  `order_id` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `ordered_supply_fk1` (`ins`) USING BTREE,
  KEY `customer_id` (`customer_id`) USING BTREE,
  KEY `ordered_supply_fk3` (`term_id`) USING BTREE,
  KEY `ordered_supply_fk4` (`user_id`) USING BTREE,
  CONSTRAINT `ordered_supply_fk1` FOREIGN KEY (`ins`) REFERENCES `rose_companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `ordered_supply_fk2` FOREIGN KEY (`customer_id`) REFERENCES `rose_customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `ordered_supply_fk3` FOREIGN KEY (`term_id`) REFERENCES `rose_terms` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `ordered_supply_fk4` FOREIGN KEY (`user_id`) REFERENCES `rose_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1840 DEFAULT CHARSET=utf8mb4


CREATE TABLE `rose_ordered_supply_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ordered_supply_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `product_name` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `product_qty` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `product_price` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `purchase_price` decimal(16,4) DEFAULT NULL,
  `product_tax` decimal(16,4) DEFAULT 0.0000,
  `product_discount` decimal(16,4) DEFAULT 0.0000,
  `product_subtotal` decimal(16,4) DEFAULT 0.0000,
  `total_tax` decimal(16,4) DEFAULT 0.0000,
  `total_discount` decimal(16,4) DEFAULT 0.0000,
  `product_des` text DEFAULT NULL,
  `i_class` int(1) NOT NULL DEFAULT 0,
  `unit` varchar(5) DEFAULT NULL,
  `serial` varchar(100) DEFAULT NULL,
  `unit_value` decimal(16,4) NOT NULL DEFAULT 1.0000,
  `ins` int(4) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `i_class` (`i_class`) USING BTREE,
  KEY `ordered_supply_items_fk1` (`ins`) USING BTREE,
  KEY `ordered_supply_items_fk2` (`ordered_supply_id`) USING BTREE,
  CONSTRAINT `ordered_supply_items_fk1` FOREIGN KEY (`ins`) REFERENCES `rose_companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `ordered_supply_items_fk2` FOREIGN KEY (`ordered_supply_id`) REFERENCES `rose_ordered_supply` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3721 DEFAULT CHARSET=utf8mb4


ALTER TABLE `rose_invoices` ADD `ordered_supply_id` INT(11) NOT NULL AFTER `id`;



INSERT INTO `rose_prefixes` (`id`, `ins`, `class`, `value`, `note`, `created_at`, `updated_at`) VALUES (NULL, '1', '11', 'SO', 'supplyOrdered', current_timestamp(), current_timestamp())


ALTER TABLE `rose_product_variables` ADD `name_en` VARCHAR(256) NULL AFTER `name`;


ALTER TABLE `rose_additionals` ADD `tax_id` INT(11) NULL AFTER `id`, ADD `code` VARCHAR(256) NULL AFTER `tax_id`, ADD `name_en` VARCHAR(256) NULL AFTER `code`;

ALTER TABLE `rose_invoices` ADD `sub_tax_id` INT(11) NULL AFTER `tax_id`;
