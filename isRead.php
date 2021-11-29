<?php
//If the get is set we update isRead
if (isset($_GET['id'])) {
    //we introduce into the variable the get id
    $idM = $_GET['id'];
    //Query
    $updateRead = $pdo->prepare("UPDATE message  SET isRead ='1' WHERE id = $idM");
    $updateRead->execute();	
    //redirection to inbox
    header("Location: index.php?page=inbox");
}
?>