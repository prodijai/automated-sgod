
<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result0 = mysqli_query($conn,"SELECT * from system_reports WHERE report_code = '".make_safe($_GET['r_code'])."';");
$row0 = mysqli_fetch_array($result0);

$report_id = $row0['id'];
// test user permission
validateUserAccess("configure-report",'3',$report_id);

$result1 = mysqli_query($conn,"SELECT * from system_forms WHERE id = '".$row0['form_link']."';");
$row1 = mysqli_fetch_array($result1);

$result2 = mysqli_query($conn,"SELECT * FROM system_fields WHERE (entity_link='".$row1['form_entity_link']."' AND field_order < '4') OR form_link='".$row0['form_link']."' ORDER BY entity_link DESC, form_link, field_order;");
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
             <div class="col-8">
              <h2>Configure Report | <?php echo $row0['report_name']; ?></h2>
              <p><?php echo $row0['report_description']; ?></p>
              <p class="pull-right"><a onclick="javascript:checkAll('table_1', true);" href="javascript:void();">check all</a> | <a onclick="javascript:checkAll('table_1', false);" href="javascript:void();">uncheck all</a></p>
              <div class="table-responsive">
                <form action="system/functions.php" method="post" name="table_1">
                <input type="hidden" class="form-control" id="report_code" name="report_code" value="<?php echo $row0['id']; ?>" required read-only>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Field Name</th>
                      <th>Short Detail</th>
                      <th><center>Visibility</center></th>
                      <th><center>Order</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0; 
                    while($row2 = mysqli_fetch_array($result2)){
                      $i++;
                      echo "<tr>";
                      echo '<input type="hidden" class="form-control" id="field_code_'.$i.'" name="field_code_'.$i.'" value="'.$row2['id'].'" required read-only>';
                      echo "<td>" . $row2['name'] . "</td>";
                      echo "<td>" . $row2['placeholder'] . "</td>";
                      echo '<td><center><input type="checkbox" class="form-check-input" id="field_selected_'.$i.'" name="field_selected_'.$i.'"></center></td>';
                      echo '<td><center><input type="text" class="form-control" id="field_order_'.$i.'" name="field_order_'.$i.'" value="'.$i.'" required style="width: 60px;"></center></td>';
                      echo "</tr>";
                    }
                    mysqli_close($conn);

                    ?>
                  </tbody>
                </table>
              <input type="hidden" class="form-control" id="total_fields" name="total_fields" value="<?php echo $i; ?>" required read-only>
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="save_config_report">Save Report Configuration</button>
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