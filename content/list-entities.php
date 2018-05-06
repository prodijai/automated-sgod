<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

if ($_SESSION['entity_id'] == '0') {
  $sql = "SELECT * FROM system_entities WHERE (entity_name LIKE '%$keyword%' OR entity_description LIKE '%$keyword%' OR entity_code LIKE '%$keyword%') ORDER BY id, entity_code";

} else {
  $permission_code = "list-entities";
  $entity_id = $_SESSION['entity_id'];
  $school_id = $_SESSION['school_id'];

  $sql = "SELECT DISTINCT(system_entities.entity_name),system_entities.entity_code,system_entities.entity_description,system_entities.allow_login,system_entities.id 
        FROM system_entities 
        INNER JOIN system_permissions_config ON system_permissions_config.link_id = system_entities.id 
        INNER JOIN system_permissions ON system_permissions.id = system_permissions_config.permission_id 
        WHERE system_permissions.permission_type = 2 AND 
        system_permissions.code like '$permission_code' AND 
        system_permissions_config.entity_id like '$entity_id' AND 
        system_permissions_config.school_id like '$school_id' AND
        (system_entities.entity_name LIKE '%$keyword%' OR system_entities.entity_description LIKE '%$keyword%' OR system_entities.entity_code LIKE '%$keyword%') 
        ORDER BY system_entities.id, system_entities.entity_code";
}

// $result = mysqli_query($conn,"SELECT * FROM system_entities WHERE (entity_name LIKE '%$keyword%' OR entity_description LIKE '%$keyword%' OR entity_code LIKE '%$keyword%') ORDER BY id, entity_code");

$result = mysqli_query($conn,$sql);
?>
          <div class="row">
            <div class="col-12">
              <!-- <a href="?p=new-form" class="btn btn-outline-success float-right" role="button">Create New Form</a> -->
              <h2>Available Entities</h2>
              <p>Here are the available Entities</p>
              <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search for available entities ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Login Enabled</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($result)){
                $i++;
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['entity_name'] . "</td>";
                echo "<td>" . $row['entity_code'] . "</td>";
                echo "<td>" . $row['entity_description'] . "</td>";
                echo "<td>" . $row['allow_login'] . "</td>";
                echo '<td>'.printInputLink('input-entity','2',$row['id'],'e='.$row['entity_code'].'&eid='.$row['id'].'').printViewLink('list-entity-data','2',$row['id'],'e='.$row['entity_code'].'&eid='.$row['id'].'').printEditLink('edit-entity','0','0','e='.$row['entity_code'].'&eid='.$row['id'].'').printDeleteLink('delete-entity','0','0','e_id='.$row['id'].'').printPermissionLink('list-entity-permissions','e='.$row['entity_code'].'&eid='.$row['id'].'').'</td>';
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