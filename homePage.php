<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

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
  <h3>Select a date from the 2023 season to find its schedule!</h3>
  <?php
  echo '<form method="GET">
  <label for="date">Select Date:</label>
  <select name="date" id="date">';

$currentDate = date("Y/m/d", strtotime('2023-01-01')); 
$endDate = date("Y/m/d", strtotime('2023-12-31')); 

$date = new DateTime($currentDate);
$end = new DateTime($endDate);
$interval = new DateInterval('P1D');
$dateRange = new DatePeriod($date, $interval, $end);

foreach ($dateRange as $date) {
  echo "<option value=\"" . $date->format("Y/m/d") . "\">" . $date->format("Y/m/d") . "</option>";
}

echo '</select>
  <input type="submit" value="Show Game">
</form>';

    if (isset($_GET['date'])) {
        $selectedDate = $_GET['date'];
  
          $api_url = "http://api.sportradar.us/mlb/trial/v7/en/games/{$selectedDate}/schedule.json?api_key=cm4garusc6vybbj8k635bd24";
          echo "<br>";
         $ch = curl_init($api_url);
         
         curl_setopt($ch, CURLOPT_HTTPGET, true);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response_json = curl_exec($ch);
         curl_close($ch);
         $response=json_decode($response_json, true);
         $data = $response['response']['data'][0];


        if (isset($response['games'])) {
          echo "<h2>Games on {$selectedDate}</h2>";
          echo "<table border='1'>";
          echo "<tr><th>Home Team</th><th>Away Team</th><th>Venue</th><th>Box Score</th><th>Play By Play</th></tr>";
          foreach ($response['games'] as $game) {
              echo "<tr>";
              echo "<td>" . $game['home']['name'] . "</td>";
              echo "<td>" . $game['away']['name'] . "</td>";
              echo "<td>" . $game['venue']['name'] . "</td>";
              echo "<td><a href='boxScore.php?game_id=" . $game['id'] . "'><button>Box Score</button></a></td>";
              echo "<td><a href='pbpTest.php?game_id=" . $game['id'] . "'><button>Play By Play</button></a></td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          echo "<p>No games found for {$selectedDate}</p>";
      }
  }
  ?>
<br>
<br>

<br>
<br>
<br>
  <footer>
    <p>&copy; 2023 MLB Live Updates</p>
  </footer>
</body>
</html>
