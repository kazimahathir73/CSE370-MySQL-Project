<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Management</title>
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
    <h1>Doctor Management</h1>
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
        echo "<tr><th>Client ID</th><th>Client Name</th><th>Client Email</th><th>Appointed Doctor ID</th><th>Appoint Doctor </th><th>Update Doctor ID</th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Client_ID"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["doctor_id"] . "</td>";
            echo "<td>";
            echo "<form action='insert_doctor.php' method='post'>";
            echo "<input type='hidden' name='Client_ID' value='" . $row["Client_ID"] . "'>";
            
            // Fetch doctors from doctors table
            $doctors_sql = "SELECT doctor_id FROM doctor";
            $doctors_result = $conn->query($doctors_sql);
            
            echo "<select name='doctor_id'>";
            while($doctor_row = $doctors_result->fetch_assoc()) {
                echo "<option value='" . $doctor_row["doctor_id"] . "'>" . $doctor_row["doctor_id"] . "</option>";
            }
            echo "</select>";
            
            echo "<input type='submit' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form action='update_doctor.php' method='post'>";
            echo "<input type='hidden' name='Client_ID' value='" . $row["Client_ID"] . "'>";
            
            // Fetch doctors from doctors table
            $doctors_sql = "SELECT doctor_id FROM doctor";
            $doctors_result = $conn->query($doctors_sql);
            
            echo "<select name='doctor_id'>";
            while($doctor_row = $doctors_result->fetch_assoc()) {
                echo "<option value='" . $doctor_row["doctor_id"] . "'>" . $doctor_row["doctor_id"] . "</option>";
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
