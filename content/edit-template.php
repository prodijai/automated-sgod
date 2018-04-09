
<?php
include_once($_SERVER['DOCUMENT_ROOT']."/ecj1718/system/functions.php");

$template_id = make_safe($_GET['tid']);

include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_reports_hnf WHERE id = $template_id LIMIT 1");
$template_data = mysqli_fetch_array($result);

?>
          <div class="row">
            <div class="col-8">
              <h2>Edit New Header or Footer</h2>
              <p>Edit available headers and footers</p>
              <hr>
              <form action="system/functions.php" method="post">
              <input type="hidden" class="form-control" id="field_id" name="field_id" required readonly value="<?php echo $template_data['id'];?>">
                <div class="form-group">
                  <label for="field_name">Name</label>
                  <input type="text" class="form-control" id="field_name" name="field_name" placeholder="Name of the header or footer" required value="<?php echo $template_data['name'];?>">
                </div>
                <div class="form-group">
                  <label for="field_content">Content</label>
                  <textarea class="form-control" id="field_content" name="field_content" required="" rows="10" placeholder="Content of the header or footer.">
                    <?php echo $template_data['content'];?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="field_type">Type</label>
                  <select class="form-control" id="field_type" name="field_type" required>
                    <option value="header" <?php echo testSelected('header',$template_data['type']); ?>>header</option>
                    <option value="footer" <?php echo testSelected('footer',$template_data['type']); ?>>footer</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2" name="edit-template">Edit Header/Footer</button>
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
