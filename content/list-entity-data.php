<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$entity_id = $_GET['eid'];
$entity_code = $_GET['e'];
$result = mysqli_query($conn,"SELECT * FROM system_users WHERE (entity_id = $entity_id AND (first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR unique_code LIKE '%$keyword%')) ORDER BY id");
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
                  <th>Mobile</th>
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
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo '<td> '.printEditLink('edit-entity-data','uid='.$row['unique_code'].'') . printDeleteLink('delete-entity-data','uid='.$row['unique_code'].'&e_id='.$row['entity_id'].'') . '</td>';
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