<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Rate Trainer"/>
    <meta name="author" content="Author name"/>
    <title>Rate Trainer</title>
    
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
        .rating-form {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
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
            <h1 class="title">Rate Trainer</h1>
            <div class="rating-form">
            <?php
            require_once("DBconnect.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $trainer_id = $_POST['trainer_id'];
                $rating = $_POST['rating'];
                $client_id = 1; // Replace with your logic to get the logged-in client's ID

                // Insert rating into the database
                $insertSql = "INSERT INTO client_rates_trainer (client_id, trainer_id, rating) 
                            VALUES ($client_id, $trainer_id, $rating)";
                if ($conn->query($insertSql) === TRUE) {
                    // Rating submitted successfully, redirect to trainer_details.php
                    header("Location: trainer_details.php?trainer_id=$trainer_id");
                    exit(); // Terminate script execution after the header
                } else {
                    echo "Error submitting rating: " . $conn->error;
                }
            }
            ?>
                <form method="POST" action="rate_trainer.php">
                    <div class="form-group">
                        <label class="form-label">Select Rating:</label>
                        <select name="rating" class="form-control">
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Fair</option>
                            <option value="3">3 - Average</option>
                            <option value="4">4 - Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    <input type="hidden" name="trainer_id" value="<?php echo $_GET['trainer_id']; ?>">
                    <button type="submit" class="btn-submit">Submit Rating</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
</body>
</html>
