
<?php
require('connect.php');

if(!empty($_SESSION["userName"])){
    header("Location: Index.php");
}
if(!empty($_POST['pass'])){

    $username = $_POST['username'];
    $password = $_POST['pass'];
    $email = $_POST['email'];
    $first = $_POST['first'];
    $last = $_POST['last'];

    if(isset($username)){
        $prepData = array(
            "firstN"=>$first,
            "lastN"=>$last,
            "password"=>$password,
            "email"=>$email,
            "username"=>$username
        );
        //print_R($prepData);
        $stmt = $dbh->prepare("INSERT INTO Signin(firstname,
                    lastname,
                    password,
                    email,
                    username)
            VALUES(
                  :firstN,
                  :lastN,
                  :password,
                  :email,
                  :username)");
        $result = $stmt->execute($prepData);
        if($result){
            $_SESSION["password"] = $password;
            $_SESSION["userName"] = $username;
            $_SESSION['registered'] = 1;
            echo "Registered.";
            header("Location: Index.php");
        }else {
            //var_dump($result);
            echo "Error creating account.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Create Acc</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php require_once ("head-div.php") ?>

        <div id="main-contain">
            <div id="login-form">
                <center><form method="post">
                        <br>
                        <label>First name: </label><br><input type="text" name="first" required class="createinput"/><br><br>


                        <label>Last name: </label><br><input type="text" name="last" required class="createinput"/><br><br>

                        <label>Username: </label><br><input type="text" name="username" required class="createinput"/><br><br>

                        <label>Email: </label><br><input type="text" name="email" required class="createinput"/><br><br>

                        <label>Password: </label><br><input type="password" name="pass" required class="createinput"/><br><br>

                        <button type="submit" name="signup" value="1" class="subButon">Sign up</button></form></center>

            </div>
        </div>
    </body>
</html>
