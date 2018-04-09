          <div class="row">
            <div class="col-12">
              <div class="btn-group" data-toggle="buttons" style="float: right !important;">
                <!-- <button type="button" class="btn btn-outline-primary">Primary</button> -->
                <!-- <button type="button" class="btn btn-outline-secondary">Secondary</button> -->
                <button type="button" class="btn btn-outline-success">New Header</button>
                <button type="button" class="btn btn-outline-success">New Footer</button>                
                <!-- <button type="button" class="btn btn-outline-info">Info</button> -->
                <!-- <button type="button" class="btn btn-outline-warning">Warning</button> -->
                <!-- <button type="button" class="btn btn-outline-danger">Danger</button> -->
            </div>
            <h2>Headers and Footers</h2>
              <form action="system/functions.php" method="post">
              <div class="form-group">
                <label for="entity_name">Entity Name</label>
                <input type="text" class="form-control" id="entity_name" name="entity_name" placeholder="Friendly Entity Name">
              </div>
              <div class="form-group">
                <label for="entity_code">Entity Code</label>
                <input type="text" class="form-control" id="entity_code" name="entity_code" placeholder="Code Identifier for the Entity">
              </div>
              <div class="form-group">
                <label for="entity_desc">Entity Description</label>
                <input type="text" class="form-control" id="entity_desc" name="entity_desc" placeholder="Add a short description of the Entity">
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="create_entity">Create Entity</button>
              </form>
            </div>
            
<!--             <div class="col-4">
              <?php 
                // echo $_SESSION['action_result_page'] . 'result page <br>';
                // echo $_SESSION['action_notif_type'] . '<br>';
                // echo $_SESSION['action_result_message'] . '<br>';
                // echo $_GET['p'] . 'current page <br>';

                //actionResult($_SESSION['action_result_page'],$_GET['p'],$_SESSION['action_notif_type'],$_SESSION['action_result_message']);

              ?>
            <h4>Tip</h4>
            <p>Fields should be created first before you can add them to a form.</p>
            </div> -->
          </div>