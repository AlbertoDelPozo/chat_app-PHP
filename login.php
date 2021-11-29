<?php
//Login 
//Method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {  	
    //we save into a variable the user name and password from the form
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    //query to recover id, user name and role from the database
    $stmt = $pdo->prepare("select id, user_name, role from users where user_name = '$user_name'");
    $stmt->execute();	
    $count = $stmt->rowCount();
    //if we get at least one row we do a fetch and we introduce the data into the sessions
    if($count > 0){	
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //sessions
        $_SESSION['user_name'] = $result['user_name'];
        $_SESSION['id'] = $result['id'];
        $_SESSION['role'] = $result['role'];
        //Query for the password verify
        $stmtPSW = $pdo->prepare("select password from users where user_name = '$user_name'");
        $stmtPSW->execute();
        $count = $stmtPSW->rowCount();
        if($count > 0){
            $result = $stmtPSW->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $result['password'])){
                    //redirection to inbox
                    header("Location: index.php?page=inbox");
                } else {
                    //error
                    echo "There was an error, try again please";
                }
        } else {
            //error
            echo "something went wrong";
        }
    }else{
        //error
        echo "something went wrong";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <div>
        <form method="POST"> 
            <label for="user_name">User: </label>
            <input type="text" name="user_name" placeholder="Enter your user name..."/>
            <br /><br />
            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Enter your password..."/>
            <br /><br />
            <input type="submit" value="Login" name="login"/>
            <br /><br />
            <a href="index.php?page=signup">Signup</a>
            <br /><br />
        </form>
    </div>
</body>
</html>