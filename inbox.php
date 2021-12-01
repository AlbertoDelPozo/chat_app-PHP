<?php
/**
 * Inbox
 * We show all the message recived 
 */

$user_name = $_SESSION['user_name']; //Session user name
$user_id = $_SESSION['id'];         //Session user id

$messages = array();
// We do a select to obtain all the messages where the receiver is the user id and we execute it
$stmt = $pdo->prepare("SELECT * FROM  message WHERE receiver = '$user_id' order by date DESC ");
$stmt->execute();	

// If we obtain one row we do a fecth all to show all the messages
$count = $stmt->rowCount();    
    if($count > 0){	
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//We get the id for updating isRead when we click on the message which is not read
if (isset($_GET['id'])) {
    $idM = $_GET['id'];
    $updateRead = $pdo->prepare("UPDATE message  SET isRead ='1' WHERE id = $idM");
    $updateRead->execute();	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Inbox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container" class="d-flex justify-content-center">
        <nav class="navbar fixed-top navbar-dark bg-dark" >
            <a href="index.php?page=home" class="navbar-brand">Send message</a>   
            <a href="logout.php" class="navbar-brand">Logout</a>
            <a href="index.php?page=outbox" class="navbar-brand">Outbox</a>
            <a href="index.php?page=profile" class="navbar-brand">Profile</a>
            <a href="index.php?page=admin_zone" class="navbar-brand">Admin Zone</a>
        </nav>
    </div>
<br><br>
    <div>
        <h1>Your messages:</h1>

        <div>
        <?php foreach ($messages as $message) : //FOREACH TO SHOW ALL THE MESSAGES?>
            <?php
                //We recover the sender to show it on the message
                $sender = $message['sender'];
                $user = $pdo->prepare("SELECT * FROM users WHERE id = '$sender'");
                $user->execute();
                $info_user = $user->fetch(PDO::FETCH_ASSOC);

            ?>
                <a href="index.php?page=isRead&id=<?=$message['id']//to change the isRead?>" >
                    <div style="border: solid 1px black;">
                        <?=$info_user['user_name'] //Print the user name of the sender?>
                        <br />
                        <?=$message['msg'] //Print message?>
                        <br />
                        <?=$message['date'] //Print date?>
                        <br />
                        <?php 
                        //validate if the message is read or not
                        if ($message['isRead'] == 0) {
                            echo "<i class='fas fa-envelope'></i>";
                        }else {
                            echo "<i class='fas fa-envelope-open'></i>";
                        }
                        ?>
                        <img src="<?=$message['img']//Print an image?>" >
                        <br /> <br />
                    </div>
                </a>
            
        
            <?php endforeach; //END FOREACH?>
        </div>
    </div>
</body>
</html>