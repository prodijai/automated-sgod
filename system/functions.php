<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
session_start();

// ╔═╗╔═╗╔═╗╦ ╦╦═╗╦╔╦╗╦ ╦
// ╚═╗║╣ ║  ║ ║╠╦╝║ ║ ╚╦╝
// ╚═╝╚═╝╚═╝╚═╝╩╚═╩ ╩  ╩ 

function make_safe($variable) {
    $variable = strip_html_tags($variable);
	$bad = array("=","<", ">", "/","\"","`","~","'","$","%","#");
	$variable = str_replace($bad, "", $variable);
    $variable = mysql_real_escape_string(trim($variable));
    return $variable;
}

function strip_html_tags($text) {
    $text = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
			'@fu[^u]*?.*?ck@siu',
            '@<noembed[^>]*?.*?</noembed>@siu'
        ),
        array(
            '', '', '', '', '', '', '', '', '', ''), $text );
      
    return strip_tags( $text);
}
function filterurl($variable) {
    $variable = strip_html_tags($variable);
	$bad = array("=","<", ">","","`","~","'","$","%","#");
	$variable = str_replace($bad, "", $variable);
    $variable = mysql_real_escape_string(trim($variable));
    return $variable;
}

// ╔═╗╔═╗╦═╗╔╦╗  ╔═╗╦ ╦╔╗ ╔╦╗╦╔╦╗
// ╠╣ ║ ║╠╦╝║║║  ╚═╗║ ║╠╩╗║║║║ ║ 
// ╚  ╚═╝╩╚═╩ ╩  ╚═╝╚═╝╚═╝╩ ╩╩ ╩ 

if (isset($_POST['login_submit'])) {
	$username=make_safe($_POST['username']);
	$password=make_safe($_POST['password']);
	$password = sha1($password);
	validateLogin($username,$password);
}
elseif (isset($_POST['add_field'])) {

	$form_data = array(
		'name' => make_safe($_POST['field_name']),
		'code' => make_safe($_POST['field_code']),
		'placeholder' => make_safe($_POST['field_placeholder']),
		'type' => make_safe($_POST['field_type']),
		'field_value' => make_safe($_POST['field_value']),
		'valid_char' => make_safe($_POST['field_valid_char'])
	);

	submitData($form_data,"add-fields","system_fields",make_safe($_POST['field_code']));

}
elseif (isset($_POST['add_hnf'])) {

	$form_data = array(
		'name' => make_safe($_POST['field_name']),
		'content' => $_POST['field_content'],
		'type' => make_safe($_POST['field_type'])
	);

	submitData($form_data,"new-template","system_reports_hnf",make_safe($_POST['name']));

}
elseif (isset($_POST['add_field_inside'])) {
	$form_data = array(
		'name' => make_safe($_POST['field_name']),
		'code' => make_safe($_POST['field_code']),
		'placeholder' => make_safe($_POST['field_placeholder']),
		'type' => make_safe($_POST['field_type']),
		'field_value' => make_safe($_POST['field_value']),
		'valid_char' => make_safe($_POST['field_valid_char']),
		'required' => make_safe($_POST['field_required']),
		'form_link' => make_safe($_POST['field_form_link']),
		'entity_link' => make_safe($_POST['field_entity_link']),
		'field_order' => make_safe($_POST['field_order'])
	);

	$form_code = make_safe($_POST['form_code']);
	$entity_code = make_safe($_POST['entity_code']);

	if ($form_code == NULL) {
		$table = $entity_code;
	}
	else {
		$table = $form_code;
	}

	switch (make_safe($_POST['field_type'])) {
		case 'text':
			$type = "varchar";
			$max_char = "255";
			break;
		case 'select':
			$type = "text";
			$max_char = "0";
			break;
		case 'radio':
			$type = "text";
			$max_char = "0";
			break;
		case 'textarea':
			$type = "text";
			$max_char = "0";
			break;
		default:
			$type = "varchar";
			$max_char = "255";
			break;
		
	}

	$addColumnResult = addColumnToTable($table,make_safe($_POST['field_code']),$type,$max_char);


	if ($addColumnResult == "success") {
		submitData($form_data,"input-form","system_fields",make_safe($_POST['field_code']));
	}
	else {
		echo "error";
		echo $addColumnResult;
	}

}
elseif (isset($_POST['create_entity'])) {

	$form_data = array(
		'entity_name' => make_safe($_POST['entity_name']),
		'entity_code' => make_safe($_POST['entity_code']),
		'allow_login' => make_safe($_POST['enable_login']),
		'entity_description' => make_safe($_POST['entity_desc'])
	);

	submitData($form_data,"new-entity","system_entities",make_safe($_POST['entity_code']));

	//create code field
	$result0 = mysqli_query($conn,"SELECT * from system_entities WHERE entity_code = '".make_safe($_POST['entity_code'])."' LIMIT 1;");
	$row0 = mysqli_fetch_array($result0);

	$entity_id = $row0['id'];
	$field_name = make_safe($_POST['entity_name'])." Code";
	$field_code = make_safe($_POST['entity_code'])."_code";
	$field_placeholder = make_safe($_POST['entity_name'])." unique code";

	$form_data = array(
		'name' => $field_name,
		'code' => $field_code,
		'placeholder' => $field_placeholder,
		'type' => 'text',
		'field_value' => '',
		'valid_char' => 'any',
		'required' => 'required',
		'form_link' => '',
		'entity_link' => $entity_id,
		'field_order' => '0'
	);

	submitData($form_data,"new-entity","system_fields",$field_code);

}
elseif (isset($_POST['new_form'])) {

	$form_data = array(
		'form_name' => make_safe($_POST['form_name']),
		'form_code' => make_safe($_POST['form_code']),
		'form_description' => make_safe($_POST['form_desc']),
		'form_entity_link' => make_safe($_POST['form_link'])
	);

	$entity_id = make_safe($_POST['form_link']);
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
	#get entity code based from entity id
	$result = mysqli_query($conn,"SELECT * from system_entities WHERE id = $entity_id");

	$entity = mysqli_fetch_array($result);
	$entity_code = $entity['entity_code'];
	$form_code = make_safe($_POST['form_code']);

	$createTableResult = dbCreateTable($entity_code,$form_code);
	if ($createTableResult == "success") {
		submitData($form_data,"new-form","system_forms",make_safe($_POST['form_code']));
	}
	else {
		echo "error";
		echo $createTableResult;
	}
	
}
elseif (isset($_POST['save-entity'])) {

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$table_name = 'usr_' . make_safe($_POST['entity_code']);
	$field_code = make_safe($_POST['entity_code']) . '_code';

	// echo $table_name;

	$form_data = array();

	$result = mysqli_query($conn, "SHOW COLUMNS FROM ".$table_name."");
	if (!$result) {
	    echo 'Could not run query: ' . mysqli_error();
	    exit;
	}
	if (mysqli_num_rows($result) > 0) {
	    while ($row = mysqli_fetch_assoc($result)) {
	    	if(!(preg_match( '/^id.*/', $row['Field']))){
	    		$field_name = $row['Field'];
	    		// echo $field_name. ' is '. $_POST[''.$field_name.''] .'<br>';
	    		$form_data += array($field_name => $_POST[''.$field_name.'']);
	    	}
	    }
	}

	print_r($form_data); // insert this data to the data base
	# code...
	$success_message = "Unique ID is " . $_POST[''.$field_code.''];
	submitData($form_data,"input-entity","$table_name",$field_code,$success_message);

}
elseif (isset($_POST['save-form-data'])) {
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
	
	$table_name = 'usr_' . make_safe($_POST['form_code']);
	$field_code = 'unique_code';

	// echo $table_name;

	$form_data = array();

	$result = mysqli_query($conn, "SHOW COLUMNS FROM ".$table_name."");
	if (!$result) {
	    echo 'Could not run query: ' . mysqli_error();
	    exit;
	}
	if (mysqli_num_rows($result) > 0) {
	    while ($row = mysqli_fetch_assoc($result)) {
	    	if(!(preg_match( '/^id.*/', $row['Field']))){
	    		$field_name = $row['Field'];
	    		// echo $field_name. ' is '. $_POST[''.$field_name.''] .'<br>';
	    		$form_data += array($field_name => $_POST[''.$field_name.'']);
	    	}
	    }
	}

	print_r($form_data); // insert this data to the data base
	# code...
	$success_message = "Form data added to " . $_POST['unique_code'];
	submitData($form_data,"input-form","$table_name",$field_code,$success_message);
}
elseif (isset($_POST['save_config_report'])) {
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$report_id = make_safe($_POST['report_code']);

	// drop report field configs before adding new
	dbRowDelete('system_reports_config', "WHERE report_id = '$report_id'");
	
	// multiple insert
	for($i=1;$i<=$_POST["total_fields"];$i++){ 

		$field_code = make_safe($_POST["field_code_$i"]);
		$field_order = make_safe($_POST["field_order_$i"]);

		if($_POST["field_selected_$i"] == "on")  
		{  
			$form_data = array(
				'report_id' => $report_id,
				'field_id' => $field_code,
				'field_order' => $field_order
			);

			submitData($form_data,"list-reports","system_reports_config","id","test","false");
			header('location:'.$site_root.'?p=list-reports');
		}  
	}  
}
elseif (isset($_POST['new_report'])) {
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$report_name = make_safe($_POST['report_name']);
	$report_code = make_safe($_POST['report_code']);
	$report_description = make_safe($_POST['report_desc']);
	$report_header = make_safe($_POST['report_header']);
	$report_footer = make_safe($_POST['report_footer']);
	$report_link = make_safe($_POST['report_link']);


		$form_data = array(
			'report_code' => $report_code,
			'report_name' => $report_name,
			'report_description' => $report_description,
			'form_link' => $report_link,
			'report_header' => $report_header,
			'report_footer' => $report_footer
		);

		submitData($form_data,"new-report","system_reports",$report_code,"Added New Report","false");

		header('location:'.$site_root.'?p=configure-report&r_code='.$report_code.'');
}
elseif (isset($_POST['save_config_permission'])) {
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
	$permissions = mysqli_query($conn,"SELECT * FROM system_permissions ORDER BY id");
	$entity = mysqli_query($conn,"SELECT * FROM system_entities WHERE allow_login = 'yes' ORDER BY id");

	#drop database daata
	dbRowDelete("system_permissions_config", "WHERE id > 0");

	$i = 0; 
	while($permission_row = mysqli_fetch_array($permissions)){
		$i++;
		$perm_id = $permission_row['id'];
	    
	    mysqli_data_seek($entity, 0);
	    $i = 0;
	    while($entity_row = mysqli_fetch_array($entity)){
	      $i++;

	      $entity_id = $entity_row['id'];

	      $perm_ent_combination = $perm_id . "_" . $entity_id;

	      if($_POST["$perm_ent_combination"] == "on") {

			$form_data = array(
				'permission_id' => $perm_id,
				'entity_id' => $entity_id
			);

	      	#insert to database
	      	dbInsertData("system_permissions_config",$form_data);

	      } 

	    }

	}

	#Redirect to original page
	header('location:'.$site_root.'?p=list-permissions');
}
elseif (isset($_POST['edit-entity'])) {

	$row_id = make_safe($_POST['entity_id']);

	$form_data = array(
		'entity_name' => make_safe($_POST['entity_name']),
		'allow_login' => make_safe($_POST['enable_login']),
		'entity_description' => make_safe($_POST['entity_desc'])
	);

	$custom_message = "Entity <em>".make_safe($_POST['entity_name'])."</em> successfully updated.";
	updateData($form_data,'edit-entity','system_entities',$row_id,$custom_message);
}
elseif (isset($_POST['edit-form'])) {

	$row_id = make_safe($_POST['form_id']);

	$form_data = array(
		'form_name' => make_safe($_POST['form_name']),
		'form_description' => make_safe($_POST['form_desc'])
	);

	$custom_message = "Form <em>".make_safe($_POST['form_name'])."</em> successfully updated.";
	updateData($form_data,'edit-form','system_forms',$row_id,$custom_message);

}
elseif (isset($_POST['edit-report'])) {

	$row_id = make_safe($_POST['report_id']);

	$form_data = array(
		'report_name' => make_safe($_POST['report_name']),
		'report_description' => make_safe($_POST['report_desc']),
		'report_header' => make_safe($_POST['report_header']),
		'report_footer' => make_safe($_POST['report_footer'])
	);

	$custom_message = "Report <em>".make_safe($_POST['report_name'])."</em> successfully updated.";
	updateData($form_data,'edit-report','system_reports',$row_id,$custom_message);

}
elseif (isset($_POST['edit-template'])) {

	$row_id = make_safe($_POST['field_id']);

	$form_data = array(
		'name' => make_safe($_POST['field_name']),
		'content' => make_safe($_POST['field_content']),
		'type' => make_safe($_POST['field_type'])
	);

	$custom_message = "Header/footer <em>".make_safe($_POST['field_name'])."</em> successfully updated.";
	updateData($form_data,'edit-template','system_reports_hnf',$row_id,$custom_message);

}
elseif (isset($_POST['edit-field'])) {

	$row_id = make_safe($_POST['field_id']);

	$form_data = array(
		'name' => make_safe($_POST['field_name']),
		'placeholder' => make_safe($_POST['field_placeholder']),
		'type' => make_safe($_POST['field_type']),
		'field_value' => make_safe($_POST['field_value']),
		'valid_char' => make_safe($_POST['field_valid_char']),
		'required' => make_safe($_POST['field_required']),
		'field_order' => make_safe($_POST['field_order'])
	);

	$custom_message = "Field <em>".make_safe($_POST['field_name'])."</em> successfully updated.";
	updateData($form_data,'edit-field','system_fields',$row_id,$custom_message);

}
elseif (isset($_POST['edit-entity-data'])) {

	$row_id = make_safe($_POST['userid']);

	$form_data = array(
		'first_name' => make_safe($_POST['first_name']),
		'middle_name' => make_safe($_POST['middle_name']),
		'last_name' => make_safe($_POST['last_name']),
		'email' => make_safe($_POST['email']),
		'mobile' => make_safe($_POST['mobile']),
		'username' => make_safe($_POST['username'])
	);

	$custom_message = "Entity <em>".make_safe($_POST['unique_code'])."</em> successfully updated.";
	updateData($form_data,'edit-entity-data','system_users',$row_id,$custom_message);

}
elseif (isset($_POST['edit-form-data'])) {

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$row_id = make_safe($_POST['form_input_id']);
	
	$table_name = 'usr_' . make_safe($_POST['form_code']);
	$field_code = 'unique_code';

	// echo $table_name;

	$form_data = array();

	$result = mysqli_query($conn, "SHOW COLUMNS FROM ".$table_name."");
	if (!$result) {
	    echo 'Could not run query: ' . mysqli_error();
	    exit;
	}
	if (mysqli_num_rows($result) > 0) {
	    while ($row = mysqli_fetch_assoc($result)) {
	    	if(!(preg_match( '/^id.*/', $row['Field']))){
	    		$field_name = $row['Field'];
	    		// echo $field_name. ' is '. $_POST[''.$field_name.''] .'<br>';
	    		$form_data += array($field_name => $_POST[''.$field_name.'']);
	    	}
	    }
	}

	print_r($form_data); 

	$custom_message = "Form Data of <em>".make_safe($_POST['form_input_user'])."</em> successfully updated.";
	updateDataInput($form_data,'edit-form-data',$table_name,$row_id,$custom_message);
	// insert this data to the data base
	# code...
	// $success_message = "Form data added to " . $_POST['unique_code'];
	// submitData($form_data,"input-form","$table_name",$field_code,$success_message);
}

elseif (isset($_POST['save-entity-new'])) {
	
	$email = make_safe($_POST['email']);
	$first_name = make_safe($_POST['first_name']);
	$last_name = make_safe($_POST['last_name']);
	$unique_code = make_safe($_POST['unique_code']);
	$hashed_password = sha1(make_safe($_POST['password']));

	$form_data = array(
		'username' => $email,
		'password' => $hashed_password,
		'first_name' => $first_name,
		'middle_name' => $last_name,
		'last_name' => make_safe($_POST['last_name']),
		'unique_code' => $unique_code,
		'entity_id' => make_safe($_POST['entity_code']),
		'email' => $email,
		'mobile' => make_safe($_POST['mobile'])
	);

	$custom_message = $first_name." ".$last_name." with unique code ".$unique_code.". ";


	// form data, page id, table name, unique column, custom message, false for no redirect
	submitData($form_data,"input-entity","system_users","email",$custom_message);
	
}


#form validation function

//    _____ ________________ ________  _   __   _    _____    __    ________  ___  ______________  _   __
//   / ___// ____/ ___/ ___//  _/ __ \/ | / /  | |  / /   |  / /   /  _/ __ \/   |/_  __/  _/ __ \/ | / /
//   \__ \/ __/  \__ \\__ \ / // / / /  |/ /   | | / / /| | / /    / // / / / /| | / /  / // / / /  |/ / 
//  ___/ / /___ ___/ /__/ // // /_/ / /|  /    | |/ / ___ |/ /____/ // /_/ / ___ |/ / _/ // /_/ / /|  /  
// /____/_____//____/____/___/\____/_/ |_/     |___/_/  |_/_____/___/_____/_/  |_/_/ /___/\____/_/ |_/   
                                                                                                      

function validateLogin($username,$password){

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$result=mysqli_query($conn,"SELECT * FROM system_users WHERE username='$username' and password='$password'")or die (mysqli_error());

	$count=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);

	if ($count > 0){
		$_SESSION['member_id']=$row['id'];
		$_SESSION['firstname']=$row['first_name'];
		$_SESSION['lastname']=$row['last_name'];
		$_SESSION['entity_id']=$row['entity_id'];

		header('location:'.$site_root.'?');
	}else{
		header('location:'.$site_root.'login/?msg=Either username or password is invalid.');
	}


}

function validateSession(){
	if (!isset($_SESSION['entity_id'])) {
		header('location:'.$site_root.'login/');
	}
	else{
		$session_id = $_SESSION['entity_id'];
		if ($session_id != '0') {
			include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
			$login_check =  mysqli_query($conn,"SELECT * FROM system_entities WHERE id = $session_id AND allow_login = 'yes'");
			$count = mysqli_num_rows($login_check);

			if ($count < 1) {
				header('location:'.$site_root.'login/?msg=Either username or password is invalid.');
			}
		}
	}
}

function validateAccess($page_id){
	$session_entity_id = $_SESSION['entity_id'];

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	if ($page_id == "403" || $page_id == "404" || $page_id == "" || $session_entity_id == "0") {
		$count = "1";
	} else {
		$permission_list = mysqli_query($conn,"SELECT * from system_permissions INNER JOIN system_permissions_config ON system_permissions_config.permission_id = system_permissions.id WHERE system_permissions_config.entity_id='$session_entity_id' AND system_permissions.code='$page_id';");
		$count=mysqli_num_rows($permission_list);
	}

	if ($count < 1){
		header('location:'.$site_root.'?p=403');
	}
}

function validatePermission($feature_code){
	$session_entity_id = $_SESSION['entity_id'];
	$permission_code = make_safe($feature_code);

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	if ($session_entity_id == "0") {
		return "200";
	} else {
		$permission_list = mysqli_query($conn,"SELECT * from system_permissions INNER JOIN system_permissions_config ON system_permissions_config.permission_id = system_permissions.id WHERE system_permissions_config.entity_id='$session_entity_id' AND system_permissions.code='$permission_code';");
		$count=mysqli_num_rows($permission_list);

		if ($count > 0) {
			return "200";
		} else {
			return "403";
		}
	}

}

function printDeleteLink($page_id,$params){
	$accessPermission = validatePermission($page_id);
	if ($accessPermission == "200") {
		return '<a class="btn btn-danger btn-sm" href="#" data-href="system/delete.php?a='.$page_id.'&'.$params.'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>&nbsp;';
	}
}

function printViewLink($page_id,$params){
	$accessPermission = validatePermission($page_id);
	if ($accessPermission == "200") {
		return '<a class="btn btn-primary btn-sm" href="?p='.$page_id.'&'.$params.'"><i class="fa fa-eye"></i></a>&nbsp;';
	}
}
function printViewReport($report_id,$params){
	$accessPermission = validatePermission('view-report');
	if ($accessPermission == "200") {
		return '<a class="btn btn-primary btn-sm" href="system/reports.php?r_id='.$report_id.'&'.$params.'" target="_new"><i class="fa fa-print"></i></a>&nbsp;';
	}
}
function printInputLink($page_id,$params){
	$accessPermission = validatePermission($page_id);
	if ($accessPermission == "200") {
		return '<a class="btn btn-success btn-sm" href="?p='.$page_id.'&'.$params.'"><i class="fa fa-plus-circle"></i></a>&nbsp;';
	}
}
function printEditLink($page_id,$params){
	$accessPermission = validatePermission($page_id);
	if ($accessPermission == "200") {
		return '<a class="btn btn-warning btn-sm" href="?p='.$page_id.'&'.$params.'"><i class="fa fa-edit"></i></a>&nbsp;';
	}
}

#form inputs

// form data, page id, table name, unique column, custom message, false for no redirect
function submitData($form_data,$page_id,$table_name,$column_code,$custom_success_message,$redirect){

	// allow custom success messages
	if (isset($custom_success_message)) {
		$success_message = "<strong>Well Done!</strong> New entry has been created. " . $custom_success_message;
	}
	else {
		$success_message = "<strong>Well Done!</strong> New entry has been created.";
	}

	#temporary fix for variable site_root
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	// for the app to know where page to print message
	$_SESSION['action_result_page'] = $page_id;

	if(checkIfDataExist($table_name,$column_code,$field_code)) {
		$_SESSION['action_result_message'] = '<strong>Oooppss!</strong> A duplicate code in ('.$column_code.') exists.';
		$_SESSION['action_notif_type'] = 'alert-warning';
	}
	else {
		//show proper message
		if(dbInsertData($table_name,$form_data)){
			$_SESSION['action_result_message'] = $success_message;
			$_SESSION['action_notif_type'] = 'alert-success';
		}
		else {
			$_SESSION['action_result_message'] = dbInsertData($table_name,$form_data);
			$_SESSION['action_notif_type'] = 'alert-danger';
		}
	}

	// will redirect if redirect value not set
	if (!isset($redirect)) {
		// header('location:'.$site_root.'?p='.$_SESSION['action_result_page'].'');
		header('location:'.$_SESSION['previous_uri'].'');
	}
	

}
function updateData($form_data,$page_id,$table_name,$row_id,$custom_success_message,$redirect){

	// allow custom success messages
	if (isset($custom_success_message)) {
		$success_message = "<strong>Well Done!</strong> Entry has been updated. " . $custom_success_message;
	}
	else {
		$success_message = "<strong>Well Done!</strong> Entry has been updated.";
	}	

	// for the app to know where page to print message
	$_SESSION['action_result_page'] = $page_id;

	// update row data
	$updateResult = dbRowUpdate($table_name,$form_data,"WHERE id = $row_id");


	if ($updateResult == 'success') {
		$_SESSION['action_result_message'] = $success_message;
		$_SESSION['action_notif_type'] = 'alert-success';

		// auto redirect if $redirect var has no value
		if (!isset($redirect)) {
		// header('location:'.$site_root.'?p='.$_SESSION['action_result_page'].'');
		header('location:'.$_SESSION['previous_uri'].'');
		}
	} else {
		echo $updateResult;
	}


}
function updateDataInput($form_data,$page_id,$table_name,$row_id,$custom_success_message,$redirect){
	// data inputs are using unique code as indentifiers

	// allow custom success messages
	if (isset($custom_success_message)) {
		$success_message = "<strong>Well Done!</strong> Entry has been updated. " . $custom_success_message;
	}
	else {
		$success_message = "<strong>Well Done!</strong> Entry has been updated.";
	}	

	// for the app to know where page to print message
	$_SESSION['action_result_page'] = $page_id;

	// update row data
	$updateResult = dbRowUpdate($table_name,$form_data,"WHERE unique_code = '$row_id'");


	if ($updateResult == 'success') {
		$_SESSION['action_result_message'] = $success_message;
		$_SESSION['action_notif_type'] = 'alert-success';

		// auto redirect if $redirect var has no value
		if (!isset($redirect)) {
		// header('location:'.$site_root.'?p='.$_SESSION['action_result_page'].'');
		header('location:'.$_SESSION['previous_uri'].'');
		}
	} else {
		echo $updateResult;
	}


}
function renderField($type,$placeholder,$required,$value,$name,$code,$current_value){

	if ($required == "required") {
		$asterisk = "<sup>*</sup>";
	}

	echo '  <div class="form-group">
                <label for="'.$code.'">'.printEditLink('edit-field','fid='.$code.'') . printDeleteLink('delete-form-field','fcode='.$code.''). ' ' .$name. ' '.$asterisk.'</label>';

    switch ($type) {
    	case 'text':
    		echo '<input type="text" class="form-control" id="'.$code.'" name="'.$code.'" value="'.$current_value.'" placeholder="'.$placeholder.'" '.$required.'>';
    		break;
    	case 'select':
    		echo '<select class="form-control" id="'.$code.'" name="'.$code.'" '.$required.'>';
    		echo '<option value="" disabled selected>'.$placeholder.'</option>';

			//Remove dot at end if exists
			$value = preg_replace('/\.$/', '', $value);
			//split string into array seperated by ', '
			$array = explode(', ', $value);
			//loop over values
			foreach($array as $value_split){
			    echo '<option value="'.$value_split.'" '.testSelected($value_split,$current_value).'>'.$value_split.'</option>';
			}
            echo  '</select>';
    		break;
    	case 'textarea':
	    	echo '<textarea class="form-control" id="'.$code.'" name="'.$code.'" '.$required.' rows="4" placeholder="'.$placeholder.'">'.$current_value.'</textarea>';
    		break;
    	case 'radio':
	    	echo '<fieldset class="form-group">
                  <small class="form-text text-muted">'.$placeholder.'</small>';

            //Remove dot at end if exists
			$value = preg_replace('/\.$/', '', $value);
			//split string into array seperated by ', '
			$array = explode(', ', $value);
			//loop over values
			foreach($array as $value_split){
			    echo '<div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="'.$code.'" id="'.$code.'" '.testChecked($value_split,$current_value).' value="'.$value_split.'">
                    '.$value_split.'
                  </label>
                  </div>';
			}      
            echo  '</fieldset>';
    		break;
    	default:
    		echo '<small class="form-text text-muted">Cannot render field "'.$name.'" with type "'.$type.'".</small>';
    		break;
    }
                
    echo '</div>';          

}

#return selected if value match
function testSelected($selectValue, $realValue){
	if ($selectValue == $realValue) {
		return 'selected=""';
	}
}

#reuturn checked if value match
function testChecked($checkValue, $realValue){
	if ($checkValue == $realValue) {
		return 'checked';
	}
}

// ╔╦╗╔═╗╔╦╗╔═╗╔╗ ╔═╗╔═╗╔═╗
//  ║║╠═╣ ║ ╠═╣╠╩╗╠═╣╚═╗║╣ 
// ═╩╝╩ ╩ ╩ ╩ ╩╚═╝╩ ╩╚═╝╚═╝

function checkIfDataExist($table,$column,$value){

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$strSQL = "SELECT * FROM $table WHERE $column = '".$value."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);

	if($objResult) {
		return true;
	}
	else{
		return false;
	}
}

function dbInsertData($table_name,$form_data){

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
	
	// retrieve the keys of the array (column titles)
	$fields = array_keys($form_data);

	// build the query
	$sql = "INSERT INTO ".$table_name."
	(`".implode('`,`', $fields)."`)
	VALUES('".implode("','", $form_data)."')";

	// run and return the query result resource
		// run and return the query result resource
	if ($conn->query($sql) === TRUE) {
	    return true;
	} else {
		$error = "Error creating table: " . $conn->error;
	    return $error;
	}
}

// dbRowDelete('my_table', "WHERE id = '$id'");
function dbRowDelete($table_name, $where_clause=''){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	// check for optional where clause
	$whereSQL = '';
	if(!empty($where_clause)){
		// check to see if the 'where' keyword exists
		if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
			// not found, add keyword
			$whereSQL = " WHERE ".$where_clause;
		}
		else{
			$whereSQL = " ".trim($where_clause);
		}
	}
	// build the query
	$sql = "DELETE FROM ".$table_name.$whereSQL;

	// run and return the query result resource
	$objQuery = mysqli_query($conn,$sql);

	if($objQuery) {
		echo "Data Deleted";
	}
	else {
		echo "Error Deleting [".$sql."]";
	}
}


// dbRowUpdate('my_table', $form_data, "WHERE id = '$id'");
function dbRowUpdate($table_name, $form_data, $where_clause=''){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	// check for optional where clause
	$whereSQL = '';
	if(!empty($where_clause)){
		// check to see if the 'where' keyword exists
		if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
			// not found, add key word
			$whereSQL = " WHERE ".$where_clause;
		}
		else {
			$whereSQL = " ".trim($where_clause);
		}
	}
	// start the actual SQL statement
	$sql = "UPDATE ".$table_name." SET ";

	// loop and build the column /
	$sets = array();
	foreach($form_data as $column => $value){
		$sets[] = "`".$column."` = '".$value."'";
	}
	$sql .= implode(', ', $sets);

	// append the where statement
	$sql .= $whereSQL;

	// run and return the query result
	// $objQuery = mysqli_query($conn,$sql);

	// if($objQuery) {
	//     return "success";
	// } else {
	// 	$error = "Error Updating [".$sql."]";
	//     return $error;
	// }

	if ($conn->query($sql) === TRUE) {
	    return "success";
	} else {
		$error = "Error Updating:".$sql." " . $conn->error;
	    return $error;
	}
}

// create new table in the database
function dbCreateTable($entity_code,$form_code){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$table_name = "usr_".$form_code;
	// $code_column = $entity_code."_code";
	$code_column = "unique_code";

	
	$sql = "CREATE TABLE $table_name ( id INT NULL AUTO_INCREMENT PRIMARY KEY, date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, user_id VARCHAR(255) NOT NULL , $code_column VARCHAR(255) NOT NULL  ) ENGINE = InnoDB";

	// run and return the query result resource
	if ($conn->query($sql) === TRUE) {
	    return "success";
	} else {
		$error = "Error creating table: " . $conn->error;
	    return $error;
	}

	$conn->close();
}


// Add column to existing table
function addColumnToTable($table_name,$column_name,$type,$max_char){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$table_name = "usr_".$table_name;
	
	$sql = "ALTER TABLE $table_name ADD $column_name $type($max_char) NOT NULL;";

	// run and return the query result resource
	if ($conn->query($sql) === TRUE) {
	    return "success";
	} else {
		$error = "Error altering table: " . $conn->error;
	    return $error;
	}

	$conn->close();
}

// ╔╗╔╔═╗╦  ╦╦╔═╗╔═╗╔╦╗╦╔═╗╔╗╔
// ║║║╠═╣╚╗╔╝║║ ╦╠═╣ ║ ║║ ║║║║
// ╝╚╝╩ ╩ ╚╝ ╩╚═╝╩ ╩ ╩ ╩╚═╝╝╚╝

function createSidebarMenu($friendly_name,$page_id,$current_page){

	$session_entity_id = $_SESSION['entity_id'];

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
	$permission_list = mysqli_query($conn,"SELECT * from system_permissions INNER JOIN system_permissions_config ON system_permissions_config.permission_id = system_permissions.id WHERE system_permissions_config.entity_id='$session_entity_id' AND system_permissions.code='$page_id';");
	$count=mysqli_num_rows($permission_list);


	$nav_class="";

	if ($current_page == $page_id) {
		$nav_class="active";
	}
	elseif ($current_page == "disabled") {
		$nav_class="disabled";
		$page_id = '';
	}

	if (($count > 0) || ($current_page == "disabled") || ($session_entity_id == '0')){
		echo '<li class="nav-item"><a class="nav-link '.$nav_class.'" href="?p='.$page_id.'">'.$friendly_name.'</a></li>';
	}

}

function returnContent($page_id){

	if (isset($page_id)) {
		if (file_exists($_SERVER['DOCUMENT_ROOT']."/ecj1718/content/".$page_id.".php")) {
			return $_SERVER['DOCUMENT_ROOT']."/ecj1718/content/".$page_id.".php";
		}
		else{
			return $_SERVER['DOCUMENT_ROOT']."/ecj1718/content/404.php";
		}
	}
	else {
		return $_SERVER['DOCUMENT_ROOT']."/ecj1718/content/default.php";
	}

}

function listAvailableForms($current_page){
	//list only if user has list or input form permission
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$session_entity_id = $_SESSION['entity_id'];


	if ($session_entity_id == 0) {
		$count = '1';
	} else {
		$permission_check = mysqli_query($conn,"SELECT * from system_permissions INNER JOIN system_permissions_config ON system_permissions_config.permission_id = system_permissions.id WHERE system_permissions_config.entity_id=$session_entity_id AND (system_permissions.code = 'input-form' OR system_permissions.code = 'list-forms' );");
		$count = mysqli_num_rows($permission_check);
	}


	if ($count > 0) {
		
		$result = mysqli_query($conn,"SELECT * FROM system_forms LIMIT 4;");

		$i = 0; 
		while($row = mysqli_fetch_array($result)){
			$nav_class="";
		    $i++;

			if ($current_page == $row['form_code']) {
				$nav_class="active";
			}
			elseif ($current_page == "disabled") {
				$nav_class="disabled";
			}

			echo '<li class="nav-item"><a class="nav-link '.$nav_class.'" href="?p=input-form&f='.$row['form_code'].'&fid='.$row['id'].'">'.$row['form_name'].'</a></li>';
		}
		
		mysqli_close($conn);
	}
}

function listEntities($current_page){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");


	$session_entity_id = $_SESSION['entity_id'];


	if ($session_entity_id == 0) {
		$count = '1';
	} else {
		$permission_check = mysqli_query($conn,"SELECT * from system_permissions INNER JOIN system_permissions_config ON system_permissions_config.permission_id = system_permissions.id WHERE system_permissions_config.entity_id=$session_entity_id AND (system_permissions.code = 'input-entities' OR system_permissions.code = 'list-entities' );");
		$count = mysqli_num_rows($permission_check);
	}
	

	if ($count > 0) {

		$result = mysqli_query($conn,"SELECT * FROM system_entities LIMIT 4;");


		$i = 0; 
		while($row = mysqli_fetch_array($result)){
			$nav_class="";
		    $i++;

			if ($current_page == $row['entity_code']) {
				$nav_class="active";
			}
			elseif ($current_page == "disabled") {
				$nav_class="disabled";
			}

			echo '<li class="nav-item"><a class="nav-link '.$nav_class.'" href="?p=input-entity&e='.$row['entity_code'].'&eid='.$row['id'].'">'.$row['entity_name'].'</a></li>';
		}
		
		mysqli_close($conn);
	}
}


// ╔╗╔╔═╗╔╦╗╦╔═╗╦╔═╗╔═╗╔╦╗╦╔═╗╔╗╔
// ║║║║ ║ ║ ║╠╣ ║║  ╠═╣ ║ ║║ ║║║║
// ╝╚╝╚═╝ ╩ ╩╚  ╩╚═╝╩ ╩ ╩ ╩╚═╝╝╚╝

function actionResult($page_id,$current_page,$notif_type,$notif_message){
	if ($current_page == $page_id) {
		echo '<div class="alert '.$notif_type.' alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                '.$notif_message.'
              </div>';
	}
}


?>