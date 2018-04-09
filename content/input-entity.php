<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result0 = mysqli_query($conn,"SELECT * from system_entities WHERE entity_code = '".make_safe($_GET['e'])."';");
$row0 = mysqli_fetch_array($result0)
?>
<script type="text/javascript">
  function generateLoginCreds(f) {
    f.user_name.value = f.email.value;
    f.password.value = f.last_name.value + "_" + f.unique_code.value;

  }
</script>
          <div class="row">
            <div class="col-8">
              <h2><?php echo $row0['entity_name'];?></h2>
              <p><?php echo $row0['entity_description'];?></p>
              <hr>
              <form action="system/functions.php" method="post">
                <input type="text" class="form-control" id="entity_code" name="entity_code" hidden value="<?php echo $_GET['eid'];?>">

                <!-- Unique Code -->
                <div class="form-group">
                  <label for="unique_code">Unique Code</label>
                  <input type="text" class="form-control" id="unique_code" name="unique_code" required placeholder="Unique Code of Entity">
                </div>

                <!-- First Name -->
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="First Name">
                </div>

                <!-- Middle Name -->
                <div class="form-group">
                  <label for="middle_name">Middle Name</label>
                  <input type="text" class="form-control" id="middle_name" name="middle_name" required placeholder="Middle Name">
                </div>

                <!-- Last Name -->
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Last Name">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="mobile">Mobile Number</label>
                  <input type="text" class="form-control" id="mobile" name="mobile" required placeholder="Mobile Number">
                </div>
                <h4>Login Credentials</h4>
                <p>The username cannot be changed.</p>
                <hr>
                <!-- User Name -->
                <div class="form-group">
                  <label for="user_name">User Name</label>
                  <input type="text" class="form-control" id="user_name" name="user_name" required placeholder="email address will be used as username" onfocus="generateLoginCreds(this.form)" onclick="generateLoginCreds(this.form)">
                </div>

                <!-- Password -->
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required placeholder="Default password is lastName_uniqueCode">
                </div>

              <button type="submit" class="btn btn-primary mb-2" name="save-entity-new">Save</button>
              </form>
            </div>
            
            <div class="col-4">
            <h4>Updates</h4>
            <p>Updates and notifications.</p>
              <?php actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);?>
            </div>
          </div>