<!DOCTYPE html>
<html>
<head>
    <title>Goal Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }

        a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your Goals</h1>
    </header>

    <div class="container">
        <?php
        // Include database connection code
        require_once("DBconnect.php");

        session_start();

        if (isset($_SESSION["email"])) {
            $clientEmail = $_SESSION["email"];

            $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
            $userIDResult = $conn->query($getUserIDQuery);

            if ($userIDResult->num_rows > 0) {
                $row = $userIDResult->fetch_assoc();
                $clientID = $row["client_id"];
            }
        }

        $sql = "SELECT * FROM goal WHERE Client_id = $clientID"; 
        $result =  mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <tr>
                    <th>Target</th>
                    <th>Goal Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Achieved</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                $achievedText = ($row['Achieved'] == 1) ? "Yes" : "No";

                // Display goals
                echo "<tr>
                    <td>{$row['Target']}</td>
                    <td>{$row['Goal_type']}</td>
                    <td>{$row['Start']}</td>
                    <td>{$row['End']}</td>
                    <td>{$achievedText}</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No goals found for this client.";
        }

        $conn->close();
        ?>

        <h2>Add New Goal</h2>
        <a href="add_goal_form.php">Add Goal</a>
    </div>
</body>
</html>