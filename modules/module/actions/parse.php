<?php
$parameter = $_GET['name'] ?? '';
if($parameter)
{
    $q = db_query("SELECT * FROM $module_table WHERE name='$parameter'");
    if($d=db_fetch_array($q))
    {
        $php_code = $d['code'];
        
        set_error_handler(function($errno, $errstr, $errfile, $errline){
            if($errno === E_WARNING){
                throw new warningException($errstr . ' on line  ' . $errline);
            }     
        });
                
        if(strlen($php_code))
        {
            try
            {                                     
                eval($php_code);
            }
            catch (Error $e)
            {                
                echo json_encode('Error: ' . $e->getMessage() . ' on line ' . $e->getLine() );
                exit();
            } 
            catch (warningException $e) 
            {               
                echo json_encode($e->errorMessage() );
                exit();
            }
            finally 
            {
                restore_error_handler();
            }
        }
        
        exit();        
    }
    else
    {
        echo "Invalid parameter!";
    }
}
else
{
    echo "No parameter!";
}
?>