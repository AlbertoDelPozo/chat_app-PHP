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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div>
        <form method="POST" class="px-4 py-3"> 
            <div class="mb-3">
                <label for="user_name" class="form-label">User: </label>
                <input type="text" name="user_name" class="form-control" placeholder="Enter your user name..."/>
            </div>
            <div class="mb-3">
                <label for="email"  class="form-label">Email: </label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email..." />
            </div>
            <div class="mb-3">
                <label for="password"  class="form-label">Password: </label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password..."/>
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>
    <div class="px-4 py-3">
        <a href="index.php?page=login" class="btn btn-outline-dark">Login</a>
    </div>
</body>
</html>