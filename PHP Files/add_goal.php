<?php
// Include database connection code
require_once("DBconnect.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $target = implode(', ', $_POST['target']);
    $goalType = $_POST['goal_type'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $achieved = isset($_POST['achieved']) ? 1 : 0;

    // Assume you have a logged-in user with a known user ID (replace with actual implementation)
    $loggedInUserId = 1; // Replace with actual user ID

    // Insert new goal into the database
    $insertSql = "INSERT INTO goal (Client_id, Target, Goal_type, Start, End, Achieved)
                  VALUES ('$loggedInUserId', '$target', '$goalType', '$startDate', '$endDate', '$achieved')";

    if ($conn->query($insertSql) === TRUE) {
        // Redirect back to the goal page
        header("Location: goal.php");
        exit; // Ensure that the script stops executing after the redirect
    } else {
        echo "Error adding goal: " . $conn->error;
    }
}

$conn->close();
?>
