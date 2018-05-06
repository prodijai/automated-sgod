<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
include("functions.php");

// ╦  ╦╦  ╦╔═╗  ╔═╗╔═╗╔═╗╦═╗╔═╗╦ ╦
// ║  ║╚╗╔╝║╣   ╚═╗║╣ ╠═╣╠╦╝║  ╠═╣
// ╩═╝╩ ╚╝ ╚═╝  ╚═╝╚═╝╩ ╩╩╚═╚═╝╩ ╩


$page_id = $_GET['p'];


switch ($page_id) {
	case 'input-entity':


		$keyword = strval($_GET['term']);
		$code = strval($_GET['entity_code']);
		// $table_name = 'usr_' . $code;
		$table_name = 'system_users';
		$lookup_field = strval($_GET['lookup']);


		$search_param = "{$keyword}%";

		//PERMISSION CHECK
		$list_all = validateUserPermission('list-all-entity-data','2',$code);
		$list_school = validateUserPermission('list-school-entity-data','2',$code);
		// $list_data = validateUserPermission('list-entity-data','2',$code);

		$session_school_id = $_SESSION['school_id'];
		$session_member_id = $_SESSION['member_id'];

		if ($list_all == "200") {
		  // echo "list all";
		  $list_permission = "system_users.school_id LIKE '%'";
		}
		elseif ($list_school == "200") {
		  // echo "list school";
		  $list_permission = "system_users.school_id LIKE '$session_school_id'";
		}
		else {
		  // echo "list data";
		  $list_permission = "system_users.created_by LIKE '$session_member_id'";
		}

		$sql_search = "SELECT * FROM system_users INNER JOIN system_schools ON system_schools.id = system_users.school_id WHERE $list_permission AND (system_users.entity_id = $code AND $lookup_field LIKE ?)";
		// end of permission check

		// $sql_search = "SELECT * FROM ".$table_name." WHERE entity_id = ".$code." AND ".$lookup_field." LIKE ?";
		// where name or code 
		// $sql = $conn->prepare("SELECT * FROM ".$table_name." WHERE entity_id = ".$code." AND ".$lookup_field." LIKE ?");
		$sql = $conn->prepare($sql_search);

		$sql->bind_param("s",$search_param);			
		$sql->execute();
		$result = $sql->get_result();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$searchResult[] = $row["$lookup_field"];
			}

		}
		else {
			$searchResult[0] = 'Not found!';
		}

		echo json_encode($searchResult);

		$conn->close();


		break;
	
	default:
		# code...
		break;
}

?>