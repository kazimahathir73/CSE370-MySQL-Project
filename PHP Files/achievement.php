<!DOCTYPE html>
<html>
<head>
    <title>Achievement Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 800px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .achievement {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            position: relative;
        }

        .achievement h2 {
            margin-bottom: 5px;
            color: #333;
        }

        .achievement-info {
            display: flex;
            justify-content: space-between;
            color: #555;
        }

        .achievement-date {
            font-size: 14px;
        }

        .achievement-description {
            margin-top: 10px;
            color: #666;
        }

        .achievement-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .achievement-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 15px;
            }
        }


    </style>
</head>
<body>
    <div class="container">
        <h1>Achievements</h1>
        
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

            $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
            $userIDResult = $conn->query($getUserIDQuery);

            if ($userIDResult->num_rows > 0) {
                $row = $userIDResult->fetch_assoc();
                $clientID = $row["client_id"];
            }
        }

        $achievementsQuery = "SELECT a.task_name AS Challenge_name, c.type AS Challenge_type, a.point AS Point_Earn
            FROM achievement AS a
            JOIN challenges AS c ON a.Challenge_id = c.Challenge_id
            WHERE a.Client_id = '$clientID'";
        $achievementsResult = $conn->query($achievementsQuery);

        if ($achievementsResult->num_rows > 0) {
            while ($row = $achievementsResult->fetch_assoc()) {
                $challengeName = $row["Challenge_name"];
                $challengeType = $row["Challenge_type"];
                $pointearn = $row["Point_Earn"];
                
                echo '<div class="achievement">';
                echo '<h2>' . $challengeName . '</h2>';
                echo '<div class="achievement-info">';
                echo '<span>Type: ' . $challengeType . '</span>';
                echo '<span>Point Earned: ' . $pointearn . '</span>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No achievements yet.';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
