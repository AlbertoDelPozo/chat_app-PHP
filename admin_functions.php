<?php
//If get is set we change the role if not you will be redirected to home
if (isset($_GET['id']))  {
    //we introduce the get into a variable
    $user_id = $_GET['id'];
    //Query to recover all the information from the user 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id  = $user_id");
    $stmt->execute();
    $changeRole = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count > 0) {
        //If the role is 0 we update it to 1, we make the user admin if not we don't make him admin
        if ($changeRole['role'] == 0) {
            //Query to update the role
            $sql = "UPDATE users SET role = 1 WHERE id  = '$user_id'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        } else {
            //Query to update the role
            $sql = "UPDATE users SET role = 0 WHERE id  = '$user_id'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        }
        //redirection lo the admin zone
        header('location: index.php?page=admin_zone');
    } else {
        //redirection to home
        header('location: index.php?page=home');
    }
 }
?>
