<?php

$session_entity_id = $_SESSION['entity_id'];
$session_member_id = $_SESSION['member_id'];

$form_code = make_safe($_GET['f']);
$form_id =  make_safe($_GET['fid']);
//test access
validateUserAccess(make_safe($_GET['p']),'1',$form_id);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result0 = mysqli_query($conn,"SELECT * from system_forms WHERE form_code = '".$form_code."';");
$row0 = mysqli_fetch_array($result0);

$result1 = mysqli_query($conn,"SELECT * from system_entities WHERE id = '".$row0['form_entity_link']."';");
$row1 = mysqli_fetch_array($result1);


?>

<!-- tests below -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<?php

$entity_code = $row1['entity_code'];
$entity_id = $row1['id'];
$entity_lookup_field = "unique_code";

echo '
<script>
$(function() {
    $( "#unique_code" ).autocomplete({
        source: "system/query.php?p=input-entity&entity_code='.$entity_id.'&lookup='.$entity_lookup_field.'"
    });
});
</script>
';

?>
          <div class="row">
            <div class="col-8">
              <h2><?php echo $row0['form_name'];?></h2>
              <p><?php echo $row0['form_description'];?></p>
              <hr>
              <form action="system/functions.php" method="post">
              <h5>Entity Link</h3>
              <div class="form-group">
                <label for="search">Please Input Unique ID of the <?php echo $row1['entity_name']; ?></label>
                <!-- <input type="text" class="form-control dropdown" id="<?php //echo $entity_code."_code"; ?>" name="<?php //echo $entity_code."_code"; ?>" required> -->
                <input type="text" class="form-control dropdown" id="unique_code" name="unique_code" required>

              </div>
              <!-- <p>The data you're entering is for "Juan Dela Cruz".</p> -->
              <hr>
              <h5><?php echo $row0['form_name'];?> Fields</h3>
                <input type="text" class="form-control" id="form_code" name="form_code" hidden value="<?php echo $row0['form_code'];?>">
                <input type="text" class="form-control" id="form_id" name="form_id" hidden value="<?php echo $row0['id'];?>">
                <input type="text" class="form-control" id="entity_code" name="entity_code" hidden value="<?php echo $entity_code;?>">
                <input type="text" class="form-control" id="created_by" name="created_by" hidden value="<?php echo $session_member_id;?>">
                
                <?php
                $result = mysqli_query($conn,"SELECT * from system_fields INNER JOIN system_forms ON system_forms.id = system_fields.form_link WHERE system_forms.form_code = '".$form_code."'  ORDER BY system_fields.field_order;");

                $i = 0; 
                while($row = mysqli_fetch_array($result)){
                  $i++;
                  renderField($row['type'],$row['placeholder'],$row['required'],$row['field_value'],$row['name'],$row['code']);
                }
 
                ?>

                <button type="submit" class="btn btn-primary mb-2" name="save-form-data">Save</button>
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
              <h4>Actions</h4>
            <?php echo "<p>" . printViewLink('list-form-data','1',$form_id,'f='.$form_code.'&fid='.$form_id.'') . printEditLink('edit-form','0','0','fid='.$form_id.'') .printPermissionLink('list-form-permissions','f='.$form_code.'&fid='.$form_id.'')."</p>" ?>
            <?php
              // if ($session_entity_id == '0') {
              //   $count = '1';

              // } else {
              //   $permission_check = mysqli_query($conn,"SELECT * FROM system_permissions INNER JOIN system_permissions_config ON system_permissions_config.permission_id = system_permissions.id WHERE system_permissions.code = 'add-new-field-form' AND system_permissions_config.entity_id = '$session_entity_id'");
              //   $count = mysqli_num_rows($permission_check);
              // }
              // // echo $count;

              $aclValue = validateUserPermission("add-new-field-form","1",$form_id);

              if ($aclValue == '200') {
                echo '
            <h4><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add New Field</a></h4>
            <p>Add new fields to this form.</p>
            <p>
            </p>    

            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <form action="system/functions.php" method="post">
                <input type="text" class="form-control" id="form_code" name="form_code" hidden value="'.$_GET['f'].'">';

              if (isset($form_id)) {
                echo '<input type="text" class="form-control" id="field_form_link" name="field_form_link" hidden value="'.$form_id.'">';
              }
              elseif (isset($_GET['eid'])) {
                echo '<input type="text" class="form-control" id="field_entity_link" name="field_entity_link" hidden value="'.$_GET['eid'].'">';
              }


                echo '
                <div class="form-group">
                  <label for="field_name">Field Name</label>
                  <input type="text" class="form-control" id="field_name" name="field_name" placeholder="friendly name of the field">
                </div>
                <div class="form-group">
                  <label for="field_code">Field Code</label>
                  <input type="text" class="form-control" id="field_code" name="field_code" placeholder="codes are used to differentiate fields with the same name">
                </div>
                <div class="form-group">
                  <label for="field_placeholder">Placeholder</label>
                  <input type="text" class="form-control" id="field_placeholder" name="field_placeholder" placeholder="helper text">
                </div>
                <div class="form-group">
                  <label for="field_type">Field Type</label>
                  <select class="form-control" id="field_type" name="field_type">
                    <option value="text" selected="selected">Short Answer</option>
                    <option value="textarea">Paragraph</option>
                    <option value="select">Dropdown</option>
                    <option value="radio">Multiple Choice</option>
                    <option value="email">Email</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="field_value">Form Value</label>
                  <input type="text" class="form-control" id="field_value" name="field_value" placeholder="use comma to separate values">
                </div>
                <div class="form-group">
                  <label for="field_valid_char">Allowed Characters</label>
                  <select class="form-control" id="field_valid_char" name="field_valid_char">
                    <option value="any" selected="selected">Anything</option>
                    <option value="alphanumeric-only">Alphanumeric Only</option>
                    <option value="alphabet-only">Alphabet Only</option>
                    <option value="numbers-only">Numbers Only</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="field_order">Field Order</label>
                  <input type="text" class="form-control" id="field_order" name="field_order" placeholder="Number will be used in ordering the fields.">
                </div>
                <div class="form-group">
                  <label for="field_required">Field Required</label>
                  <input class="form-control" type="checkbox" value="required" id="field_required" name="field_required">
                </div>

                <button type="submit" class="btn btn-primary mb-2" name="add_field_inside">Add Field</button>
                </form>
              </div>
            </div>


                  ';
              }

            ?>


            </div>
          </div>


          <!-- confirmation modal -->
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          Confirm Field Deleteion from Form
                      </div>
                      <div class="modal-body">
                          This process cannot be undone. This will delete all data related to this field.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-danger btn-ok">Delete</a>
                      </div>
                  </div>
              </div>
          </div>