<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

$entity_id = make_safe($_GET['eid']);
$entity_code = make_safe($_GET['e']);

// PERMISSION CHECK

$list_all = validateUserPermission('list-all-entity-data','2',$entity_id);
$list_school = validateUserPermission('list-school-entity-data','2',$entity_id);
// $list_data = validateUserPermission('list-entity-data','2',$entity_id);

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
// elseif ($list_data == "200") {
//   // echo "list data";
//   $list_permission = "system_users.created_by LIKE '$session_member_id'";
// }
else{
  // validateUserAccess('list-all-entity-data','2',$form_id);
  $list_permission = "system_users.created_by LIKE '$session_member_id'";
  
}

// echo $list_permission;

// end of permission check

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

$result = mysqli_query($conn,"SELECT * FROM system_users INNER JOIN system_schools ON system_schools.id = system_users.school_id WHERE $list_permission AND (system_users.entity_id = $entity_id AND (system_users.first_name LIKE '%$keyword%' OR system_users.last_name LIKE '%$keyword%' OR system_users.unique_code LIKE '%$keyword%')) ORDER BY system_users.id");
?>
          <div class="row">
            <div class="col-12">
              <!-- <a href="?p=new-form" class="btn btn-outline-success float-right" role="button">Create New Form</a> -->
              <h2>Entity Data</h2>
              <p>Here are the available inputs</p>
              <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="hidden" name="e" id="e" value="<?php echo $entity_code; ?>">
                    <input type="hidden" name="eid" id="eid" value="<?php echo $entity_id; ?>">
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
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>School</th>
                  <th>Username</th>
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
                echo "<td>" . $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['school_acronym'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo '<td> '.printEditLink('edit-entity-data','2',$entity_id,'uid='.$row['unique_code'].'&eid='.$entity_id.'') . printDeleteLink('delete-entity-data','2',$entity_id,'uid='.$row['unique_code'].'&e_id='.$row['entity_id'].'') . '</td>';
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
                          IMPORTANT: Confirm Deletion of Entity
                      </div>
                      <div class="modal-body">
                          This process cannot be undone. All related reports, forms and inputs will be deteled. Press delete to proceed.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-danger btn-ok">Delete</a>
                      </div>
                  </div>
              </div>
          </div>