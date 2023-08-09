<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Tracking Result</title>
</head>
<body>
    <h1>Health Tracking Result</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $weight = $_POST["weight"];
        $exercise = $_POST["exercise"];
        $diet = $_POST["diet"];

        // Process the data as per your requirements (e.g., store in a database, perform calculations, etc.)
        // For this demo, we'll just display the data back to the user.
        echo "<p>Weight: $weight kg</p>";
        echo "<p>Exercise: $exercise minutes</p>";
        echo "<p>Diet: $diet calories</p>";
    }
    ?>
</body>
</html>
