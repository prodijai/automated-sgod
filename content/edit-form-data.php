<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");

$session_entity_id = $_SESSION['entity_id'];
$form_code = make_safe($_GET['f']);
$form_id = make_safe($_GET['fid']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result0 = mysqli_query($conn,"SELECT * from system_forms WHERE form_code = '$form_code';");
$row0 = mysqli_fetch_array($result0);


$user_table = "usr_".$form_code;

#cannot use real id as it's ambigous with other tables, use unique code instead of ID
$id = make_safe($_GET['fiid']);
$result = mysqli_query($conn,"SELECT * FROM $user_table INNER JOIN system_users ON system_users.unique_code = $user_table.unique_code WHERE $user_table.unique_code = '$id' LIMIT 1;");
$form_input_data = mysqli_fetch_array($result);


?>

          <div class="row">
            <div class="col-8">
              <h2><?php echo $row0['form_name'];?></h2>
              <p>Edit previously encoded data.</p>
              <hr>
              <p>You are currently editing the data of <em> <?php echo $form_input_data["first_name"] . " " . $form_input_data["last_name"] . " (".$form_input_data["unique_code"].")" ?></em>.</p>
              <form action="system/functions.php" method="post">
              <h5><?php echo $row0['form_name'];?> Fields</h3>
                <input type="hidden" class="form-control" id="form_code" name="form_code" value="<?php echo $form_code; ?>">
                <input type="hidden" class="form-control" id="form_id" name="form_id" value="<?php echo $form_id; ?>">
                <input type="hidden" class="form-control" id="form_input_id" name="form_input_id" value="<?php echo $id;?>">
                <input type="hidden" class="form-control" id="form_input_user" name="form_input_user" value="<?php echo $form_input_data["first_name"] . " " . $form_input_data["last_name"] . " (".$form_input_data["unique_code"].")"?>">
                <input type="hidden" class="form-control dropdown" id="unique_code" name="unique_code" required readonly value="<?php echo $form_input_data['unique_code'];?>">

                <?php
                  $result = mysqli_query($conn,"SELECT * from system_fields INNER JOIN system_forms ON system_forms.id = system_fields.form_link WHERE system_forms.form_code = '$form_code'  ORDER BY system_fields.field_order;");

                  $i = 0; 
                  while($row = mysqli_fetch_array($result)){
                    $i++;
                    $field_code = $row['code'];
                    renderField($row['type'],$row['placeholder'],$row['required'],$row['field_value'],$row['name'],$field_code,$form_input_data["$field_code"]);
                  }
                ?>

                <button type="submit" class="btn btn-primary mb-2" name="edit-form-data">Save Edits</button>
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