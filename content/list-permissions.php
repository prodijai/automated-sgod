<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_permissions ORDER BY category");
$entity = mysqli_query($conn,"SELECT * FROM system_entities WHERE allow_login = 'yes' ORDER BY id");

function returnIfChecked($p_id, $e_id){
  include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
  $permission_config = mysqli_query($conn,"SELECT * FROM system_permissions_config WHERE permission_id = $p_id AND entity_id = $e_id");

  $count=mysqli_num_rows($permission_config);

  if ($count > 0){
    return "checked";
  }
}

?>
<script type="text/javascript">
function checkAll(formname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname].getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
}
</script>
          <div class="row">
            <div class="col-12">
              <h2>Permissions and Access Control</h2>
              <p>System Configuration</p>
              <p class="float-sm-right" class="pull-right"><a onclick="javascript:checkAll('table_1', true);" href="javascript:void();">check all</a> | <a onclick="javascript:checkAll('table_1', false);" href="javascript:void();">uncheck all</a></p>
              <form action="system/functions.php" method="post" name="table_1">
              <table class="table table-striped">
              <thead>
                <tr>
                  <th>Permission</th>
                  <th>Permission Group</th>
                  <th>Permission Code</th>

                  <?php
                    $i = 0; 
                    while($entity_row = mysqli_fetch_array($entity)){
                      $i++;
                      echo "<th><center>" . $entity_row['entity_name'] . "</center></th>";

                    }
                  ?>
                </tr>
              </thead>
              <tbody>

              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($result)){
                $i++;
                echo "<tr>";
                echo "<td><strong>" . $row['name'] . "</strong><br>" . $row['description'] ."</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['code'] . "</td>";


                    mysqli_data_seek($entity, 0);
                    $i = 0; 
                    while($entity_row = mysqli_fetch_array($entity)){
                      $i++;
                      $checked_value = returnIfChecked($row['id'],$entity_row['id']);
                      echo "<td><center><input type='checkbox' class='form-check-input' id='".$row['id']."_".$entity_row['id']."' name='".$row['id']."_".$entity_row['id']."' ".$checked_value."></center></td>";
                    }

                echo "</tr>";
              }
              ?>
              </tbody>
              </table>
              <button type="submit" class="btn btn-primary mb-2" name="save_config_permission">Save Permission Configuration</button>
              </form>
            </div>
            <?php mysqli_close($conn); ?>
            
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