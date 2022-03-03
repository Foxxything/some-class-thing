<?php
  require_once('./config.php');
  if(isset($_GET['clip_name'])) {
    // fetch members
    $clip_name = $conn -> real_escape_string($_GET['clip_name']);
    $stmt = $conn->prepare("SELECT member1, member2, member3, member4, member5, notes FROM groups WHERE clip_name = ?");
    $stmt->bind_param("s", $clip_name);
    $stmt->execute();
    $rows = $stmt->get_result();
    $row = $rows->fetch_assoc();
    $member1 = $row['member1'];
    $member2 = $row['member2'];
    $member3 = $row['member3'];
    $member4 = $row['member4'];
    $member5 = $row['member5'];
    $notes = $row['notes'];

    $values = [
      'members' => [
        $member1,
        $member2,
        $member3,
        $member4,
        $member5
      ],'notes' => $notes
    ];
    $json = json_encode($values);
    echo $json;
  }
?>
