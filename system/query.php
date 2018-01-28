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

// ╦  ╦╦  ╦╔═╗  ╔═╗╔═╗╔═╗╦═╗╔═╗╦ ╦
// ║  ║╚╗╔╝║╣   ╚═╗║╣ ╠═╣╠╦╝║  ╠═╣
// ╩═╝╩ ╚╝ ╚═╝  ╚═╝╚═╝╩ ╩╩╚═╚═╝╩ ╩


		$keyword = strval($_POST['query']);
		$code = strval($_POST['entity_code']);
		$table_name = 'usr_' . $code;



		$search_param = "{$keyword}%";

		// where name or code 
		$sql = $conn->prepare("SELECT * FROM usr_std WHERE std_firstname LIKE ?");
		$sql->bind_param("s",$search_param);			
		$sql->execute();
		$result = $sql->get_result();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$searchResult[] = $row["std_firstname"];
			}
			echo json_encode($searchResult);
		}
		$conn->close();

// $page_id = $_GET['p'];

// switch ($page_id) {
// 	case 'input-form':

// 		// include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
// 		// $result = mysqli_query($conn,"SELECT * FROM system_entities LIMIT 4;");

// 		// $i = 0; 
// 		// while($row = mysqli_fetch_array($result)){
// 		// 	$nav_class="";
// 		//     $i++;

// 		// 	if ($current_page == $row['entity_code']) {
// 		// 		$nav_class="active";
// 		// 	}
// 		// 	elseif ($current_page == "disabled") {
// 		// 		$nav_class="disabled";
// 		// 	}

// 		// 	echo '<li class="nav-item"><a class="nav-link '.$nav_class.'" href="?p=input-entity&e='.$row['entity_code'].'&eid='.$row['id'].'">'.$row['entity_name'].'</a></li>';
// 		// }
		
// 		// mysqli_close($conn);

		


// 		break;
	
// 	default:
// 		# code...
// 		break;
// }

?>