<?php
    $module_table = "{$plugin_name}_{$module_name}";
    if(!is_table_exist($module_table)) 
    {
        $table_query = "CREATE TABLE IF NOT EXISTS `{$module_table}` (`id` int UNSIGNED NOT NULL AUTO_INCREMENT, `parent_id` int UNSIGNED NOT NULL, `is_active` tinyint UNSIGNED NOT NULL, `is_folder` tinyint UNSIGNED NOT NULL, `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, `code` longtext COLLATE utf8mb4_general_ci NOT NULL, `notes` mediumtext COLLATE utf8mb4_general_ci NOT NULL, `sort_order` int UNSIGNED NOT NULL, PRIMARY KEY (`id`), KEY `idx_parent_id` (`parent_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        db_query($table_query);
        db_query("
            INSERT INTO `{$dictionary_table}` (`dict_key`, `dict_value`) VALUES
            ('TEXT_CUSTOM_MODULE', 'Custom Module'),
            ('TEXT_CUSTOM_MODULE_INFO', 'Create a PHP script to return view, data, or any other purposes and access it at module=".'{$plugin_name}'."/module/parse&name=PARAMETER_NAME.'),
            ('TEXT_PARAMETER_NAME', 'Parameter Name');        
        ");
    }  
?>