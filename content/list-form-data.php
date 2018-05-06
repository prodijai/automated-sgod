<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

$form_code = $_GET['f'];
$form_table_name = "usr_".$form_code;
$form_id = make_safe($_GET['fid']);

// PERMISSION CHECK

$list_all = validateUserPermission('list-all-form-data','1',$form_id);
$list_school = validateUserPermission('list-school-form-data','1',$form_id);
$list_data = validateUserPermission('list-form-data','1',$form_id);

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

//END OF PERMISSION CHECK

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

$result = mysqli_query($conn,"SELECT * FROM $form_table_name INNER JOIN system_users on system_users.unique_code = $form_table_name.unique_code WHERE $list_permission AND $form_table_name.unique_code LIKE '%$keyword%'");

$column_fields = mysqli_query($conn,"SELECT * FROM system_fields WHERE form_link = $form_id;");

?>
          <div class="row">
            <div class="col-12">
              <!-- <a href="?p=new-form" class="btn btn-outline-success float-right" role="button">Create New Form</a> -->
              <h2>Available Form Data</h2>
              <p>List of all data encoded in the form.</p>
              <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="hidden" name="f" id="f" value="<?php echo $form_code; ?>">
                    <input type="hidden" name="fid" id="fid" value="<?php echo $form_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search Unique Code ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></a></button>
                    </span>
                  </div>
                  </form>
                </div>
              </div>
              <br>
              <table class="table table-striped">
              <thead>
                <tr>
                  <th>Unique Code</th>
                  <th>Name</th>



                  <?php 
                  //print column headers
                  mysqli_data_seek($column_fields, 0);
                  $i = 0; 
                  while($fields = mysqli_fetch_array($column_fields)){
                    $i++;
                    $field_name = $fields['name'];
                    if (($field_name != "id") AND ($field_name != "unique_code")) {
                      echo "<th>".$field_name."</th>";
                    }
                  }
                  ?>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($result)){
                $i++;
                echo "<tr>";
                echo "<td>" . $row['unique_code'] . "</td>";
                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";

                //print data based from  column headers
                mysqli_data_seek($column_fields, 0);
                $i = 0; 
                while($fields = mysqli_fetch_array($column_fields)){
                  $i++;
                  $field_name = $fields['code'];
                  if (($field_name != "id") AND ($field_name != "unique_code")) {
                    echo "<td>" . $row["$field_name"] . "</td>";
                  }
                }


                echo '<td>';
                echo printEditLink('edit-form-data','1',$form_id,'f='.$form_code.'&fid='.$form_id.'&fiid='.$row['unique_code'].'');
                echo printDeleteLink('delete-form-data','1',$form_id,'unique_code='.$row['unique_code'].'&form_code='.$form_code.'&fid='.$form_id.'');
                echo ' </td>';
                echo "</tr>";
              }
              mysqli_close($conn);

              ?>
              </tbody>
              </table>
            </div>
            
<!--             <div class="col-4">
              <?php 
                // echo $_SESSION['action_result_page'] . 'result page <br>';
                // echo $_SESSION['action_notif_type'] . '<br>';
                // echo $_SESSION['action_result_message'] . '<br>';
                // echo $_GET['p'] . 'current page <br>';

                //actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);

              ?>
            <h4>Tip</h4>
            <p>Fields should be created first before you can add them to a form.</p>
            </div> -->
          </div>

          <!-- confirmation modal -->
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          Confirm Deletion of Form Data
                      </div>
                      <div class="modal-body">
                          This process cannot be undone.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-danger btn-ok">Delete</a>
                      </div>
                  </div>
              </div>
          </div>