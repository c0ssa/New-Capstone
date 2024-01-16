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

  <table>
    <thead>
      <tr>
        <th>Team</th>
        <th>Abbreviation</th>
        <th>City</th>
        <th>Venue</th>
        <th>Capacity</th>

      </tr>
    </thead>
    <tbody>
      <?php
        // Replace 'YOUR_API_KEY' with your actual Sportradar API key
        $api_key = 'cm4garusc6vybbj8k635bd24';

        // API endpoint URL for fetching team hierarchy data
        $team_hierarchy_api_url = "http://api.sportradar.us/mlb/trial/v7/en/league/hierarchy.json?api_key=$api_key";

        // Fetch team hierarchy data from the Sportradar API
        $ch = curl_init($team_hierarchy_api_url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $team_hierarchy_response_json = curl_exec($ch);
        curl_close($ch);

        $team_hierarchy= json_decode($team_hierarchy_response_json, true);

        if (isset($team_hierarchy['leagues'])) {
            foreach ($team_hierarchy['leagues'] as $league) {
              if (isset($league['divisions'])) {
                foreach ($league['divisions'] as $division) {
                  if (isset($division['teams'])) {
                    foreach ($division['teams'] as $team) {
                      echo "<tr>";
                      echo "<td>{$team['name']}</td>";
                      echo "<td>{$team['abbr']}</td>";
                      echo "<td>{$team['market']}</td>";
                      echo "<td>{$team['venue']['name']}</td>";
                      echo "<td>{$team['venue']['capacity']}</td>";
                      echo "</tr>";
                    }
                  }
                }
              }
            }
          }
        ?>
      </tbody>
    </table>
  </body>
  <br>
  <br>
  <br>
  <br>
  <footer>
    <p>&copy; 2023 MLB Live Updates</p>
  </footer>
</body>
</html>

  </html>

