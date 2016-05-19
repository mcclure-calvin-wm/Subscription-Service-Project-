<?php
require_once('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php

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
​
</body>
</html>