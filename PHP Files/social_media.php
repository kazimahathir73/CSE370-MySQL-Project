<!DOCTYPE html>
<html>
<head>
    <title>Social Media - Fitness Tracking</title>
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
        width: 400px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #007bff;
    }

    label, input[type="text"], input[type="submit"] {
        display: block;
        margin-bottom: 20px;
        width: 100%;
    }

    input[type="text"] {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s, transform 0.2s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Social Media</h1>

        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <input type="submit" value="Send Friend Request" class="submit-button">
        </form>

        <?php

        session_start();
        
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fitness_tracking_database";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $receiverUsername = $_POST["username"];

            $receiverIDQuery = "SELECT Client_id FROM client WHERE name = '$receiverUsername'";
            $receiverIDResult = $conn->query($receiverIDQuery);

            if ($receiverIDResult->num_rows > 0) {
                $receiverIDRow = $receiverIDResult->fetch_assoc();
                $receiverID = $receiverIDRow["Client_id"];

                $insertRequestQuery = "INSERT INTO friend_request (sender_id, receiver_id) VALUES ('$clientID', '$receiverID')";
                if ($conn->query($insertRequestQuery) === TRUE) {
                    echo "<p>Friend request sent to $receiverUsername.</p>";
                } else {
                    echo "<p>Error sending friend request: " . $conn->error . "</p>";
                }
            } else {
                echo "<p>Username not found.</p>";
            }
        }

        echo "<h2>Your Friend Requests</h2>";
        $friendRequestsQuery = "SELECT sender_id, status FROM friend_request WHERE receiver_id = '$clientID'";
        $friendRequestsResult = $conn->query($friendRequestsQuery);

        if ($friendRequestsResult->num_rows > 0) {
            while ($requestRow = $friendRequestsResult->fetch_assoc()) {
                $senderID = $requestRow["sender_id"];
                $status = $requestRow["status"];
                
                $senderUsernameQuery = "SELECT name FROM client WHERE Client_id = '$senderID'";
                $senderUsernameResult = $conn->query($senderUsernameQuery);
                $senderUsernameRow = $senderUsernameResult->fetch_assoc();
                $senderUsername = $senderUsernameRow["name"];
        
                echo "<p><strong>$senderUsername</strong> sent you a friend request. ";

                if ($status == "pending") {
                    echo "<a href='social_media.php?acceptRequest=$senderID'>Accept</a> / <a href='social_media.php?rejectRequest=$senderID'>Reject</a>";
                } elseif ($status == "accepted") {
                    echo "Friend request accepted.";
                } elseif ($status == "rejected") {
                    echo "Friend request rejected.";
                }
        
                echo "</p>";
        
                if (isset($_GET['acceptRequest']) && $_GET['acceptRequest'] == $senderID) {
                    $updateStatusQuery = "UPDATE friend_request SET status = 'accepted' WHERE sender_id = '$senderID' AND receiver_id = '$clientID'";
                    if ($conn->query($updateStatusQuery) === TRUE) {
                        $checkFriendQuery = "SELECT * FROM friendship WHERE (client1 = '$clientID' AND client2 = '$senderID') OR (client1 = '$senderID' AND client2 = '$clientID')";
                        $checkFriendResult = $conn->query($checkFriendQuery);
                
                        if ($checkFriendResult->num_rows === 0) {
                            $insertFriendQuery = "INSERT INTO friendship (client1, client2) VALUES ('$clientID', '$senderID')";
                            if ($conn->query($insertFriendQuery) === TRUE) {
                                echo "<p>Friend request from $senderUsername accepted.</p>";
                            } else {
                                echo "<p>Error accepting friend request: " . $conn->error . "</p>";
                            }
                        } 
                    } else {
                        echo "<p>Error accepting friend request: " . $conn->error . "</p>";
                    }
                }
                
        
                if (isset($_GET['rejectRequest']) && $_GET['rejectRequest'] == $senderID) {
                    $updateStatusQuery = "UPDATE friend_request SET status = 'rejected' WHERE sender_id = '$senderID' AND receiver_id = '$clientID'";
                    if ($conn->query($updateStatusQuery) === TRUE) {
                        echo "<p>Friend request from $senderUsername rejected.</p>";
                    } else {
                        echo "<p>Error rejecting friend request: " . $conn->error . "</p>";
                    }
                }
            }
        } else {
            echo "<p>No pending friend requests.</p>";
        }
        
        echo "<h2>Your Friends</h2>";
        $friendsQuery = "SELECT client1, client2 FROM friendship WHERE client1 = '$clientID' OR client2 = '$clientID'";
        $friendsResult = $conn->query($friendsQuery);

        if ($friendsResult->num_rows > 0) {
            while ($friendRow = $friendsResult->fetch_assoc()) {
                $friendID1 = $friendRow["client1"];
                $friendID2 = $friendRow["client2"];

                $friendID = ($friendID1 != $clientID) ? $friendID1 : $friendID2;

                $friendUsernameQuery = "SELECT name FROM client WHERE client_id = '$friendID'";
                $friendUsernameResult = $conn->query($friendUsernameQuery);
                $friendUsernameRow = $friendUsernameResult->fetch_assoc();
                $friendUsername = $friendUsernameRow["name"];

                echo "<p><strong>$friendUsername</strong></p>";

                $friendAchievementsQuery = "SELECT task_name, point FROM achievement WHERE client_id = '$friendID'";
                $friendAchievementsResult = $conn->query($friendAchievementsQuery);

                if ($friendAchievementsResult->num_rows > 0) {
                    echo "<ul>";
                    while ($achievementRow = $friendAchievementsResult->fetch_assoc()) {
                        echo "<li>" . $achievementRow["task_name"] . " - " . $achievementRow["point"] . " points</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No achievements from this friend.</p>";
                }
            }
        } else {
            echo "<p>You have no friends yet.</p>";
        }
        $conn->close();
        
        ?>
    </div>
</body>
</html>
