<?php
// include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");


// $result = mysqli_query($conn, "SHOW COLUMNS FROM usr_std_health");
// if (!$result) {
//     echo 'Could not run query: ' . mysqli_error();
//     exit;
// }
// if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         echo $row['Field']. '<br>';
//     }
// }


	// $form_data = array(
	// 	'name' => 'test_name',
	// 	'code' => 'test_code',
	// 	'placeholder' => 'test_placeholder'
	// );

	// print_r($form_data);



?>


          <div class="row">
            <div class="col-8">
              <h2>Create Entity</h2>
              <form action="test_action.php" method="post">
              <div class="form-group">
                <label for="entity_name">Height</label>
                <input type="text" class="form-control" id="std_sh_height" name="std_sh_height" placeholder="">
              </div>
              <div class="form-group">
                <label for="entity_code">Weight</label>
                <input type="text" class="form-control" id="std_sh_weight" name="std_sh_weight" placeholder="">
              </div>
              <div class="form-group">
                <label for="entity_desc">BP</label>
                <input type="text" class="form-control" id="std_sh_bp" name="std_sh_bp" placeholder="">
              </div>
              <button type="submit" class="btn btn-primary mb-2" name="create_entity">Create Entity</button>
              </form>
            </div>
            
            <div class="col-4">
            <h4>Tip</h4>
            <p>Fields should be created first before you can add them to a form.</p>
            </div>
          </div>