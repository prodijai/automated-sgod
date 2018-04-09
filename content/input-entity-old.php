<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result0 = mysqli_query($conn,"SELECT * from system_entities WHERE entity_code = '".make_safe($_GET['e'])."';");
$row0 = mysqli_fetch_array($result0)
?>
          <div class="row">
            <div class="col-8">
              <h2><?php echo $row0['entity_name'];?></h2>
              <p><?php echo $row0['entity_description'];?></p>
              <hr>
              <form action="system/functions.php" method="post">
                <input type="text" class="form-control" id="entity_code" name="entity_code" hidden value="<?php echo $_GET['e'];?>">

                <!-- Unique Code -->
                <div class="form-group">
                  <label for="unique_code">Unique Code</label>
                  <input type="text" class="form-control" id="unique_code" name="unique_code" placeholder="Unique Code of Entity">
                </div>

              <?php
              // $result = mysqli_query($conn,"SELECT * from system_fields INNER JOIN system_entities ON system_entities.id = system_fields.entity_link WHERE system_entities.entity_code = '".make_safe($_GET['e'])."'  ORDER BY system_fields.field_order;");

              // $i = 0; 
              // while($row = mysqli_fetch_array($result)){
              //   $i++;
              //   renderField($row['type'],$row['placeholder'],$row['required'],$row['field_value'],$row['name'],$row['code']);
              // }
              // mysqli_close($conn);

              ?>

              <button type="submit" class="btn btn-primary mb-2" name="save-entity">Save</button>
              </form>
            </div>
            
            <div class="col-4">
              <?php actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);?>
            <h4><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add New Field</a></h4>
            <p>Add new fields to this entity.</p>
            <p>
            </p>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <form action="system/functions.php" method="post">
                <input type="text" class="form-control" id="entity_code" name="entity_code" hidden value="<?php echo $_GET['e'];?>">
                <input type="text" class="form-control" id="field_entity_link" name="field_entity_link" hidden value="<?php echo $_GET['eid'];?>">
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
            </div>
          </div>