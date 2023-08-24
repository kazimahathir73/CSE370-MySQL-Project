<!DOCTYPE html>
<html>
<head>
    <title>Challenges Page</title>
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
            background-color: #ffffff;
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

        .challenge {
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .challenge:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .challenge h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 20px;
        }

        .challenge-info {
            display: flex;
            justify-content: space-between;
            color: #777;
            font-size: 14px;
        }

        .deadline {
            font-size: 14px;
        }

        .challenge-type {
            margin-top: 5px;
            color: #aaa;
        }

        .complete-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .complete-button:hover {
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
        <h1>Challenges</h1>
        
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

        $challengesQuery = "SELECT * FROM challenges WHERE deadline >= NOW() ORDER BY deadline";
        $challengesResult = $conn->query($challengesQuery);

        if ($challengesResult->num_rows > 0) {
            while ($row = $challengesResult->fetch_assoc()) {
                $challengeID = $row["Challenge_id"];
                $challengeName = $row["Task_name"];
                $challengeType = $row["Type"];
                $challengeDeadline = $row["Deadline"];
                $challengePoints = $row["Point"];
                
                echo '<div class="challenge">';
                echo '<h2>' . $challengeName . '</h2>';
                echo '<div class="challenge-info">';
                echo '<span>Type: ' . $challengeType . '</span>';
                echo '<span>Deadline: ' . $challengeDeadline . '</span>';
                echo '</div>';
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="challengeID" value="' . $challengeID . '">';
                echo '<button type="submit" name="complete">Complete</button>';
                echo '</form>';

                echo '<h3>Leaderboard</h3>';
                echo '<ol>';
                $leaderboardQuery = "SELECT c.name AS clientName, l.position
                     FROM leaderboard AS l
                     INNER JOIN client AS c ON l.Client_id = c.Client_id
                     WHERE l.Challenge_id = '$challengeID'
                     ORDER BY l.position";
                $leaderboardResult = $conn->query($leaderboardQuery);

                if ($leaderboardResult->num_rows > 0) {
                    while ($leaderboardRow = $leaderboardResult->fetch_assoc()) {
                        echo '<li>' . $leaderboardRow["clientName"] . ' - Position ' . $leaderboardRow["position"] . '</li>';
                    }
                } else {
                    echo '<li>No participants yet.</li>';
                }
                echo '</ol>';

                echo '</div>';
            }
        } else {
            echo 'No challenges available.';
        }
        
        if (isset($_SESSION["email"])) {
            $clientEmail = $_SESSION["email"];

            $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
            $userIDResult = $conn->query($getUserIDQuery);

            if ($userIDResult->num_rows > 0) {
                $row = $userIDResult->fetch_assoc();
                $clientID = $row["client_id"];
            }
        }

        if (isset($_POST["complete"])) {
            $challengeID = $_POST["challengeID"];
            
            $checkCompletionQuery = "SELECT * FROM achievement WHERE client_id = '$clientID' AND challenge_id = '$challengeID'";
            $completionResult = $conn->query($checkCompletionQuery);
        
            if ($completionResult->num_rows > 0) {
                echo '<p class="error-message">You have already completed this challenge.</p>';
            } else {
                $getChallengeInfoQuery = "SELECT Task_name, Point FROM challenges WHERE Challenge_id = '$challengeID'";
                $challengeInfoResult = $conn->query($getChallengeInfoQuery);
        
                if ($challengeInfoResult->num_rows > 0) {
                    $challengeInfoRow = $challengeInfoResult->fetch_assoc();
                    $challengeName = $challengeInfoRow["Task_name"];
                    $challengePoints = $challengeInfoRow["Point"];
        
                    $insertAchievementQuery = "INSERT INTO achievement (Client_id, Challenge_id, point, task_name) VALUES ('$clientID', '$challengeID', '$challengePoints', '$challengeName')";
                    if ($conn->query($insertAchievementQuery) === TRUE) {
                        echo '<p class="success-message">Challenge completed and added to achievements!</p>';
        
                        $updateLeaderboardQuery = "INSERT INTO leaderboard (Challenge_id, Client_id, position)
                            SELECT '$challengeID', '$clientID', COUNT(*) + 1
                            FROM leaderboard
                            WHERE Challenge_id = '$challengeID'";
                        $conn->query($updateLeaderboardQuery);
        
                    } else {
                        echo '<p class="error-message">Error: ' . $conn->error . '</p>';
                    }
                } else {
                    echo '<p class="error-message">Challenge information not found.</p>';
                }
            }
        }
        

        $conn->close();
        ?>
    </div>
</body>
</html>
