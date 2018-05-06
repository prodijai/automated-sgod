          <div class="row">
            <div class="col-8">
              <h2>Create Entity</h2>
              <form action="system/functions.php" method="post">
              <div class="form-group">
                <label for="entity_name">Entity Name</label>
                <input type="text" class="form-control" id="entity_name" name="entity_name" placeholder="Friendly Entity Name" required>
              </div>
              <div class="form-group">
                <label for="entity_code">Entity Code</label>
                <input type="text" class="form-control" id="entity_code" name="entity_code" placeholder="Code Identifier for the Entity" required>
              </div>
              <div class="form-group">
                <label for="entity_desc">Entity Description</label>
                <input type="text" class="form-control" id="entity_desc" name="entity_desc" placeholder="Add a short description of the Entity" required>
              </div>

              <div class="form-group">
                <label for="enable_login">Enable Login</label>
                <select class="form-control" id="enable_login" name="enable_login">
                  <option value="" disabled="" selected="">Is entity allowed to login?</option>
                  <option value="yes">yes</option>
                  <option value="no">no</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="create_entity">Create Entity</button>
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