<?php
$menu = [];
if(!$app_user['group_id'])
{
    $menu = ['title'=>TEXT_CUSTOM_MODULE, 'url'=>url_for(ROOX_PLUGIN."/".$module."/code"), 'class'=>'fa-refresh'];
}
?>