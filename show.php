<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Groups</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <style>
    body {
      width: 70%;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div style="margin-top: 10px;" class="container">
    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">Clip Name</th>
          <th scope="col">First Member</th>
          <th scope="col">Second Member</th>
          <th scope="col">Third Member</th>
          <th scope="col">Fourth Member</th>
          <th scope="col">Fifth Member</th>
          <th scope="col">Notes</th>
        </tr>
      </thead>
      <tbody>
        <?php
          require_once('./config.php');
          $sql = "SELECT * FROM groups";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["clip_name"] . "</td>";
              echo "<td>" . $row["member1"] . "</td>";
              echo "<td>" . $row["member2"] . "</td>";
              echo "<td>" . $row["member3"] . "</td>";
              echo "<td>" . $row["member4"] . "</td>";
              echo "<td>" . $row["member5"] . "</td>";
              echo "<td>" . $row["notes"] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "0 results";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>