<?php
//We recover the role of the user to know if the user can access
$role = $_SESSION['role'];
//If the role is 1 you can access the admin zone if not you will be redirected to the inbox
if ($role == 1) {
    //Query to recover all the users from de database
    $user = $pdo->prepare("SELECT * FROM users");
    $user->execute();
    $count = $user->rowCount();
    if ($count > 0) {
        $usersAdmin = $user->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    //Redirection
    header("Location: index.php?page=inbox");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar fixed-top navbar-dark bg-dark d-flex justify-content-center"> 
        <a href="index.php?page=inbox" class="navbar-brand">Inbox</a>
        <a href="index.php?page=outbox" class="navbar-brand">Outbox</a>
        <a href="index.php?page=profile" class="navbar-brand">Profile</a>
        <a href="index.php" class="navbar-brand">Logout</a>
    </nav>

    <br><br><br>
    <h1>Admin zone:</h1>

    <div>
        <?php foreach ($usersAdmin as $userAdmin) : //FOREACH?>

                <a href="" >
                    <div style="border: solid 1px black;">
                        <?=$userAdmin['user_name'] //Print user name?>
                        <br />
                        <?=$userAdmin['email'] //Print email?>
                        
                        <a href="index.php?page=admin_functions&id=<?=$userAdmin['id'] //we send through a get the id to change the role?>">Make admin</a>
                    </div>
                </a>
            
        
            <?php endforeach; //ENDFOREACH?>
        </div>
</body>
</html>