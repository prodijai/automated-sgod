<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");
$form_id = make_safe($_GET['fid']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT system_forms.id,system_forms.form_name,system_forms.form_code,system_forms.form_description,system_entities.entity_name FROM system_forms INNER JOIN system_entities ON system_entities.id = system_forms.form_entity_link WHERE system_forms.id = $form_id LIMIT 1;");
$form_details = mysqli_fetch_array($result);

?>
          <div class="row">
            <div class="col-8">
              <h2>Edit Form</h2>
              <p>Edit form details. Codes and Form Link can not be edited.</p>
              <form action="system/functions.php" method="post">
              <input type="hidden" class="form-control" id="form_id" name="form_id" readonly value="<?php echo $form_details['id'];?>">
              <div class="form-group">
                <label for="form_name">Form Name</label>
                <input type="text" class="form-control" id="form_name" name="form_name" placeholder="Friendly Form Name" required value="<?php echo $form_details['form_name'];?>">
              </div>
              <div class="form-group">
                <label for="form_code">Form Code</label>
                <input type="text" class="form-control" id="form_code" name="form_code" placeholder="Code Identifier for the Form" required readonly value="<?php echo $form_details['form_code'];?>">
              </div>
              <div class="form-group">
                <label for="form_desc">Form Description</label>
                <input type="text" class="form-control" id="form_desc" name="form_desc" placeholder="Add a short description of the Form" required value="<?php echo $form_details['form_description'];?>">
              </div>
              <div class="form-group">
                <label for="form_link">Linked to Entity</label>
                <input type="text" class="form-control" id="form_link" name="form_link" placeholder="Linked to Entity" required readonly value="<?php echo $form_details['entity_name'];?>">
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="edit-form">Edit Form</button>
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
            <!-- <p>Fie.</p> -->
            </div>
          </div>