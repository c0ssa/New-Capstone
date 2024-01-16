<?php
$host = "localhost"; 
$username = "root"; 
$database = "capstone"; 

$conn = mysqli_connect($host, $username, '', $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM fan WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['favoriteTeam'] = $row['favoriteTeam'];
        header("Location: homePage.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password.";
    }
}

mysqli_close($conn);

    if (!empty($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
        echo "<button onclick='history.back()'>Try Again</button>";
    }
    ?>
</body>
</html>
