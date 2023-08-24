<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Comments</title>
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
    <h1>Client Comment</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitness_tracking_database";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();

    if (isset($_SESSION["email"])) {
        $clientEmail = $_SESSION["email"];

        $getUserIDQuery = "SELECT Admin_ID FROM admin WHERE Email = '$clientEmail'";
        $userIDResult = $conn->query($getUserIDQuery);

        if ($userIDResult->num_rows > 0) {
            $row = $userIDResult->fetch_assoc();
            $adminId = $row["Admin_ID"];

            $getClientInfoQuery = "SELECT * FROM client_complains_to_admin WHERE admin_id = '$adminId'";
            $clientInfoResult = $conn->query($getClientInfoQuery);

            if ($clientInfoResult->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Client ID</th><th>Commment</th></tr>";

                while ($row = $clientInfoResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["client_id"] . "</td>";
                    echo "<td>" . $row["comment"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No personal information available for the client.";
            }
        } else {
            echo "No clients found.";
        }
    }

    $conn->close();
    ?>
</body>
</html>