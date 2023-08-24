<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="View Issues from Trainers"/>
    <meta name="author" content="Author name"/>
    <title>View Issues from Trainers</title>
    
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
            padding: 20px;
        }
        .title {
            text-align: center;
            padding: 20px 0;
            color: #333;
        }
        .issue-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        .btn-back {
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
            <h1 class="title">View Issues from Trainers</h1>
            <?php
            require_once("DBconnect.php");
            
            // Get the logged-in doctor's ID (you might need to implement session handling)
            $doctor_id = 1; // Set the logged-in doctor ID
            
            // Query to fetch issues submitted by trainers for this doctor
            $sql_issues = "SELECT t.Issue, c.Name AS ClientName, c.client_id
                           FROM trainer_submit_issue_to_doctor AS t
                           JOIN client AS c ON t.Client_id = c.client_id
                           WHERE t.Doctor_id = $doctor_id";
            
            $result_issues = mysqli_query($conn, $sql_issues);
            
            if (mysqli_num_rows($result_issues) > 0) {
                while ($row_issue = mysqli_fetch_assoc($result_issues)) {
                    ?>
                    <div class="issue-card">
                        <h3>Client: <?php echo $row_issue['ClientName']; ?></h3>
                        <p><strong>Issue:</strong> <?php echo $row_issue['Issue']; ?></p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No issues submitted by trainers for your clients.</p>";
            }
            ?>
            <br>
            <a href="doctor_home_page.php" class="btn-back">Back to Doctor Home</a>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
