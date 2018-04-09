<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");

$entity_id = make_safe($_GET['eid']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_entities WHERE id = $entity_id LIMIT 1");
$entity_data = mysqli_fetch_array($result);

?>

          <div class="row">
            <div class="col-8">
              <h2>Edit Entity</h2>
              <p>Edit entity details. Codes can not be edited.</p>
              <form action="system/functions.php" method="post">
                <input type="hidden" class="form-control" id="entity_id" name="entity_id" readonly value="<?php echo $entity_data['id'];?>">
              <div class="form-group">
                <label for="entity_name">Entity Name</label>
                <input type="text" class="form-control" id="entity_name" name="entity_name" placeholder="Friendly Entity Name" required value="<?php echo $entity_data['entity_name'];?>">
              </div>
              <div class="form-group">
                <label for="entity_code">Entity Code</label>
                <input type="text" class="form-control" id="entity_code" name="entity_code" placeholder="Code Identifier for the Entity" required value="<?php echo $entity_data['entity_code'];?>" readonly>
              </div>
              <div class="form-group">
                <label for="entity_desc">Entity Description</label>
                <input type="text" class="form-control" id="entity_desc" name="entity_desc" placeholder="Add a short description of the Entity" required value="<?php echo $entity_data['entity_description'];?>">
              </div>
              <div class="form-group">
                <label for="enable_login">Enable Login</label>
                <select class="form-control" id="enable_login" name="enable_login">
                  <option value="yes" <?php echo testSelected('yes',$entity_data['allow_login']); ?>>yes</option>
                  <option value="no" <?php echo testSelected('no',$entity_data['allow_login']); ?>>no</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="edit-entity">Edit Entity</button>
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
            <p>Entities are linked to a form.</p>
            </div>
          </div>