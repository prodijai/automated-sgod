<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
include("functions.php");

session_start();

$report_code = make_safe($_GET['r_id']);
$form_link = make_safe($_GET['f_link']);

// page access check
validateUserAccess("view-report",'3',$report_code,'system_reports');



$form_report = mysqli_query($conn,"SELECT * FROM system_forms INNER JOIN system_reports ON system_reports.form_link = system_forms.id WHERE system_reports.id = $report_code;");
$form_report_data = mysqli_fetch_array($form_report);
$form_code = $form_report_data['form_code'];
$header_id = $form_report_data['report_header'];
$footer_id = $form_report_data['report_footer'];

//header query
$header = mysqli_query($conn,"SELECT * FROM system_reports_hnf WHERE id = $header_id;");
$header_data = mysqli_fetch_array($header);

//footer query
$footer = mysqli_query($conn,"SELECT * FROM system_reports_hnf WHERE id = $footer_id;");
$footer_data = mysqli_fetch_array($footer);


$form_table_name = "usr_".$form_code;

// PERMISSION CHECK

$list_all = validateUserPermission('list-all-form-data','1',$form_link);
$list_school = validateUserPermission('list-school-form-data','1',$form_link);
$list_data = validateUserPermission('list-form-data','1',$form_link);

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
elseif ($list_data == "200") {
  // echo "list data";
  $list_permission = "$form_table_name.created_by LIKE '$session_member_id'";
}
else{
  validateUserAccess('list-all-form-data','1',$form_id);
}

// echo $list_permission;

//END OF PERMISSION CHECK

$data_input = mysqli_query($conn,"SELECT * FROM $form_table_name INNER JOIN system_users on system_users.unique_code = $form_table_name.unique_code WHERE $list_permission;");
$column_details = mysqli_query($conn,"SELECT * FROM system_fields INNER JOIN system_reports_config ON system_reports_config.field_id = system_fields.id WHERE system_reports_config.report_id = $report_code ORDER BY system_reports_config.field_order ASC;");

?>
<html lang="en" class="gr__v4-alpha_getbootstrap_com">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jairenz Batu">
    <!-- <link rel="icon" href="https://v4-alpha.getbootstrap.com/favicon.ico"> -->

    <!-- <title>Generated Report | <?php //echo $form_detail['report_name'] ?></title> -->
    <title>&nbsp;</title>


  </head>
  <style type="text/css">
	body {
		font-family: arial;
		font-size: 10;
	}
	table {
		border-collapse: collapse;
		font-size: 10;
		width: 100%;
	}

	table, th, td {
		border: 1px solid black;
	}
	th, td {
		padding: 4px;
	}

  </style>

  <body data-gr-c-s-loaded="true" onload="window.print();">
  <p>
  	<?php echo $header_data['content']; ?>
  </p>

<table class="table table-striped" border=1>
	<thead>
		<tr>
			<th>Unique Code</th>
	        <th>Name</th>



			<?php 
			//print column headers
			mysqli_data_seek($column_details, 0);
				$i = 0; 
				while($fields = mysqli_fetch_array($column_details)){
					$i++;
					$field_name = $fields['name'];
					if (($field_name != "id") AND ($field_name != "unique_code")) {
					  echo "<th>".$field_name."</th>";
					}
			}
			?>

		</tr>
	</thead>
	<tbody>
              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($data_input)){
                $i++;
                echo "<tr>";
                echo "<td>" . $row['unique_code'] . "</td>";
                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";

                //print data based from  column headers
                mysqli_data_seek($column_details, 0);
                $i = 0; 
                while($fields = mysqli_fetch_array($column_details)){
                  $i++;
                  $field_name = $fields['code'];
                  if (($field_name != "id") AND ($field_name != "unique_code")) {
                    echo "<td>" . $row["$field_name"] . "</td>";
                  }
                }
                echo "</tr>";
              }
              mysqli_close($conn);

              ?>
	</tbody>
</table>


<?php

// // START TABLE HEAD
// 	echo '
// 			<table class="table table-striped" border=1>
//               <thead>
//                 <tr>';
//     echo '<th>#</th>';  
// 	$i = 0;
// 	while($row0 = mysqli_fetch_array($result0)){
// 		$i++;
// 		echo "<th>" . $row0['name'] . "</th>";
// 	}



// // END TABLE HEAD
// 	echo '      </tr>
//               </thead>
//               <tbody>

// 	';
// // START TABLE BODY


// $i = 0; 
// while($row1 = mysqli_fetch_array($result2)){
// 		$i++;
// 		echo "<tr>";
// 		echo '<td>'.$i.'</td>';  
// 		//reset data seek
// 		mysqli_data_seek($result0, 0);
// 		$h = 0;                 
// 		while($row2 = mysqli_fetch_array($result0)){
// 			$h++;
// 			$field_code = $row2['code'];
// 			echo "<td>" . $row1["$field_code"] . "</td>";
// 		}
// 		echo "</tr>";
// 	}


// echo '        </tbody>
//               </table>
// ';
// // START TABLE BODY

?>
</body>
</html>
