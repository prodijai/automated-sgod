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

$action = make_safe($_GET['a']);

switch ($action) {
	case 'delete-report':
		$report_id = make_safe($_GET['r_id']);

		echo $report_id;

		deleteData("list-reports","system_reports_config","WHERE report_id = $report_id","false");
		deleteData("list-reports","system_reports","WHERE id = $report_id");

		break;

	case 'delete-form':

		$form_id = make_safe($_GET['f_id']);
		
		include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
		#get form details
		$result1 = mysqli_query($conn,"SELECT * from system_forms WHERE id = $form_id");

		$form_detail = mysqli_fetch_array($result1);
		$form_code = $form_detail['form_code'];

		#get report details and drop report configs
		$result = mysqli_query($conn,"SELECT * FROM system_reports WHERE form_link = $form_id");
		$i = 0; 
		while($row = mysqli_fetch_array($result)){
		$i++;
			#delete report configurations
			$report_id = $row['id'];
			dbRowDelete("system_reports_config","WHERE report_id = $report_id");
		}

		#delete reports
		deleteData("list-forms","system_reports","WHERE form_link = $form_id","false");


		#update fields - remove form link
		#get all fields linked to form - update value to null
		echo "checking fields with form_link id " . $form_id;
		$result2 = mysqli_query($conn,"SELECT * FROM system_fields WHERE form_link = $form_id");
		$i = 0; 
		while($row2 = mysqli_fetch_array($result2)){
		$i++;
			#Set form link as null
			$form_data = array(
				'form_link' => ''
			);

			$field_id = $row2['id'];
			echo $field_id."<br>";
			#update field
			dbRowUpdate('system_fields', $form_data, "WHERE id = $field_id");

		}
		mysqli_close($conn);

		
		#delete table
		$table = "usr_".$form_code;
		dbDropTable($table);

		#delete form
		deleteData("list-forms","system_forms","WHERE id = $form_id");

		break;
	case 'delete-entity':

		include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

		$entity_id = make_safe($_GET['e_id']);

		$linked_data = mysqli_query($conn,"SELECT * from system_entities INNER JOIN system_forms ON system_entities.id = system_forms.form_entity_link INNER JOIN system_reports ON system_forms.id = system_reports.form_link INNER JOIN system_reports_config ON system_reports_config.report_id = system_reports.id WHERE system_entities.id = $entity_id;");
		// $values = $linked_data->fetch_all(MYSQLI_ASSOC);
		// print_r($values);
		$linked_rows = mysqli_fetch_array($linked_data);
		$entity_code = $linked_rows['entity_code'];
		// echo $entity_code;

		// echo "fields need to be updated <br>";
		$i = 0;
		while($linked_rows = mysqli_fetch_array($linked_data)){
		$i++;
			// Set form link as null
			// echo $linked_rows["field_id"] ."<br>";
			$field_id = $linked_rows["field_id"];
			$form_data = array(
				'entity_link' => ''
			);

			dbRowUpdate('system_fields', $form_data, "WHERE id = $field_id");

		}

		echo "report and report configs need to be updated <br>";
		mysqli_data_seek($linked_data, 0);
		$i = 0;
		while($linked_rows = mysqli_fetch_array($linked_data)){
		$i++;
			#Set form link as null
			echo $linked_rows["report_id"] ."<br>";
			$report_id = $linked_rows["report_id"];

			dbRowDelete("system_reports_config","WHERE report_id = $report_id");
			dbRowDelete("system_reports","WHERE id = $report_id");


		}

		//delete permissions
		dbRowDelete("system_permissions_config","WHERE entity_id = $entity_id");

		// delete form
		dbRowDelete("system_forms","WHERE form_entity_link = $entity_id");

		//drop table
		$table_name = "usr_".$entity_code;
		dbDropTable($table_name);

		// delete entity
		deleteData("list-entities","system_entities","WHERE id = $entity_id");
		
		break;
	case 'delete-template':

		$template_id = make_safe($_GET['t_id']);
		deleteData("list-templates","system_reports_hnf","WHERE id = $template_id");
		break;
	case 'delete-form-field':
		$field_code = make_safe($_GET['fcode']);

		include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

		$form_field = mysqli_query($conn,"SELECT * FROM system_fields INNER JOIN system_forms ON system_forms.id = system_fields.form_link WHERE system_fields.code = '$field_code';");
		$form_field_rows = mysqli_fetch_array($form_field);
		$form_code = $form_field_rows['form_code'];


		//drop column
		$table_name = "usr_".$form_code;
		dbDropColumn($table_name,$field_code);

		//delete field
		deleteData("list-forms","system_fields","WHERE code = '$field_code'");

		break;
	case 'delete-form-data':

		$form_code = make_safe($_GET['form_code']);
		$table_name = "usr_".$form_code;
		$unique_code = make_safe($_GET['unique_code']);

		echo $form_code . "<br>";
		echo $table_name . "<br>";
		echo $unique_code . "<br>";

		// if ($unique_code) {
		// 	# code...
		// }
		// delete entry from table
		deleteData("list-forms",$table_name,"WHERE unique_code = '$unique_code'");

		break;
	case 'delete-entity-data':
		$entity_id = make_safe($_GET['e_id']);
		$unique_code = make_safe($_GET['uid']);

		include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

		#get all forms linked to entity
		$result = mysqli_query($conn,"SELECT * FROM system_forms WHERE form_entity_link = $entity_id");
		$i = 0; 
		while($row = mysqli_fetch_array($result)){
		$i++;
			$table_code = "usr_" . $row['form_code'];
			echo $table_code . "<br>";
			
			dbRowDelete($table_code,"WHERE unique_code = $unique_code");
		}

		deleteData("list-entity-data","system_users","WHERE unique_code = '$unique_code'");

		break;
	case 'delete-field':
		$field_id = make_safe($_GET['f_id']);

		//detele field from table
		deleteData("list-fields","system_fields","WHERE id = '$field_id'");
		break;
	default:
		echo "no defined function";
		break;
}


#inputs
function deleteData($page_id,$table_name,$where_clause,$redirect){

	$_SESSION['action_result_page'] = $page_id;

	if (dbRowDelete($table_name,$where_clause) == "success") {
		echo "success";
	}

	#if redirect not set to false, it will automatically redirect to page defined
	if (!isset($redirect)) {
		// header('location:'.$site_root.'?p='.$_SESSION['action_result_page'].'');
		header('location:'.$_SESSION['previous_uri'].'');
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
		return "success";
	}
	else {
		echo "Error Deleting [".$sql."]";
	}
}

function dbDropTable($table_name){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

	$sql = "DROP TABLE ".$table_name;

	$objQuery = mysqli_query($conn,$sql);


	if($objQuery) {
		return "success";
	}
	else {
		echo "Error Dropping Table [".$sql."]";
	}
}

function dbDropColumn($table_name,$column_name){
	include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
	$sql = "ALTER TABLE $table_name DROP $column_name;";
	$objQuery = mysqli_query($conn,$sql);

	if($objQuery) {
		return "success";
	}
	else {
		echo "Error Dropping Column [".$sql."]";
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
	$objQuery = mysqli_query($conn,$sql);

	if($objQuery) {
		return "success";
	}
	else {
		echo "Error Updating [".$sql."]";
	}
}


?>