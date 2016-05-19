

<?php

require("connect.php");
if(isset($_SESSION['password'])){
    header("Location: index.php");
}



if(isset($_POST['pass'])) {
    $username = $_POST['userName'];
    $password = $_POST['pass'];

    $prepData = array(
        "password" => $password,
        "username" => $username
    );
    $stmt = $dbh->prepare("SELECT username, password FROM Signin WHERE username=:username AND password=:password;");
    $stmt->execute($prepData);
    $results = $stmt->fetchAll();
    if(count($results) == 1){
        if(isset($_SESSION['password'])) {
            unset($_SESSION['password']);
            unset($_SESSION['userName']);
        }
        $_SESSION["password"] = $password;
        $_SESSION["userName"] = $username;
        $_SESSION['registered'] = 1;
        echo "Registered.";
        echo $username;
        echo $password;
        header("Location: index.php");
    }else {
        var_dump($result);
        echo "Error... Reloading...";
        echo '<script>window.location.assign("signin.php")</script>';
    }
}

?>

<!DOCTYPE html>
    <html>
        <head>
            <link href="stylesheet.css" rel="stylesheet" type="text/css">
        </head>
        <body>
        <?php require_once ("head-div.php") ?>
        <div id="main-contain">

        <div id="Signin">
            <form method="post">
                <h5 style="font-family: 'Fira Sans', sans-serif; font-size: 3em; margin-top: 0; margin-bottom: 0;">sign in</h5>
                <p>Email</p>
                <input type="text">
                <p>Password</p>
                <input type="password">
                <br>
                <button style="margin-top: 1em;" type="submit" name="submit" id="submitbutton" value="1" class="subButon">Sign in</button>
            </form>
            <div id="signs" style="margin-top: 1em;">

                <a href="createAccount.php" style="color: #0043A8; text-decoration: underline;">Don't have account?</a>

            </div>
        </div>


        </body>
    </html>