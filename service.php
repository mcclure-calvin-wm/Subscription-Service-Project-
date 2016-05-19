
<?php
require('connect.php');

if(!empty($_SESSION["userName"])){
    header("Location: service.php");
}
if(!empty($_POST['pass'])){

    $sunglassname = $_POST['sunglassname'];
    $price = $_POST['price'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($username)){
        $prepData = array(
            "firstN"=>$first,
            "price"=>$price,
            "username"=>$username,
            "password"=>$password,
            "email"=>$email
        );
        //print_R($prepData);
        $stmt = $dbh->prepare("INSERT INTO service(sunglassname,
                    price,
                    username,
                    password,
                    email)
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



// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=visual', 'root', 'root');
// Retrieve the score data from MySQL
$query = "SELECT * FROM service ";
$stmt= $dbh->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();
// Loop through the array of score data, formatting it as HTML
echo '<table>';
foreach ($result as $row) {
    // Display the score data
    echo '<tr><td><strong>' . $row['movieName'] . '</strong></td>';
    echo '<td>' . $row['moviePic'] . '</td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td><a href="removeMovie.php?idmovies=' . $row['idmovies'] .
        '&amp;movieName=' . $row['movieName'] . '&amp;description=' . $row['description'] .
        '&amp;moviePic=' . $row['moviePic'] . '">Remove</a></td>';

    if( $row['approve'] == '0'){
        echo '<td> / <a href="approveMovie.php?idmovies='. $row['idmovies'] .
            '&amp;movieName='. $row['movieName']. '&amp;description='. $row['description'] . '&amp;moviePic=' .
            $row['moviePic'] . '">Approve</a></td></tr>';
    }
}

echo '</table>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Acc</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
    <!--fonts-->
    <link href='https://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Fira+Sans:700italic,400' rel='stylesheet' type='text/css'>
</head>
<body>
<?php require_once ("head-div.php") ?>

<div id="main-contain">
    <div id="buy">
        <center><form method="post">
                <br>
                <label>sunglass name: </label><br><input type="text" name="first" required class="createinput"/><br><br>


                <label>price want to pay: </label><br><input type="text" name="last" required class="createinput"/><br><br>

                <label>Username: </label><br><input type="text" name="username" required class="createinput"/><br><br>

                <label>Email: </label><br><input type="text" name="email" required class="createinput"/><br><br>

                <label>Password: </label><br><input type="password" name="pass" required class="createinput"/><br><br>

                <button type="submit" name="buy" value="1" class="subButon">BUY</button></form></center>
    </div>
</div>

<div id="main-contain">
    <div id="center-table">
        <table cellspacing="130" style="border-left: 1px;">
            <tr>
                <?php


                if (count($cartContents) > 0) {
                    foreach ($cartContents as $product) {
                        $cartname = $product['name'];
                        $cartpic = $product['pic-file'];
                        $cartprice = $product['price'];
                        $productid = $product['id'];

                        echo "<tr>
                                                    <td id='td-cart'>$productid</td>
                                                    <td id='name-cart'>$cartname</td>
                                                    <td><img src=" . $cartpic . " class='cart-pics'>
                                                    </td><td>$cartprice</td>
                                                    <form method='post' action=''>
                                                        <input type='hidden' name='productID' value='$productid'/>
                                                        <td><button type='submit' name='removeFromCart' id='removeFromCart' value='1'>X</button></td>
                                                    </form>
                                                </tr>";
                    }
                }


                ?>
            </tr>
        </table>
    </div>
</body>
</html>
