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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar fixed-top navbar-dark bg-dark d-flex justify-content-center"> 
        <a href="index.php?page=inbox" class="navbar-brand">Inbox</a>
        <a href="index.php?page=outbox" class="navbar-brand">Outbox</a>
        <a href="index.php?page=update_profile" class="navbar-brand">Edit profile</a>
        <a href="index.php" class="navbar-brand">Logout</a>
    </nav>

    <h1>Profile: </h1>

    <p><?= $user_name //print user name?></p>
    <p><?= $user['email'] //print the email?></p>
    <img src="<?= $user['img'] //print img?>">
</body>
</html>