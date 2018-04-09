<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_fields WHERE (name LIKE '%$keyword%' OR placeholder LIKE '%$keyword%' OR code LIKE '%$keyword%') ORDER BY code, id ASC");
?>
        <h2>Available Fields</h2>
        <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search for available fields ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></a></button>
                    </span>
                  </div>
                  </form>
                </div>
              </div>
              <br>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Placeholders</th>
                  <th>Type</th>
                  <th>Value</th>
                  <th>Allowed Characters</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($result)){
                $i++;
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['code'] . "</td>";
                echo "<td>" . $row['placeholder'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['field_value'] . "</td>";
                echo "<td>" . $row['valid_char'] . "</td>";
                echo "<td>".printEditLink('edit-field','fid='.$row['id'].'');
                if (( $row['form_link'] == "" ) && ( $row['entity_link'] == "")) {
                  echo printDeleteLink('delete-field','f_id='.$row['id'].'');
                }
                echo "</td>";
                echo "</tr>";
              }
              mysqli_close($conn);

              ?>
              </tbody>
            </table>
          </div>

          <!-- confirmation modal -->
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          Confirm Deletion of Field
                      </div>
                      <div class="modal-body">
                          This process cannot be undone. Press delete to proceed.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-danger btn-ok">Delete</a>
                      </div>
                  </div>
              </div>
          </div>