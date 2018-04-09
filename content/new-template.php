          <div class="row">
            <div class="col-8">
              <h2>Add New Header or Footer</h2>
              <p>List of available headers and footers</p>
              <hr>
              <form action="system/functions.php" method="post">
                <div class="form-group">
                  <label for="field_name">Name</label>
                  <input type="text" class="form-control" id="field_name" name="field_name" placeholder="Name of the header or footer" required>
                </div>
                <div class="form-group">
                  <label for="field_content">Content</label>
                  <textarea class="form-control" id="field_content" name="field_content" required="" rows="10" placeholder="Content of the header or footer.">

                  </textarea>
                </div>
                <div class="form-group">
                  <label for="field_type">Type</label>
                  <select class="form-control" id="field_type" name="field_type" required>
                    <option value="header">header</option>
                    <option value="footer">footer</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2" name="add_hnf">Add New Header/Footer</button>
                </form>


            </div>
            
            <div class="col-4">
              <h4>Updates and Notifications</h4>
              <?php 
                // echo $_SESSION['action_result_page'] . 'result page <br>';
                // echo $_SESSION['action_notif_type'] . '<br>';
                // echo $_SESSION['action_result_message'] . '<br>';
                // echo $_GET['p'] . 'current page <br>';

                actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);

              ?>
            <p>
            </p>
            </div>
          </div>
