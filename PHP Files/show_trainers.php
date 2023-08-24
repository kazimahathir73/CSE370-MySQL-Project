<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Trainer List"/>
    <meta name="author" content="Author name"/>
    <title>Trainer List</title>
    
    <!-- Add your CSS and JS links here -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .title {
            text-align: center;
            padding: 20px 0;
            color: #333;
        }
        .trainer-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 15px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        .trainer-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body> 
    <section id="section1">
        <div class="container">
            <h1 class="title">All Trainer List</h1>
            <?php 
            require_once("DBconnect.php");
            $sql = "SELECT t.Trainer_id, t.Name, t.Specialization, t.Experience, AVG(r.rating) AS avg_rating 
                    FROM trainer t
                    LEFT JOIN client_rates_trainer r ON t.Trainer_id = r.trainer_id
                    GROUP BY t.Trainer_id, t.Name, t.Specialization, t.Experience";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
            ?>
            <div class="trainer-card">
                <div class="row">
                    <div class="col-md-3">
                        <a href="trainer_details.php?trainer_id=<?php echo $row['Trainer_id']; ?>" style="text-decoration: none; color: #333;">
                            <strong>Trainer Name:</strong> <?php echo $row['Name']; ?>
                        </a>
                    </div>
                    <div class="col-md-3"><strong>Specialization:</strong> <?php echo $row['Specialization']; ?></div>
                    <div class="col-md-3"><strong>Experience:</strong> <?php echo $row['Experience']. " years";  ?></div>
                    <div class="col-md-3"><strong>Average Rating:</strong> <?php echo number_format($row['avg_rating'], 2); ?></div>
                </div>
            </div>
            <?php 
                }					
            }
            ?>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
