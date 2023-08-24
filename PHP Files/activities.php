<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fitness Tracking Website</title>
  <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }
      header {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 1rem;
      }
      section {
        padding: 2rem;
        border-bottom: 1px solid #ccc;
      }
      footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 1rem;
        position: absolute;
        bottom: 0;
        width: 100%;
      }
  </style>
</head>
<body>
  <header>
    <h1>Fitness Tracking Website</h1>
  </header>
  
  <section class="client-section">
    <?php
    
      $host = "localhost";
      $username = "root";
      $password = "";
      $database = "fitness_tracking_database";

      $connection = mysqli_connect($host, $username, $password, $database);

      if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
      }

      session_start();

      if (isset($_SESSION["email"])) {
          $clientEmail = $_SESSION["email"];

          $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
          $userIDResult = $connection->query($getUserIDQuery);

          if ($userIDResult->num_rows > 0) {
              $row = $userIDResult->fetch_assoc();
              $clientID = $row["client_id"];
          }
      }

      $activityQuery = "SELECT * FROM activity WHERE Client_id = $clientID";
      $activityResult = mysqli_query($connection, $activityQuery);

      if ($activityResult && mysqli_num_rows($activityResult) > 0) {
        while ($activityData = mysqli_fetch_assoc($activityResult)) {
          echo "<h3>" . $activityData['Activity_type'] . "</h3>";

          $activityID = $activityData['Activity_id'];
          $trackingTechQuery = "SELECT * FROM tracking_tech WHERE Activity_id = $activityID";
          $trackingTechResult = mysqli_query($connection, $trackingTechQuery);

          if ($trackingTechResult && mysqli_num_rows($trackingTechResult) > 0) {
            $trackingTechData = mysqli_fetch_assoc($trackingTechResult);
            echo "<p>Tech ID: " . $trackingTechData['Tech_id'] . "</p>";
            echo "<p>Tech Name: " . $trackingTechData['Tech_name'] . "</p>";

            $techID = $trackingTechData['Tech_id'];
            $metricQuery = "SELECT * FROM matric WHERE tech_id = $techID";
            $metricResult = mysqli_query($connection, $metricQuery);

            if ($metricResult && mysqli_num_rows($metricResult) > 0) {
              $metricData = mysqli_fetch_assoc($metricResult);
              echo "<p>Duration: " . $metricData['duration'] . "</p>";
              echo "<p>Distance: " . $metricData['distance'] . "</p>";
              echo "<p>Speed: " . $metricData['speed'] . "</p>";
            } else {
              echo "<p>Metric information not found.</p>";
            }
          } else {
            echo "<p>Tracking technology details not found.</p>";
          }
        }
      } else {
        echo "<p>No activity details found for this client.</p>";
      }

      mysqli_close($connection);
    ?>
  </section>
  
  <footer>
    <p>&copy; 2023 Fitness Tracking Website</p>
  </footer>
</body>
</html>

