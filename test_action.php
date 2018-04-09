<?php

// include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php"); 



// foreach ($_POST as $key => $value)
// 	echo "'.htmlspecialchars($key).' => make_safe($_POST['.htmlspecialchars($key).'])";
// 	echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

// print_r($_POST);

// $form_data = array(
// 	'form_name' => 'test1',
// 	'form_code' => 'test2',
// 	'form_entity_link' => 'test3'
// );

// // print_r($form_data);


// include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

// $table_name = 'usr_' . $_POST['form_code'];

// $data = array();

// $result = mysqli_query($conn, "SHOW COLUMNS FROM usr_std_health");
// if (!$result) {
//     echo 'Could not run query: ' . mysqli_error();
//     exit;
// }
// if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//     	if(!(preg_match( '/^id.*/', $row['Field']))){
//     		$field_name = $row['Field'];
//     		echo $field_name. ' is '. $_POST[''.$field_name.''] .'<br>';
//     		$data += array($field_name => $_POST[''.$field_name.'']);
//     	}
//     }
// }

// print_r($data); // insert this data to the data base


// SElECT * FROM system_fields WHERE (entity_link = '5' AND field_order< '4') OR form_link = '3' ORDER BY LOCATE('5', entity_link) DESC, field_order;
// SElECT * FROM system_fields WHERE (entity_link = '5' AND field_order< '4') OR form_link = '3' ORDER BY entity_link DESC, form_link, field_order;


echo $_POST['vehicle'];

?>