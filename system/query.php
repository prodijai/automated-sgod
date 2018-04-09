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




$page_id = $_GET['p'];



switch ($page_id) {
	case 'input-entity':
		$keyword = strval($_GET['term']);
		$code = strval($_GET['entity_code']);
		// $table_name = 'usr_' . $code;
		$table_name = 'system_users';
		$lookup_field = strval($_GET['lookup']);


		$search_param = "{$keyword}%";

		// where name or code 
		$sql = $conn->prepare("SELECT * FROM ".$table_name." WHERE entity_id = ".$code." AND ".$lookup_field." LIKE ?");
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