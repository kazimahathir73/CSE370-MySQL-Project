<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Change Trainer"/>
    <meta name="author" content="Author name"/>
    <title>Change Trainer</title>
    
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
            <h1 class="title">Change Trainer</h1>
            <?php
            require_once("DBconnect.php");
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $new_trainer_id = $_POST['new_trainer_id'];

                if (isset($_SESSION["email"])) {
                    $clientEmail = $_SESSION["email"];
        
                    $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
                    $userIDResult = $conn->query($getUserIDQuery);
        
                    if ($userIDResult->num_rows > 0) {
                        $row = $userIDResult->fetch_assoc();
                        $clientID = $row["client_id"];
                    }
                }
                
                $updateSql = "UPDATE client SET trainer = $new_trainer_id WHERE client_id = $client_id";
                
                if ($conn->query($updateSql) === TRUE) {
                    echo "<p>Trainer changed successfully.</p>";
                } else {
                    echo "Error changing trainer: " . $conn->error;
                }
            }
            
            $sql_trainers = "SELECT * FROM trainer";
            $result_trainers = mysqli_query($conn, $sql_trainers);
            
            if (mysqli_num_rows($result_trainers) > 0) {
                ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label">Select New Trainer:</label>
                        <select name="new_trainer_id" class="form-control">
                            <?php
                            while ($row_trainer = mysqli_fetch_assoc($result_trainers)) {
                                echo "<option value=\"" . $row_trainer['Trainer_id'] . "\">" . $row_trainer['Name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn-submit">Change Trainer</button>
                </form>
                <?php
            } else {
                echo "<p>No trainers available.</p>";
            }
            ?>
            <br>
            <a href="trainer_details.php?trainer_id=<?php echo $trainer_id; ?>" class="btn btn-secondary">Back to Trainer Details</a>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
