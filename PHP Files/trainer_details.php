<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Client's Trainer Details"/>
    <meta name="author" content="Author name"/>
    <title>Client's Trainer Details</title>
    
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
        .trainer-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        .trainer-details:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .details-row {
            margin-bottom: 10px;
        }
        .details-label {
            font-weight: bold;
            width: 140px;
            display: inline-block;
        }
    </style>
</head>
<body> 
    <section id="section1">
        <div class="container">
            <h1 class="title">Client's Trainer Details</h1>
            <div class="trainer-details">
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
                
                // Query to fetch client's trainer_id
                $sql_client = "SELECT trainer FROM client WHERE client_id = $client_id";
                $result_client = mysqli_query($conn, $sql_client);
                
                if (mysqli_num_rows($result_client) > 0) {
                    $row_client = mysqli_fetch_assoc($result_client);
                    $trainer_id = $row_client['trainer']; // Get the trainer_id
                    
                    // Query to fetch trainer's details based on trainer_id
                    $sql_trainer = "SELECT * FROM trainer WHERE trainer_id = $trainer_id";
                    $result_trainer = mysqli_query($conn, $sql_trainer);
                    
                    if (mysqli_num_rows($result_trainer) > 0) {
                        $row_trainer = mysqli_fetch_assoc($result_trainer);

                        ?>
                        <div class="details-row">
                            <span class="details-label">Trainer ID:</span> <?php echo $row_trainer['Trainer_id']; ?>
                        </div>
                        <div class="details-row">
                            <span class="details-label">Trainer Name:</span> <?php echo $row_trainer['Name']; ?>
                        </div>
                        <div class="details-row">
                            <span class="details-label">Experience:</span> <?php echo $row_trainer['Experience'] . " Years"; ?>
                        </div>
                        <div class="details-row">
                            <span class="details-label">Specialization:</span> <?php echo $row_trainer['Specialization']; ?>
                        </div>
                        <div class="details-row">
                        <?php
                        // Query to fetch trainer's average rating
                        $sql_avg_rating = "SELECT AVG(rating) AS avg_rating FROM client_rates_trainer WHERE trainer_id = $trainer_id";
                        $result_avg_rating = mysqli_query($conn, $sql_avg_rating);
                        
                        if (mysqli_num_rows($result_avg_rating) > 0) {
                            $row_avg_rating = mysqli_fetch_assoc($result_avg_rating);
                            $average_rating = $row_avg_rating['avg_rating'];
                            ?>
                            <p><strong>Average Rating:</strong> <?php echo number_format($average_rating, 2); ?></p>
                            <?php
                        } else {
                            echo "<p>No ratings available.</p>";
                        }
                        ?>
                        </div>
                        <div class="details-row">
                            <a href="rate_trainer.php?trainer_id=<?php echo $trainer_id; ?>" class="btn btn-primary">Rate Trainer</a>
                        </div>
                        <div class="details-row">
                            <a href="show_trainers.php" class="btn btn-secondary">Back to All Trainers</a>
                        </div>
                        <div class="details-row">
                        <a href="change_trainer.php" class="btn btn-primary">Change Trainer</a>
                        </div>

                        <?php
                    } else {
                        echo "<p>Trainer not found.</p>";
                    }
                } else {
                    echo "<p>Client not found.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
</body>
</html>
