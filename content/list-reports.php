<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

if ($_SESSION['entity_id'] == '0') {

  $sql = "SELECT * FROM system_reports WHERE (report_name LIKE '%$keyword%' OR report_description LIKE '%$keyword%' OR report_code LIKE '%$keyword%') ORDER BY id, report_code";

} else {
  
  $permission_code = "view-report";
  $entity_id = $_SESSION['entity_id'];
  $school_id = $_SESSION['school_id'];
  $member_id = $_SESSION['member_id'];

  echo $member_id;

  $sql = "SELECT DISTINCT(system_reports.report_name),system_reports.report_code,system_reports.report_description,system_reports.id,system_reports.form_link 
        FROM system_reports 
        INNER JOIN system_permissions_config ON system_permissions_config.link_id = system_reports.id 
        INNER JOIN system_permissions ON system_permissions.id = system_permissions_config.permission_id 
        WHERE ((system_permissions.permission_type = '3' AND 
        system_permissions.code like '$permission_code' AND 
        system_permissions_config.entity_id like '$entity_id' AND 
        system_permissions_config.school_id like '$school_id') OR system_reports.created_by LIKE '$member_id') AND
        (system_reports.report_name LIKE '%$keyword%' OR system_reports.report_description LIKE '%$keyword%' OR system_reports.report_code LIKE '%$keyword%') 
        ORDER BY system_reports.id, system_reports.report_code";
}



$result = mysqli_query($conn,$sql);
?>

          <div class="row">
            <div class="col-12">
              <a href="?p=new-report" class="btn btn-outline-success float-right" role="button">Create New Report</a>
              <h2>Available Reports</h2>
              <p>Here are the available Reports</p>
              <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search for available reports ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
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
                echo "<td>" . $row['report_name'] . "</td>";
                echo "<td>" . $row['report_code'] . "</td>";
                echo "<td>" . $row['report_description'] . "</td>";
                echo '<td>'.printViewReport($row['id'],'f_link='.$row['form_link'].'') . printEditLink('edit-report','3',$row['id'],'rid='.$row['id'].''). printDeleteLink('delete-report','3',$row['id'],'unique_code='.$row['unique_code'] .'r_id='.$row['id'].'').printPermissionLink('list-report-permissions','rid='.$row['id'].'&rcode='.$row['report_code'].'').'</td>';
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



          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          Confirm Deletion of Report
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