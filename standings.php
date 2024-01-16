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

  <h2>Standings (Divisions reset after 5 teams)</h2>
  <h4>Order: NL West, NL Central, NL East, AL East, AL Central, AL West</h4>
        <table>
            <tr>
                
                <th>City</th>
                <th>Name</th>
                <th>Wins</th>
                <th>Losses</th>
                <th>Games Back</th>
                <th>Divisional Rank</th>
            </tr>
            <?php
            $jsonData = file_get_contents('teams.json');
            $teamsData = json_decode($jsonData, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($teamsData['teams'])) {
                $teams = $teamsData['teams'];

                foreach ($teams as $team) {
                    if (isset($team['id'], $team['name'], $team['market'], $team['win'], $team['loss'], $team['games_back'], $team['rank']['division'])) {
                        $name = $team['name'];
                        $city = $team['market'];
                        $wins = $team['win'];
                        $losses = $team['loss'];
                        $games_back = $team['games_back'];
                        $divisionrank = $team['rank']['division'];
                        

                        // Output team data in table rows
                                echo "<tr>
                                <td>$city</td>
                                <td>$name</td>
                                <td>$wins</td>
                                <td>$losses</td>
                                <td>$games_back Games Back</td>
                                <td>$divisionrank</td>
                            </tr>";
                    } else {
                        echo "<tr><td colspan='5'>Error: Invalid team data format.</td></tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='5'>Error: Unable to decode JSON or missing 'teams' data.</td></tr>";
            }
            ?>
        </table>
    </main>
<br>
<br>
<br>
    <footer>
        <p>&copy; 2023 MLB Live Updates</p>
    </footer>
</body>
</html>



