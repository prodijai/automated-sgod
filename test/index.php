<?php

include("../system/functions.php");

$link_id = "1";
$permission_list = array('add-new-field-form','delete-form-data','edit-form-data','input-form','list-form-data','list-forms');
applyPermissions($permission_list,$link_id);

?>