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
    $company = $_POST['company'];

    $sql = "INSERT INTO workers (username, password, company) VALUES ('$username', '$password', '$company')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
