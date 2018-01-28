          <div class="row">
            <div class="col-8">
              <h2>New Form</h2>
              <form action="system/functions.php" method="post">
              <div class="form-group">
                <label for="form_name">Form Name</label>
                <input type="text" class="form-control" id="form_name" name="form_name" placeholder="Friendly Form Name">
              </div>
              <div class="form-group">
                <label for="form_code">Form Code</label>
                <input type="text" class="form-control" id="form_code" name="form_code" placeholder="Code Identifier for the Form">
              </div>
              <div class="form-group">
                <label for="form_desc">Form Description</label>
                <input type="text" class="form-control" id="form_desc" name="form_desc" placeholder="Add a short description of the Form">
              </div>
              <div class="form-group">
                <label for="form_link">Link to Entity</label>
                <select class="form-control" id="form_link" name="form_link">
                <?php 
                    include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
                    $result = mysqli_query($conn,"SELECT * FROM system_entities");

                    $i = 0; 
                    while($row = mysqli_fetch_array($result)){
                      $i++;
                      echo '<option value="'.$row['id'].'">'.$row['entity_name'].'</option>';
                    }
                    mysqli_close($conn);

                ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="new_form">Create Form</button>
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