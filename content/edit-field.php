<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");

$id = make_safe($_GET['fid']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_fields WHERE id = '$id' OR code = '$id' LIMIT 1");
$field_data = mysqli_fetch_array($result);

?>
          <div class="row">
            <div class="col-8">
              <h2>Edit Field</h2>
              <p>Edit field details. Codes and links can not be edited.</p>
              <form action="system/functions.php" method="post">
              <input type="hidden" class="form-control" id="field_id" name="field_id" readonly required value="<?php echo $field_data['id'];?>">
              <hr>
              <div class="form-group">
                <label for="field_name">Field Name</label>
                <input type="text" class="form-control" id="field_name" name="field_name" placeholder="friendly name of the field" required value="<?php echo $field_data['name'];?>">
              </div>
              <div class="form-group">
                <label for="field_code">Field Code</label>
                <input type="text" class="form-control" id="field_code" name="field_code" placeholder="codes are used to differentiate fields with the same name" readonly required value="<?php echo $field_data['code'];?>">
              </div>
              <div class="form-group">
                <label for="field_placeholder">Placeholder</label>
                <input type="text" class="form-control" id="field_placeholder" name="field_placeholder" placeholder="helper text" required value="<?php echo $field_data['placeholder'];?>">
              </div>
              <div class="form-group">
                <label for="field_type">Field Type</label>
                <select class="form-control" id="field_type" name="field_type">
                  <option value="text" <?php echo testSelected('text',$field_data['type']); ?>>Short Answer</option>
                  <option value="textarea" <?php echo testSelected('textarea',$field_data['type']); ?>>Paragraph</option>
                  <option value="select" <?php echo testSelected('select',$field_data['type']); ?>>Dropdown</option>
                  <option value="radio" <?php echo testSelected('radio',$field_data['type']); ?>>Multiple Choice</option>
                  <option value="email" <?php echo testSelected('email',$field_data['type']); ?>>Email</option>
                </select>
              </div>
              <div class="form-group">
                <label for="field_value">Form Value</label>
                <input type="text" class="form-control" id="field_value" name="field_value" placeholder="use comma to separate values" value="<?php echo $field_data['field_value'];?>">
              </div>
              <div class="form-group">
                <label for="field_valid_char">Allowed Characters</label>
                <select class="form-control" id="field_valid_char" name="field_valid_char">
                  <option value="any" <?php echo testSelected('any',$field_data['valid_char']); ?>>Anything</option>
                  <option value="alphanumeric-only" <?php echo testSelected('alphanumeric-only',$field_data['valid_char']); ?>>Alphanumeric Only</option>
                  <option value="alphabet-only" <?php echo testSelected('alphabet-only',$field_data['valid_char']); ?>>Alphabet Only</option>
                  <option value="numbers-only" <?php echo testSelected('numbers-only',$field_data['valid_char']); ?>>Numbers Only</option>
                </select>
              </div>
              <div class="form-group">
                <label for="field_order">Field Order</label>
                <input type="text" class="form-control" id="field_order" name="field_order" placeholder="Number will be used in ordering the fields." required value="<?php echo $field_data['field_order'];?>">
              </div>
              <div class="form-group">
                <label for="field_required">Field Required</label>
                <input class="form-control" type="checkbox" value="required" id="field_required" name="field_required" <?php echo testChecked($field_data['required'], "required"); ?>>
              </div>

              <button type="submit" class="btn btn-primary mb-2" name="edit-field">Edit Field</button>
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