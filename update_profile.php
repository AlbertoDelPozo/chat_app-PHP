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
</head>

<body>
    <a href="index.php">Logout</a>
    <a href="index.php?page=inbox">Inbox</a>
    <a href="index.php?page=outbox">Outbox</a>
    <a href="index.php?page=profile">Profile</a>

    <h1>Here you can edit your profile:</h1>

    <form action="index.php?page=upload&id=<?=$user_id //we pass the get with a get?>" method="POST" enctype="multipart/form-data">
        <label for="">Select image to upload: </label>
        <br />
        <input type="file" name="fileToUpload" id="fileToUpload" />
        <input type="submit" value="Upload profile" name="submit" />
    </form>
</body>

</html>