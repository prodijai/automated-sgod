<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");

$id = make_safe($_GET['sid']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_schools WHERE id = $id LIMIT 1");
$data = mysqli_fetch_array($result);

?>

          <div class="row">
            <div class="col-8">
              <h2>Edit School</h2>
              <p>School Code cannot be edited.</p>
              <form action="system/functions.php" method="post">
                <input type="hidden" class="form-control" id="schoold_id" name="schoold_id" readonly value="<?php echo $data['id'];?>">
              <div class="form-group">
                <label for="school_name">School Name</label>
                <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name" required value="<?php echo $data['school_name'];?>">
              </div>
              <div class="form-group">
                <label for="school_code">School Shortname</label>
                <input type="text" class="form-control" id="school_acronym" name="school_acronym" placeholder="Acronym or Short Name" required value="<?php echo $data['school_acronym'];?>">
              </div>
              <div class="form-group">
                <label for="school_code">School Code</label>
                <input type="text" class="form-control" id="school_code" name="school_code" placeholder="Code Identifier for the School" required readonly value="<?php echo $data['school_code'];?>">
              </div>
              <div class="form-group">
                <label for="school_desc">School Description</label>
                <input type="text" class="form-control" id="school_desc" name="school_desc" placeholder="Add a short description of the School" required value="<?php echo $data['school_description'];?>">
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="edit-school">Edit School</button>
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
            <p>Schools can be edited in this page.</p>
            </div>
          </div>