<?php 
//we store into variables the session information
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];
//query to select all the information from the database by the id
$stmt = $pdo->prepare("SELECT * FROM  users WHERE id = '$user_id'");
    $stmt->execute();	
    $count = $stmt->rowCount();
    if($count > 0){	
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <a href="index.php">Logout</a>
    <a href="index.php?page=inbox">Inbox</a>
    <a href="index.php?page=outbox">Outbox</a>
    <a href="index.php?page=update_profile">Edit profile</a>

    <h1>Profile: </h1>

    <p><?= $user_name //print user name?></p>
    <p><?= $user['email'] //print the email?></p>
    <img src="<?= $user['img'] //print img?>">
</body>
</html>