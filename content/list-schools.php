<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_schools WHERE (school_name LIKE '%$keyword%' OR school_code LIKE '%$keyword%' OR school_description LIKE '%$keyword%' OR school_acronym LIKE '%$keyword%') ORDER BY id,school_code");
?>
        <h2>Available Schools</h2>
        <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search for available school ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
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
                  <th>Short Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($result)){
                $i++;
                $school_id = $row['id'];
                echo "<tr>";
                echo "<td>" . $school_id . "</td>";
                echo "<td>" . $row['school_name'] . "</td>";
                echo "<td>" . $row['school_code'] . "</td>";
                echo "<td>" . $row['school_acronym'] . "</td>";
                echo "<td>" . $row['school_description'] . "</td>";
                echo "<td>".printEditLink('edit-school','0','0','sid='.$row['id'].'');

                $school_data_check = mysqli_query($conn,"SELECT * FROM system_users WHERE school_id = '$school_id';");
                $count = mysqli_num_rows($school_data_check);

                if ($count < 1) {
                  echo printDeleteLink('delete-school','0','0','s_id='.$row['id'].'');
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
                          Confirm Deletion of School
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