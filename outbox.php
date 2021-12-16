<?php 
//we store into variables the session information
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];
$messages = array();
//query to select all the messages sended by the user logged
$stmt = $pdo->prepare("SELECT * FROM  message WHERE sender = '$user_id' order by date DESC ");
$stmt->execute();	
$count = $stmt->rowCount();
   if($count > 0){	
       $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outbox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar fixed-top navbar-dark bg-dark d-flex justify-content-center">    
        <a href="index.php?page=home" class="navbar-brand">Send message</a>   
        <a href="index.php?page=inbox" class="navbar-brand">Inbox</a>
        <a href="index.php?page=profile" class="navbar-brand">Profile</a>
        <a href="logout.php" class="navbar-brand">Logout</a>
    </nav>
    <div>
        <h1>Your messages sended:</h1>

        <div>
        <?php foreach ($messages as $message) : //FOREACH?>
            <?php
                //variable to store the receiver and show it later
                $receiver = $message['receiver'];
                $user = $pdo->prepare("SELECT * FROM users WHERE id = '$receiver'");
                $user->execute();
                $info_user = $user->fetch(PDO::FETCH_ASSOC);

            ?>
            <div>
                <p>
                    <?=$info_user['user_name'] //print receiver?>
                    <br />
                    <?=$message['msg'] //print the message?>
                    <br />
                    <?=$message['date'] //print the date?>
                    <br />
                    <img src="<?=$message['img']?>" >
                </p>

            </div>
        
            <?php endforeach; //ENDFOREACH?>
        </div>
    </div>
</body>
</html>