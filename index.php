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
  <title>Group Set Up</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <style>
    body {
      width: 70%;
      margin: 0 auto;
    }
    textarea {
      resize: none;
    }
  </style>
</head>
<body>
  <div style="margin-top: 10px;" class="container">
    <div class='card'>
      <div class='card-header'>
        <h3>List Group Members</h3>
      </div>
      <div class='card-body'>
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="clip_name">Show clip name</label>
            <input type='text' name='clip_name' class="form-control" id="clip_name" placeholder="Enter clip name">
            <div class="row">
              <div class="col-md-6">
                <div style='margin-top: 5px'></div>
                <input type='text' class='form-control' name='member1' id='member1' placeholder='Member 1' required>
                <div style='margin-top: 5px'></div>
                <input type='text' class="form-control" name='member2' id='member2' placeholder='Member 2'>
                <div style='margin-top: 5px'></div>
                <input type='text' class="form-control" name='member3' id='member3' placeholder='Member 3'>
                <div style='margin-top: 5px'></div>
                <input type='text' class="form-control" name='member4' id='member4' placeholder='Member 4'>
                <div style='margin-top: 5px'></div>
                <input type='text' class="form-control" name='member5' id='member5' placeholder='Member 5'>
              </div>
              <div class="col-md-6">
                <textarea style='margin-top: 5px; width: 100%;' name='notes' id='notes' cols='60' rows='8' placeholder='Notes'></textarea>
              </div>
            </div>

          </div>
          <div style="margin-top: 5px;"></div>
          <div class='row'>
            <div class='col-md-12'>
              <button type='submit' class='btn btn-primary'>Submit</button>
            </div>
          </div>
        </form>
      </div>  
    </div>
  </div>  
</body>
</html>

<script>
  // event listener for ctrl+shift
  document.addEventListener('keydown', function(e) {
    if (e.keyCode == 16 && e.ctrlKey) {
      // alert('ctrl+shift');
      window.location.href = "show.php";
    }
  });

  // event listener for edit button
  document.getElementById('edit').addEventListener('click', function() {
    window.location.href = "edit.php";
  });
</script>

<?php
  if (isset($_POST['clip_name'])) {
    require_once('./config.php');
    // escape variables for security
    $clip_name = $conn -> real_escape_string($_POST['clip_name']);
    $member1 = $conn -> real_escape_string($_POST['member1']);
    $member2 = $conn -> real_escape_string($_POST['member2']);
    $member3 = $conn -> real_escape_string($_POST['member3']);
    $member4 = $conn -> real_escape_string($_POST['member4']);
    $member5 = $conn -> real_escape_string($_POST['member5']);
    $notes = $conn -> real_escape_string($_POST['notes']);

    $stmt = $conn->prepare("INSERT INTO groups (clip_name, member1, member2, member3, member4, member5, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $clip_name, $member1, $member2, $member3, $member4, $member5, $notes);
    if ($stmt->execute()) {
      // echo "New record created successfully";
      header("Location: worked.html");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }