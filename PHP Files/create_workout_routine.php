<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Create Workout Routine"/>
    <meta name="author" content="Author name"/>
    <title>Create Workout Routine</title>
    
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
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn-submit {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body> 
    <section id="section1">
        <div class="container">
            <h1 class="title">Create Workout Routine</h1>
            <?php
            require_once("DBconnect.php");
            $trainer_id = 1; // Default trainer ID for now
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get client ID from form
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
                
                // Insert workout routine into the workout_routine table
                $insertSql = "INSERT INTO workout_routine (client_id, trainer_id) VALUES ('$client_id', '$trainer_id')";
                if ($conn->query($insertSql) === TRUE) {
                    $workout_id = $conn->insert_id; // Get the auto-generated workout_id
                    
                    // Insert exercises
                    $exercises = $_POST['exercises'];
                    foreach ($exercises as $exercise) {
                        $insertExerciseSql = "INSERT INTO exercise (workout_id, Exersice_name, Sets, Reps) VALUES ('$workout_id', '$exercise[Exersice_name]', '$exercise[Sets]', '$exercise[Reps]')";
                        $conn->query($insertExerciseSql);
                    }
                    
                    echo "<p>Workout routine created successfully.</p>";
                } else {
                    echo "Error creating workout routine: " . $conn->error;
                }
            }
            ?>
            <form method="POST" action="create_workout_routine.php">
                <div class="form-group">
                    <label class="form-label">Client ID:</label>
                    <input type="text" name="client_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Exercises:</label>
                    <button type="button" class="btn btn-secondary" id="addExercise">Add Exercise</button>
                    <div id="exerciseList">
                        <div class="exercise-row">
                            <input type="text" name="exercises[0][Exersice_name]" placeholder="Exercise Name" class="form-control" required>
                            <input type="text" name="exercises[0][Sets]" placeholder="Sets" class="form-control" required>
                            <input type="text" name="exercises[0][Reps]" placeholder="Reps" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Create Workout Routine</button>
            </form>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // Add new exercise row
        $('#addExercise').click(function () {
            $('#exerciseList').append(`
                <div class="exercise-row">
                    <input type="text" name="exercises[][Exersice_name]" placeholder="Exercise Name" class="form-control" required>
                    <input type="text" name="exercises[][Sets]" placeholder="Sets" class="form-control" required>
                    <input type="text" name="exercises[][Reps]" placeholder="Reps" class="form-control" required>
                </div>
            `);
        });
    </script>
</body>
</html>
