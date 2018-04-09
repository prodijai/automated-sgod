          <div class="row">
            <div class="col-8">
              <h2>New Report</h2>
              <form action="system/functions.php" method="post">
              <div class="form-group">
                <label for="report_name">Report Name</label>
                <input type="text" class="form-control" id="report_name" name="report_name" placeholder="Friendly Report Name" required>
              </div>
              <div class="form-group">
                <label for="report_desc">Report Code</label>
                <input type="text" class="form-control" id="report_code" name="report_code" placeholder="Report Code" required>
              </div>
              <div class="form-group">
                <label for="report_desc">Report Description</label>
                <input type="text" class="form-control" id="report_desc" name="report_desc" placeholder="Report Short Description" required>
              </div>
              <div class="form-group">
                <label for="report_code">Report Header</label>
                <select class="form-control" id="report_header" name="report_header" required>
                <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_reports_hnf WHERE type = 'header'");
                    echo '<option value="0">none</option>';
                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    mysqli_close($conn);

                ?>
                </select>
              </div>
              <div class="form-group">
                <label for="report_code">Report Footer</label>
                <select class="form-control" id="report_footer" name="report_footer" required>
                <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_reports_hnf WHERE type = 'footer'");
                    echo '<option value="0">none</option>';
                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                    mysqli_close($conn);

                ?>
                </select>
              </div>
              <div class="form-group">
                <label for="report_link">Form Link</label>
                <select class="form-control" id="report_link" name="report_link" required>
                <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_forms");

                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="'.$row['id'].'">'.$row['form_name'].'</option>';
                    }
                    mysqli_close($conn);

                ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="new_report">Create Report</button>
              </form>
            </div>
            
            <div class="col-4">
              <?php 
                // echo $_SESSION['action_result_page'] . 'result page <br>';
                // echo $_SESSION['action_notif_type'] . '<br>';
                // echo $_SESSION['action_result_message'] . '<br>';
                // echo $_GET['p'] . 'current page <br>';

                actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);

              ?>
            <h4>Tip</h4>
            <p>Fields should be created first before you can add them to a form.</p>
            </div>
          </div>