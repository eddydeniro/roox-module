<?php

class custom_module
{   
    static function include()
    {             
        global $custom_module_table, $plugin_name;

        $exclude_code_id = false;
        //skip in custom_php page
        if(isset($_SERVER['REQUEST_URI']) and strstr($_SERVER['REQUEST_URI'],"module={$plugin_name}/code/") and isset($_POST['code_id']) and $_POST['code_id']>0)
        {
            $exclude_code_id = _POST('code_id');
        }
        
        $code_query = db_query("SELECT * FROM $custom_module_table WHERE is_folderr=0 and is_active=1 " . ($exclude_code_id ? " AND id!=" . $exclude_code_id : "") );
        while($code = db_fetch($code_query))
        {
            if(strlen($code->code))
            {
                try
                {                                     
                    eval($code->code);
                }
                catch (Error $e)
                {
                    //skip code with erros
                } 
            }
        }
    }
        
    static function get_tree($parent_id = 0, $tree = array(), $level = 0)
    {
        global $custom_module_table;

        $code_query = db_query("SELECT * FROM $custom_module_table WHERE parent_id=" . $parent_id . " ORDER BY sort_order, name");

        while($code = db_fetch_array($code_query))
        {
            $code['level'] = $level;

            $tree[] = $code;

            $tree = self::get_tree($code['id'], $tree, $level + 1);
        }

        return $tree;
    }
    
    static function get_folder_choices()
    {
        $choices = array();
        $choices[''] = '';

        foreach(self::get_tree() as $v)
        {
            if($v['is_folder'])
            {
                $choices[$v['id']] = str_repeat(' - ', $v['level']) . $v['name'];
            }
        }

        return $choices;
    }       
                        
}
