<?php
//saving into the a variable the session id which we will pass it through a get
$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Making changes on your profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar fixed-top navbar-dark bg-dark d-flex justify-content-center"> 
        <a href="index.php?page=inbox" class="navbar-brand">Inbox</a>
        <a href="index.php?page=outbox" class="navbar-brand">Outbox</a>
        <a href="index.php?page=profile" class="navbar-brand">Profile</a>
        <a href="index.php" class="navbar-brand">Logout</a>
    </nav>      
    <h1>Here you can edit your profile:</h1>

    <form action="index.php?page=upload&id=<?=$user_id //we pass the get with a get?>" method="POST" enctype="multipart/form-data">
        <label for="">Select image to upload: </label>
        <br />
        <div class="input-group mb-3">
        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
        <input class="btn btn-primary" type="submit" value="Upload profile" name="submit" />
        </div>
    </form>
</body>

</html>