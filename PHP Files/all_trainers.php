<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        select {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Trainer Management</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitness_tracking_database";
    

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Client ID</th><th>Client Name</th><th>Client Email</th><th>Appointed Trainer ID</th><th>Update Trainer ID</th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Client_ID"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["Trainer"] . "</td>";
            echo "<td>";
            echo "<form action='insert_trainer.php' method='post'>";
            echo "<input type='hidden' name='Client_ID' value='" . $row["Client_ID"] . "'>";
            
            // Fetch doctors from doctors table
            $trainers_sql = "SELECT Trainer_id FROM trainer";
            $trainers_result = $conn->query($trainers_sql);
            
            echo "<select name='Trainer_id'>";
            while($trainer_row = $trainers_result->fetch_assoc()) {
                echo "<option value='" . $trainer_row["Trainer_id"] . "'>" . $trainer_row["Trainer_id"] . "</option>";
            }
            echo "</select>";
            
            echo "<input type='submit' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form action='update_trainer.php' method='post'>";
            echo "<input type='hidden' name='Client_ID' value='" . $row["Client_ID"] . "'>";
            
            // Fetch doctors from doctors table
            $trainers_sql = "SELECT Trainer_id FROM trainer";
            $trainers_result = $conn->query($trainers_sql);
            
            echo "<select name='Trainer_id'>";
            while($trainer_row = $trainers_result->fetch_assoc()) {
                echo "<option value='" . $trainer_row["Trainer_id"] . "'>" . $trainer_row["Trainer_id"] . "</option>";
            }
            echo "</select>";
            
            echo "<input type='submit' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No clients found.";
    }



$conn->close();
?>
<!--  -->
</body>
</html>
