<?php
//Signup
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //we store into variables with post user name, email and password
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   
    //verify if the users exists
    $query = ("SELECT id, user_name FROM users WHERE user_name = '$user_name'");
    $stmtID = $pdo->prepare($query);
    $stmtID->execute();
    $count = $stmtID->rowCount();
    if ($count > 0) {
        echo 'The email address is already registered';
        header("Location: index.php");
    }
    //insert new user
    $ins = "INSERT INTO users (user_name, email, password, date) VALUES ('$user_name','$email','$password','')";
    $stmt = $pdo->prepare($ins);
    $stmt->execute();

    $count = $stmt->rowCount();
    if ($count > 0) {
        //redirection to login
        header("Location: index.php?page=login");
    } else {
        //error
        echo "There was an error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
<div>
        <form method="POST"> 
            <label for="user_name">User: </label>
            <input type="text" name="user_name" placeholder="Enter your user name..."/>
            <br /><br />
            <label for="email">Email: </label>
            <input type="email" name="email" placeholder="Enter your email..." />
            <br /><br />
            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Enter your password..."/>
            <br /><br />
            <input type="submit" value="Signup" name='register'/>
            <br /><br />
            <a href="index.php?page=login">Login</a>
            <br /><br />
        </form>
    </div>
</body>
</html>