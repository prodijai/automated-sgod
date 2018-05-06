<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$keyword = make_safe($_GET['k']);
$page_id = make_safe($_GET['p']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");

if ($_SESSION['entity_id'] == '0') {

  $sql = "SELECT * FROM system_reports_hnf WHERE (name LIKE '%$keyword%' OR content LIKE '%$keyword%' ) ORDER BY id ASC";

} else {
  
  $permission_code = "view-template";
  $entity_id = $_SESSION['entity_id'];
  $school_id = $_SESSION['school_id'];
  $member_id = $_SESSION['member_id'];

  $sql = "SELECT DISTINCT(system_reports_hnf.name),system_reports_hnf.content,system_reports_hnf.type,system_reports_hnf.id
        FROM system_reports_hnf 
        INNER JOIN system_permissions_config ON system_permissions_config.link_id = system_reports_hnf.id 
        INNER JOIN system_permissions ON system_permissions.id = system_permissions_config.permission_id 
        WHERE ((system_permissions.permission_type = '4' AND 
        system_permissions.code like '$permission_code' AND 
        system_permissions_config.entity_id like '$entity_id' AND 
        system_permissions_config.school_id like '$school_id') OR system_reports_hnf.created_by like '$member_id') AND
        (system_reports_hnf.name LIKE '%$keyword%' OR system_reports_hnf.content LIKE '%$keyword%') 
        ORDER BY system_reports_hnf.id, system_reports_hnf.name";
}

$result2 = mysqli_query($conn,$sql);
?>

          <div class="row">
            <div class="col-12">
              <a href="?p=new-template" class="btn btn-outline-success float-right" role="button">Create New Header or Footer</a>
              <h2>Headers and Footers</h2>
              <p>List of available headers and footers</p>
              <div class="row">
                <div class="col">
                  <form method="get" action="">
                  <div class="input-group">
                    <input type="hidden" name="p" id="p" value="<?php echo $page_id; ?>">
                    <input type="text" class="form-control" name="k" id="k" placeholder="Search for available headers or footers ..." style="max-width: 500px;" value="<?php echo $keyword; ?>">
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
                      <th>Name</th>
                      <th><center>Content</center></th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  $i = 0; 
                  while($row2 = mysqli_fetch_array($result2)){
                    $i++;
                    echo "<tr>";
                    echo "<td>" . $row2['name'] . "</td>";
                    echo "<td>" . $row2['content'] . "</td>";
                    echo "<td>" . $row2['type'] . "</td>";
                    echo '<td>'.printEditLink('edit-template','4',$row2['id'],'tid='.$row2['id'].'').printDeleteLink('delete-template','4',$row2['id'],'t_id='.$row2['id'].'').printPermissionLink('list-template-permissions','tid='.$row2['id'].'').'</td>';
                    echo "</tr>";
                  }
                  mysqli_close($conn);

                  ?>
                  </tbody>
                </table>
              </div>


            </div>
            

          </div>


          <!-- confirmation modal -->
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          Confirm Deletion of Header/Footer
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