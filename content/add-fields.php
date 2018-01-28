          <div class="row">
            <div class="col-8">
              <h2>Add New Field</h2>
              <form action="system/functions.php" method="post">
              <div class="form-group">
                <label for="field_valid_char">Add Field to</label>
                <select class="form-control" id="field_valid_char" name="field_valid_char">
                <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_entities");

                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="ent-'.$row['id'].'">'.$row['entity_name'].'</option>';
                    }
                    mysqli_close($conn);

                ?>
                <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_forms");

                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="form-'.$row['id'].'">'.$row['form_name'].'</option>';
                    }
                    mysqli_close($conn);

                ?>
                </select>
              </div>
              <hr>
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
                  <option value="aphabet-only">Alphabet Only</option>
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

              <button type="submit" class="btn btn-primary mb-2" name="add_field">Add Field</button>
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