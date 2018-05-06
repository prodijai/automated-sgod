<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");

$id = make_safe($_GET['uid']);
$entity_id = make_safe($_GET['eid']);

validateUserAccess("edit-entity-data",'2',$entity_id);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_users WHERE unique_code = '$id' AND entity_id = '$entity_id' LIMIT 1");
$user_data = mysqli_fetch_array($result);

?>
          <div class="row">
            <div class="col-8">
              <h2>Edit Encoded Entity</h2>
              <p>Unique Codes cannot be edited.</p>
              <hr>
              <form action="system/functions.php" method="post">
                <input type="hidden" class="form-control" id="userid" name="userid" readonly value="<?php echo $user_data['id'];?>">
                <input type="hidden" class="form-control" id="entity_id" name="entity_id" readonly value="<?php echo $entity_id;?>">

                <!-- Unique Code -->
                <div class="form-group">
                  <label for="unique_code">Unique Code</label>
                  <input type="text" class="form-control" id="unique_code" name="unique_code" required placeholder="Unique Code of Entity" readonly value="<?php echo $user_data['unique_code'];?>">
                </div>

                <!-- First Name -->
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="First Name" value="<?php echo $user_data['first_name'];?>">
                </div>

                <!-- Middle Name -->
                <div class="form-group">
                  <label for="middle_name">Middle Name</label>
                  <input type="text" class="form-control" id="middle_name" name="middle_name" required placeholder="Middle Name" value="<?php echo $user_data['middle_name'];?>">
                </div>

                <!-- Last Name -->
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Last Name" value="<?php echo $user_data['last_name'];?>">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address" value="<?php echo $user_data['email'];?>">
                </div>

                <!-- Mobile Number -->
                <div class="form-group">
                  <label for="mobile">Mobile Number</label>
                  <input type="text" class="form-control" id="mobile" name="mobile" required placeholder="Mobile Number" value="<?php echo $user_data['mobile'];?>">
                </div>

                <!-- School -->
                <div class="form-group">
                <label for="enable_login">School</label>
                <select class="form-control" id="school_id" name="school_id">
                  <option value="" disabled="" selected="">Which school they belong?</option>
                  <option value="0">n/a</option>
                  <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_schools");

                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="'.$row['id'].'" '.testSelected($row['id'],$user_data['school_id']).'>'.$row['school_acronym'].' - '.$row['school_code'].'</option>';
                    }
                    mysqli_close($conn);

                  ?>
                </select>
              </div>

                <!-- Username -->
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required placeholder="Username" value="<?php echo $user_data['username'];?>">
                </div>

              <button type="submit" class="btn btn-primary mb-2" name="edit-entity-data">Save Edits</button>
              </form>
            </div>
            
            <div class="col-4">
            <?php actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);?>
            <h4>Updates</h4>
            <p>Updates and notifications.</p>
              
            </div>
          </div>