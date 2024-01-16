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

  <?php
$api_key = 'cm4garusc6vybbj8k635bd24'; 

if (isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];

    $api_url = "http://api.sportradar.us/mlb/trial/v7/en/games/{$game_id}/boxscore.json?api_key={$api_key}";

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response_json, true);

    if ($response && isset($response['game']['home']['events']) && isset($response['game']['away']['events'])) {
        $home_events = $response['game']['home']['events'];
        $away_events = $response['game']['away']['events'];

        $home_team_name = $response['game']['home']['name'];
        $away_team_name = $response['game']['away']['name'];

        echo "<h2>Scoring Plays for the $home_team_name</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Hitter Name</th><th>Inning</th><th>Outcome</th></tr>";

        foreach ($home_events as $event) {
            $hitter_first_name = $event['runners'][0]['preferred_name'] ?? '';
            $hitter_last_name = $event['runners'][0]['last_name'] ?? '';
            $hitter_name = "$hitter_first_name $hitter_last_name";
            $inning = $event['inning'] ?? '';
            $outcome = $event['hitter_outcome'] ?? '';

            $outcome = str_replace('a', '', $outcome);
            $outcome = str_replace('o', '', $outcome);
            $outcome = str_replace('S', 'Single', $outcome);
            $outcome = str_replace('D', 'Double', $outcome);
            $outcome = str_replace('T', 'Triple', $outcome);

            echo "<tr>";
            echo "<td>$hitter_name</td>";
            echo "<td>$inning</td>";
            echo "<td>$outcome</td>";
            echo "</tr>";
        }

        echo "</table>";

        echo "<h2>Scoring Plays for the $away_team_name,</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Hitter Name</th><th>Inning</th><th>Outcome</th></tr>";

        foreach ($away_events as $event) {
            $hitter_first_name = $event['runners'][0]['preferred_name'] ?? '';
            $hitter_last_name = $event['runners'][0]['last_name'] ?? '';
            $hitter_name = "$hitter_first_name $hitter_last_name";
            $inning = $event['inning'] ?? '';
            $outcome = $event['hitter_outcome'] ?? '';

            $outcome = str_replace('a', '', $outcome);
            $outcome = str_replace('o', '', $outcome);
            $outcome = str_replace('S', 'Single', $outcome);
            $outcome = str_replace('D', 'Double', $outcome);
            $outcome = str_replace('T', 'Triple', $outcome);



            echo "<tr>";
            echo "<td>$hitter_name</td>";
            echo "<td>$inning</td>";
            echo "<td>$outcome</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No game events available for the provided game ID.";
    }
}
?>
<br>
<br>
<br>
<br>
<footer>
    <p>&copy; 2023 MLB Live Updates</p>
  </footer>
</body>
</html>

