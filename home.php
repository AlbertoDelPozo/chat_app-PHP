<?php
//we include the functions.php for the upload file
include 'functions.php';
//we introduce into a variable the session user name and the id
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];

//We do the POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //we introduce into a variable the post user name
    $sendToUser = $_POST['user_name'];
    //query for selecting the id from the user name
    $query = "SELECT id FROM users where user_name = '$sendToUser'";
    $resul = $pdo->query($query);
    $sendToId = $resul->fetch(PDO::FETCH_ASSOC);
    //we recover the id of the receiver of the message
    $receiver = $sendToId['id'];
    //we save into msg the text of the message
    $msg = $_POST['message'];
    //we format the date
    $date = date('Y-m-d H:i:s');
    //we get the route where we are going to save de image
    $img = upload_file(false);
    //query to insert all the information into the database
    $stmt = "INSERT INTO message (sender, receiver, msg, date, img) VALUES ('$user_id', '$receiver', '$msg', '$date', '$img')";
    $message = $pdo->prepare($stmt);
    $message->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chattting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar fixed-top navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">Logout</a>
        <a href="index.php?page=inbox" class="navbar-brand">Inbox</a>
        <a href="index.php?page=outbox" class="navbar-brand">Outbox</a>
        <a href="index.php?page=profile" class="navbar-brand">Profile</a>
    </nav>

    <h1>Chat area:</h1>
    <br />

    <div>
        <form method="post" enctype="multipart/form-data">
            <label for="contact">Send message to: </label>
            <br />
            <input type="text" id="contact" placeholder="Type here the contact..." name="user_name" required />
            <br /><br />
            <label for="message">Message: </label>
            <br />
            <input type="text" id="message" placeholder="Type your message here..." name="message" required />
            <br /><br />
            <label for="">Select image to upload: </label>
            <br />
            <input type="file" name="fileToUpload" id="fileToUpload" />
            <button type="submit" value="Send">Send</button>
        </form>
    </div>

</body>

</html>