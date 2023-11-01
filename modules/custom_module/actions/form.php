<?php

$obj = array();

if(isset($_GET['id']))
{
  $obj = db_find($custom_module_table, $_GET['id']);  
}
else
{
  $obj = db_show_columns($custom_module_table);
  $obj['is_active'] = 1;
  $obj['is_folder'] = $_GET['is_folder']??0;
  $obj['parent_id'] = $_GET['parent_id']??0;
}
