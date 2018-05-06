<?php
//select form/header/footer based on permission

if ($_SESSION['entity_id'] == '0') {

  $sql_forms = "SELECT * FROM system_forms";
  $sql_header = "SELECT * FROM system_reports_hnf WHERE type = 'header'";
  $sql_footer = "SELECT * FROM system_reports_hnf WHERE type = 'footer'";

} else {

  $entity_id = $_SESSION['entity_id'];
  $school_id = $_SESSION['school_id'];

  $permission_code_form = "list-forms";
  $sql_forms = "SELECT DISTINCT(system_forms.form_name),system_forms.form_code,system_forms.form_description,system_forms.id 
        FROM system_forms 
        INNER JOIN system_permissions_config ON system_permissions_config.link_id = system_forms.id 
        INNER JOIN system_permissions ON system_permissions.id = system_permissions_config.permission_id 
        WHERE system_permissions.permission_type = 1 AND 
        system_permissions.code like '$permission_code_form' AND 
        system_permissions_config.entity_id like '$entity_id' AND 
        system_permissions_config.school_id like '$school_id'
        ORDER BY system_forms.id, system_forms.form_code";

  $permission_code = "view-template";
  $sql_header = "SELECT DISTINCT(system_reports_hnf.name),system_reports_hnf.content,system_reports_hnf.type,system_reports_hnf.id
        FROM system_reports_hnf 
        INNER JOIN system_permissions_config ON system_permissions_config.link_id = system_reports_hnf.id 
        INNER JOIN system_permissions ON system_permissions.id = system_permissions_config.permission_id 
        WHERE system_permissions.permission_type = '4' AND 
        system_permissions.code like '$permission_code' AND 
        system_permissions_config.entity_id like '$entity_id' AND 
        system_permissions_config.school_id like '$school_id' AND
        system_reports_hnf.type LIKE 'header'
        ORDER BY system_reports_hnf.id, system_reports_hnf.name";

  $sql_footer = "SELECT DISTINCT(system_reports_hnf.name),system_reports_hnf.content,system_reports_hnf.type,system_reports_hnf.id
        FROM system_reports_hnf 
        INNER JOIN system_permissions_config ON system_permissions_config.link_id = system_reports_hnf.id 
        INNER JOIN system_permissions ON system_permissions.id = system_permissions_config.permission_id 
        WHERE system_permissions.permission_type = '4' AND 
        system_permissions.code like '$permission_code' AND 
        system_permissions_config.entity_id like '$entity_id' AND 
        system_permissions_config.school_id like '$school_id' AND
        system_reports_hnf.type LIKE 'footer'
        ORDER BY system_reports_hnf.id, system_reports_hnf.name";
}


?>

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
                    $result = mysqli_query($conn,$sql_header);
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
                    $result = mysqli_query($conn,$sql_footer);
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
                    $result = mysqli_query($conn,$sql_forms);

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