<?php
$host = "localhost"; 
$username = "root"; 
$database = "capstone";

$conn = mysqli_connect($host, $username, '', $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $favoriteTeam = $_POST['favoriteTeam'];

    $sql = "INSERT INTO fan (username, password, favoriteTeam) VALUES ('$username', '$password', '$favoriteTeam')";

    if (mysqli_query($conn, $sql)) {
        header("Location: homePage.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
