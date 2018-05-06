          <div class="row">
            <div class="col-8">
              <h2>Create School</h2>
              <form action="system/functions.php" method="post">
              <div class="form-group">
                <label for="school_name">School Name</label>
                <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name" required>
              </div>
              <div class="form-group">
                <label for="school_code">School Shortname</label>
                <input type="text" class="form-control" id="school_acronym" name="school_acronym" placeholder="Acronym or Short Name" required>
              </div>
              <div class="form-group">
                <label for="school_code">School Code</label>
                <input type="text" class="form-control" id="school_code" name="school_code" placeholder="Code Identifier for the School" required>
              </div>
              <div class="form-group">
                <label for="school_desc">School Description</label>
                <input type="text" class="form-control" id="school_desc" name="school_desc" placeholder="Add a short description of the School" required>
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="new-school">Create School</button>
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
            <p>Schools can be created in this page.</p>
            </div>
          </div>