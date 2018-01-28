<?php
include($_SERVER['DOCUMENT_ROOT']."/ecj1718/conn.php");
$result = mysqli_query($conn,"SELECT * FROM system_fields ORDER BY code, id ASC");
?>
        <h2>Available Fields</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Placeholders</th>
                  <th>Type</th>
                  <th>Value</th>
                  <th>Allowed Characters</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $i = 0; 
              while($row = mysqli_fetch_array($result)){
                $i++;
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['code'] . "</td>";
                echo "<td>" . $row['placeholder'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['field_value'] . "</td>";
                echo "<td>" . $row['valid_char'] . "</td>";
                echo "</tr>";
              }
              mysqli_close($conn);

              ?>
              </tbody>
            </table>
          </div>