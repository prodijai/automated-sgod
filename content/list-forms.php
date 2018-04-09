<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);


include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");


$result = mysqli_query($conn,"SELECT * FROM system_forms WHERE (form_name LIKE '%$keyword%' OR form_description LIKE '%$keyword%' OR form_code LIKE '%$keyword%') ORDER BY id, form_code");
?>
          <div class="row">
            <div class="col-12">
              <a href="?p=new-form" class="btn btn-outline-success float-right" role="button">Create New Form</a>
              <h2>Available Forms</h2>
              <p>Here are the available Forms</p>
              <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search for available forms ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
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
                echo "<td>" . $row['form_name'] . "</td>";
                echo "<td>" . $row['form_code'] . "</td>";
                echo "<td>" . $row['form_description'] . "</td>";
                echo '<td>'.printInputLink('input-form','f='.$row['form_code'].'&fid='.$row['id'].'') . printViewLink('list-form-data','f='.$row['form_code'].'&fid='.$row['id'].'') . printEditLink('edit-form','fid='.$row['id'].'') . printDeleteLink('delete-form','f_id='.$row['id'].'') .'</td>';
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
                          IMPORTANT: Confirm Deletion of Form
                      </div>
                      <div class="modal-body">
                          This process cannot be undone. All related reports and inputs will be deteled. Press delete to proceed.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-danger btn-ok">Delete</a>
                      </div>
                  </div>
              </div>
          </div>