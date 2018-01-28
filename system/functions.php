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
		'entity_description' => make_safe($_POST['entity_desc'])
	);

	//create table
	$createTableResult = dbCreateTable(make_safe($_POST['entity_code']));

	if ($createTableResult == "success") {
		submitData($form_data,"create-entity","system_entities",make_safe($_POST['entity_code']));

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

		submitData($form_data,"create-entity","system_fields",$field_code);


	}
	else{
		echo "error";
		echo $createTableResult;
	}

}
elseif (isset($_POST['new_form'])) {

	$form_data = array(
		'form_name' => make_safe($_POST['form_name']),
		'form_code' => make_safe($_POST['form_code']),
		'form_description' => make_safe($_POST['form_desc']),
		'form_entity_link' => make_safe($_POST['form_link'])
	);

	$createTableResult = dbCreateTable(make_safe($_POST['form_code']));
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

// success message
	submitData($form_data,"input-entity","$table_name",$field_code);

}


#form validation function
function validateLogin($username,$password){

	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$result=mysqli_query($conn,"SELECT * FROM system_users WHERE username='$username' and password='$password'")or die (mysqli_error());

	$count=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);

	if ($count > 0){
		$_SESSION['member_id']=$row['id'];
		$_SESSION['firstname']=$row['first_name'];
		$_SESSION['lastname']=$row['last_name'];

		header('location:'.$site_root.'?p=404');
	}else{
		header('location:'.$site_root.'login/?msg=Invalid Login');
	}


}

#form inputs

function submitData($form_data,$page_id,$table_name,$column_code){

	// allow custom success messages

	#temporary fix for variable site_root
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$_SESSION['action_result_page'] = $page_id;

	if(checkIfDataExist($table_name,$column_code,$field_code)) {
		$_SESSION['action_result_message'] = '<strong>Oooppss!</strong> A duplicate code in ('.$column_code.') exists.';
		$_SESSION['action_notif_type'] = 'alert-warning';
	}
	else {
		if(dbInsertData($table_name,$form_data)){
			$_SESSION['action_result_message'] = '<strong>Well Done!</strong> New entry has been created.';
			$_SESSION['action_notif_type'] = 'alert-success';
		}
		else {
			$_SESSION['action_result_message'] = dbInsertData($table_name,$form_data);
			$_SESSION['action_notif_type'] = 'alert-danger';
		}
	}

	// header('location:'.$site_root.'?p='.$_SESSION['action_result_page'].'');
	header('location:'.$_SESSION['previous_uri'].'');


}

function renderField($type,$placeholder,$required,$value,$name,$code){
	echo '  <div class="form-group">
                <label for="'.$code.'">'.$name.'</label>';

    switch ($type) {
    	case 'text':
    		echo '<input type="text" class="form-control" id="'.$code.'" name="'.$code.'" placeholder="'.$placeholder.'" '.$required.'>';
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
			    echo '<option value="'.$value_split.'">'.$value_split.'</option>';
			}
            echo  '</select>';
    		break;
    	case 'textarea':
	    	echo '<textarea class="form-control" id="'.$code.'" name="'.$code.'" '.$required.' rows="4" placeholder="'.$placeholder.'"></textarea>';
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
                    <input type="radio" class="form-check-input" name="'.$code.'" id="'.$code.'" value="'.$value_split.'">
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
	$objQuery = mysqli_query($conn,$sql);

	if($objQuery) {
		echo "Data Updated";
	}
	else {
		echo "Error Updating [".$sql."]";
	}
}

// create new table in the database
function dbCreateTable($code){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$table_name = "usr_".$code;
	$code_column = $code."_code";
	
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
	$nav_class="";

	if ($current_page == $page_id) {
		$nav_class="active";
	}
	elseif ($current_page == "disabled") {
		$nav_class="disabled";
	}

	echo '<li class="nav-item"><a class="nav-link '.$nav_class.'" href="?p='.$page_id.'">'.$friendly_name.'</a></li>';

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
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
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

function listEntities($current_page){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
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