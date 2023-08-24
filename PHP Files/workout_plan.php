<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Client's Workout Plan"/>
    <meta name="author" content="Author name"/>
    <title>Client's Workout Plan</title>
    
    <!-- Add your CSS and JS links here -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .title {
            text-align: center;
            padding: 20px 0;
            color: #333;
        }
        .workout-plan {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        .workout-plan:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .exercise-row {
            margin-bottom: 10px;
        }
        .exercise-label {
            font-weight: bold;
            width: 140px;
            display: inline-block;
        }
    </style>
</head>
<body> 
    <section id="section1">
        <div class="container">
            <h1 class="title">Client's Workout Plan</h1>
            <div class="workout-plan">
                <?php
                require_once("DBconnect.php");
                session_start();

                if (isset($_SESSION["email"])) {
                    $clientEmail = $_SESSION["email"];
        
                    $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
                    $userIDResult = $conn->query($getUserIDQuery);
        
                    if ($userIDResult->num_rows > 0) {
                        $row = $userIDResult->fetch_assoc();
                        $client_id = $row["client_id"];
                    }
                }
                
                // Query to fetch client's workout_id
                $sql_client = "SELECT workout_id FROM client WHERE client_id = $client_id";
                $result_client = mysqli_query($conn, $sql_client);
                
                if (mysqli_num_rows($result_client) > 0) {
                    $row_client = mysqli_fetch_assoc($result_client);
                    $workout_id = $row_client['workout_id']; // Get the workout_id
                    
                    // Query to fetch exercises based on workout_id
                    $sql_exercises = "SELECT * FROM exercise WHERE workout_id = $workout_id";
                    $result_exercises = mysqli_query($conn, $sql_exercises);
                    
                    if (mysqli_num_rows($result_exercises) > 0) {
                        while ($row_exercise = mysqli_fetch_assoc($result_exercises)) {
                            // Display exercise details here
                            ?>
                            <div class="exercise-row">
                                <span class="exercise-label">Exercise Name:</span> <?php echo $row_exercise['Exersice_name']; ?>
                            </div>
                            <div class="exercise-row">
                                <span class="exercise-label">Sets:</span> <?php echo $row_exercise['Sets']; ?>
                            </div>
                            <div class="exercise-row">
                                <span class="exercise-label">Reps:</span> <?php echo $row_exercise['Reps']; ?>
                            </div>
                            <hr>
                            <?php
                        }
                    } else {
                        echo "<p>No exercises available for this workout plan.</p>";
                    }
                } else {
                    echo "<p>Client not found.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
