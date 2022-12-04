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







########################################################################################



CREATE TABLE `rose_branches` ( `id` INT NOT NULL AUTO_INCREMENT , `company_id` INT NOT NULL , `name` CHAR(50) NOT NULL , `country` VARCHAR NOT NULL , `region` VARCHAR NOT NULL , `city` VARCHAR NOT NULL , `postbox` VARCHAR NOT NULL , `phone` VARCHAR NOT NULL , `email` VARCHAR NOT NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `rose_company_branches` ( `id` INT NOT NULL AUTO_INCREMENT , `company_id` INT(11) NOT NULL , `branch_id` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `rose_accounts` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_account_screen` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_activities` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_additionals` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_attendances` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_banks` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_channel` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_channel_bill` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_config_meta` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_cost_centers` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_countries` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_currencies` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_customers` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_customer_groups` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_customer_group_entries` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_custom_entries` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_custom_fields` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_departments` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_drafts` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_draft_items` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_email_settings` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_events` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_event_relations` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_global_settings` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_goals` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_history` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_history_types` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_hrm_metas` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_invoices` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_invoice_items` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_menus` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_messages` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_meta_entries` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_miscs` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_notes` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_notifications` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_oauth_access_tokens` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_oauth_auth_codes` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_oauth_clients` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_oauth_personal_access_clients` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_oauth_refresh_tokens` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_opening_balances` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_ordered_supply` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_ordered_supply_items` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_orders` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_order_items` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_pages` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_participants` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_password_resets` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_permissions` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_permission_role` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_permission_user` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_prefixes` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_products` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_product_categories` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_product_contains` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_product_meta` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_product_variables` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_projects` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_project_logs` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_project_meta` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_project_milestones` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_project_relations` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_purchase_orders` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_purchase_order_items` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_quotes` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_quote_items` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_registers` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_roles` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_role_user` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_screens` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_sessions` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_settings_required_fields` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_sms_settings` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_sub_taxes` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_suppliers` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_taxes` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_templates` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_terms` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_threads` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_todolists` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_todolist_relations` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_transactions` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_transaction_categories` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_transaction_history` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_units` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_users` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_user_gateways` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_user_gateway_entries` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_user_profiles` ADD `branch_id` INT(11) NULL AFTER `id`;
ALTER TABLE `rose_warehouses` ADD `branch_id` INT(11) NULL AFTER `id`;


CREATE TABLE `rose_users_branches` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL , `branch_id` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `rose_branches` ADD `is_active` TINYINT NOT NULL DEFAULT '0' AFTER `id`;



ALTER TABLE `rose_branches` CHANGE `country` `country` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `region` `region` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `city` `city` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `postbox` `postbox` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `phone` `phone` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `email` `email` VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

####################################################################################33

ALTER TABLE `rose_product_variables`
  DROP `name_en`,
  DROP `code`,
  DROP `type`,
  DROP `val`,
  DROP `rid`;



  CREATE TABLE `rose_product_variable_values` (`id` INT NOT NULL AUTO_INCREMENT , `product_variable_id` INT NULL , `value` VARCHAR(256) NULL , `ins` INT NULL , `updated_at` TIMESTAMP NULL , `created_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `rose_product_variable_values` ADD `branch_id` INT NULL AFTER `id`;

ALTER TABLE `rose_products`
  DROP `unit`,
  DROP `code_type`,
  DROP `stock_type`;

ALTER TABLE `rose_products` ADD `type` VARCHAR(256) NULL AFTER `name`;

ALTER TABLE `rose_products` ADD `price` DOUBLE NULL AFTER `type`;

ALTER TABLE `rose_product_variations`
  DROP `parent_id`,
  DROP `variation_class`;

  CREATE TABLE `rose_product_variations_values` (`id` INT NOT NULL AUTO_INCREMENT , `product_variation_id` INT NULL , `product_variable_value_id` INT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `rose_products` CHANGE `type` `type` ENUM('normal','variable') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;



RENAME TABLE `elhosseny`.`rose_product_variables` TO `elhosseny`.`rose_product_variabls`;

CREATE TABLE `rose_product_variables` ( `id` int(11) NOT NULL AUTO_INCREMENT, `branch_id` int(11) DEFAULT NULL, `name` varchar(20) NOT NULL, `ins` int(4) unsigned NOT NULL DEFAULT 0, `created_at` timestamp NOT NULL DEFAULT current_timestamp(), `updated_at` timestamp NOT NULL DEFAULT current_timestamp(), PRIMARY KEY (`id`) USING BTREE, KEY `ins` (`ins`) USING BTREE, CONSTRAINT `rose_product_variabels_ibfk_1` FOREIGN KEY (`ins`) REFERENCES `rose_companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;