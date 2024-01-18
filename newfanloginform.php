<?php
session_start();


$username = $_SESSION['username'];
$favoriteTeam = $_SESSION['favoriteTeam'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MLB Live Updates</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="homePageLayout.css">
  <style>
    body {
      font-size: 16px; 
      margin: 0;
      padding: 0;
    }

    header {
      text-align: center;
      padding: 10px;
      background-color: blue;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
    }

    nav ul li {
      display: inline;
      margin-right: 10px;
    }

    form {
      text-align: center;
      padding: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: ;
    }
  </style>
</head>
<body>
  <header>
    <h1>Major League Baseball Live Updates</h1>
    <h4>Welcome, <?php echo $username; ?>!</h4>
    <h4> Favorite Team: <?php echo $favoriteTeam; ?></h4>
    <nav>
      <ul>
        <li><a href="homePage.php">Home</a></li>
        <li><a href="teamProfile.php">Teams</a></li>
        <li><a href="standings.php">Standings</a></li>
        <li><a href="login.php">Login to MLB</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

<body>
    <h2>Fan Login</h2>
    <form action="newfanloginprocess.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>

        <button type="button" onclick="location.href='signup.html';">Sign Up</button>
    </form>
</body>
<footer>
    <p>&copy; 2023 MLB Live Updates</p>
  </footer>
</body>
</html>

</html>
