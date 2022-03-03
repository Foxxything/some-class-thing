<?php
  $groups = array();
  require_once('./config.php');
  $sql = "SELECT clip_name FROM groups";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($groups, $row["clip_name"]);
    }
  } else {
    echo "0 results";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Values</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
  <div style="margin-top: 10px;" class="container">
    <div class='card'>
      <div class='card-header'>
        <h3>List Group Members</h3>
      </div>
      <div class='card-body'>
        <form action="edit.php" method="post">
          <div class="form-group">
            <label for="clip_name">Show clip name</label>
            <select class="form-control" id="clip_name" name="clip_name">
              <option>Select a clip</option>
              <?php
                foreach ($groups as $group) {
                  echo "<option>" . $group . "</option>";
                }
              ?>
            </select>
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
            <textarea style='margin-top: 5px;' name='notes' id='notes' cols='60' rows='7' placeholder='Notes'></textarea>
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

<script>
  var clip_name = document.getElementById('clip_name');
  var member1 = document.getElementById('member1');
  var member2 = document.getElementById('member2');
  var member3 = document.getElementById('member3');
  var member4 = document.getElementById('member4');
  var member5 = document.getElementById('member5');
  var notes = document.getElementById('notes');

  clip_name.addEventListener('change', async () => {
    if (clip_name.value == 'Select a clip') return;
    const select_box = escape(clip_name.value);
    try {
      const url = `api.php?clip_name=${select_box}`;
      const response = await fetch(url);
      const data = await response.json();
      member1.value = String(data.members[0]);
      member2.value = String(data.members[1]);
      member3.value = String(data.members[2]);
      member4.value = String(data.members[3]);
      member5.value = String(data.members[4]);
      notes.value = String(data.notes);
    } catch (error) {
      console.error(`Error polling API: ${error}`);
    }
  });
</script>
</html>

<?php
  if(isset($_POST['clip_name'])) {
    $clip_name = $_POST['clip_name'];
    $member1 = $_POST['member1'];
    $member2 = $_POST['member2'];
    $member3 = $_POST['member3'];
    $member4 = $_POST['member4'];
    $member5 = $_POST['member5'];
    $notes = $_POST['notes'];

    $sql = "UPDATE groups SET member1='$member1', member2='$member2', member3='$member3', member4='$member4', member5='$member5', notes='$notes' WHERE clip_name='$clip_name'";
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }
?>