<?php
//check access
if($app_user['group_id']>0)
{
    redirect_to('dashboard/access_forbidden');
}

class warningException extends Exception {
  public function errorMessage() {    
    $errorMsg =  'Warning: '. $this->getMessage();
    return $errorMsg;
  }
}

switch($app_module_action)
{
    case 'check_unique':
        $name = $_POST['name'];
        $id = $_POST['id'];
        $id_filter = $id ? "AND id<>$id" : "";
        $check_query = db_query("SELECT COUNT(*) AS total FROM $custom_module_table WHERE name='$name' $id_filter");
        $check = db_fetch_array($check_query);

        if($check['total']>0)
        {
            $msg = TEXT_UNIQUE_FIELD_VALUE_ERROR;
            echo json_encode($msg);
        }
        else
        {
            echo json_encode(true);
        }
        exit();
        break;
    case 'validate':
       
        $php_code = $_POST['code'];
        
        set_error_handler(function($errno, $errstr, $errfile, $errline){
            if($errno === E_WARNING){
                throw new warningException($errstr . ' on line  ' . $errline);
            }     
        });
        
        echo json_encode(true);
        
        exit();
        
        break;
    case 'save':

        $is_folder = $_POST['is_folder']??0;
        $name = $_POST['name']??'';
        $code_id = _POST('code_id');
                        
        $sql_data = array(
            'parent_id' => (isset($_POST['parent_id']) ? $_POST['parent_id'] : 0),
            'is_active' => $_POST['is_active']??0,
            'is_folder' => $is_folder,
            'name' => $name,
            'code' => $_POST['code']??'',            
            'notes' => $_POST['notes']??'',
            'sort_order' => $_POST['sort_order'],
            
        );               

        if($code_id>0)
        {
            db_perform($custom_module_table, $sql_data, 'update', "id='" . db_input($code_id) . "'");
        }
        else
        {
            db_perform($custom_module_table, $sql_data);
            $code_id = db_insert_id();
        }
        
        if($_POST['is_crtl_s']==1)
        {       
            echo $code_id;
            exit();
        }
        else
        {
            redirect_to("$plugin_name/custom_module/code");
        }

        break;
    case 'delete':
        $obj = db_find($custom_module_table, $_GET['id']);

        db_delete_row($custom_module_table, $_GET['id']);

        db_query("UPDATE $custom_module_table SET parent_id=0 WHERE parent_id='" . _get::int('id') . "'");

        $alerts->add(sprintf(TEXT_WARN_DELETE_SUCCESS, $obj['name']), 'success');

        redirect_to("$plugin_name/custom_module/code");
        break;
}
    