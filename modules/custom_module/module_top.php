<?php 
  $app_title = app_set_title(TEXT_CUSTOM_MODULE);

  require("plugins/$plugin_name/classes/custom_module.php");
 
  $custom_module_table = "app_{$plugin_name}_custom_module";
  if (!isset($_SESSION[$custom_module_table]) || !$_SESSION[$custom_module_table]) 
  {
      $template_table_query = "CREATE TABLE IF NOT EXISTS `{$custom_module_table}` (`id` int UNSIGNED NOT NULL AUTO_INCREMENT, `parent_id` int UNSIGNED NOT NULL, `is_active` tinyint UNSIGNED NOT NULL, `is_folder` tinyint UNSIGNED NOT NULL, `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, `code` longtext COLLATE utf8mb4_general_ci NOT NULL, `notes` mediumtext COLLATE utf8mb4_general_ci NOT NULL, `sort_order` int UNSIGNED NOT NULL, PRIMARY KEY (`id`), KEY `idx_parent_id` (`parent_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
      is_table_exist($custom_module_table, $template_table_query);
      $_SESSION[$custom_module_table] = true;    
  }  
 