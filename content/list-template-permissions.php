<?php

$template_id = $_GET['tid'];
// $template_code = $_GET['rcode'];


include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$schools = mysqli_query($conn,"SELECT * FROM system_schools ORDER BY id");
$entities = mysqli_query($conn,"SELECT * FROM system_entities WHERE allow_login = 'yes' ORDER BY id");
$permissions = mysqli_query($conn,"SELECT * FROM system_permissions WHERE permission_type = '4' ORDER BY name");

//value needed for colspan
$permission_count=mysqli_num_rows($permissions) + 1;

function returnIfChecked($p_id, $e_id, $l_id, $s_id){
  include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
  $permission_config = mysqli_query($conn,"SELECT * FROM system_permissions_config WHERE permission_id = $p_id AND entity_id = $e_id AND link_id = $l_id AND school_id = $s_id");

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
              <h2>Template Permissions and Access Control</h2>
              <p>This permissions will only be applied to the Template.</p>
              <p class="float-sm-right" class="pull-right"><a onclick="javascript:checkAll('table_1', true);" href="javascript:void();">check all</a> | <a onclick="javascript:checkAll('table_1', false);" href="javascript:void();">uncheck all</a></p>
              <form action="system/functions.php" method="post" name="table_1">
                <input type="hidden" class="form-control" id="template_id" name="template_id" readonly value="<?php echo $template_id;?>">
                <!-- <input type="hidden" class="form-control" id="template_code" name="template_code" readonly value="<?php echo $template_code;?>"> -->

              <table class="table table-striped">
              <thead>
                <tr>
                  <th>Group</th>
<!--                   <th>List All</th>
                  <th>List in School</th>
                  <th>List Added</th>
                  <th>Edit</th>
                  <th>Add</th>
                  <th>View</th>
                  <th>Permission Edit</th> -->


                  <?php
                    $k = 0; 
                    while($permission = mysqli_fetch_array($permissions)){
                      $k++;
                      echo "<td><center><strong>" . $permission['name'] . "</strong><br><pre><small>".$permission['code']."</small></pre></center></td>";
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
              <?php

              $i = 0; 
              while($school = mysqli_fetch_array($schools)){
                $i++;
                echo "<tr>";
                  //print school name
                  echo "<td colspan='".$permission_count."'><strong>".$school['school_name']."<strong></td>";
                echo "</tr>";

                  mysqli_data_seek($entities, 0);
                  $j = 0; 
                  while($entity = mysqli_fetch_array($entities)){
                    $j++;
                    echo "<tr>";
                      echo "<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$entity['entity_name']."</td>";

                      mysqli_data_seek($permissions, 0);
                      $k = 0; 
                      while($permission = mysqli_fetch_array($permissions)){
                        $k++;
                        $permission_key = $permission['id'] . "_" . $entity['id'] . "_" . $school['id'];
                        // echo "<td><center>" . $permission_key . "</center></td>";
                        $checked_value = returnIfChecked($permission['id'],$entity['id'],$template_id,$school['id']);
                        echo "<td><center><input type='checkbox' class='form-check-input' id='".$permission_key."' name='".$permission_key."' ".$checked_value."></center></td>";

                      }


                    echo "</tr>";
                  }


              }

              ?>

              </tbody>
              </table>
              <button type="submit" class="btn btn-primary mb-2" name="save_template_permission">Save Permission Configuration</button>
              </form>
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