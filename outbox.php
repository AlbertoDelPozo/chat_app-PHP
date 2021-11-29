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
</head>
<body>
    <a href="index.php?page=home">Send message</a>   
    <a href="logout.php">Logout</a>
    <a href="index.php?page=inbox">Inbox</a>
    <a href="index.php?page=profile">Profile</a>
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