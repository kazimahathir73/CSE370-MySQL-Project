<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_tracking_database";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Client_ID = $_POST["Client_ID"];
    $new_trainer_id = $_POST["Trainer_id"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $update_sql = "UPDATE client SET Trainer = '$new_trainer_id' WHERE Client_ID = '$Client_ID'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Trainer ID updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
