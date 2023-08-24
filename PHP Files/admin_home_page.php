<!DOCTYPE html>
<html>
<head>
    <title>Admin Home - Fitness Tracking</title>
    <style>
        body, h1, h2, ul, li {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #007bff;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 15px;
            color: #007bff;
        }

        footer {
            background-color: #f4f4f4;
            padding: 10px 0;
            text-align: center;
            color: #555;
        }

        @media (max-width: 768px) {
            nav ul li {
                display: block;
                margin-bottom: 10px;
            }
        }

    </style>
</head>
<body>
    <header>
        <h1>Welcome!</h1>
    </header>

    <nav>
        <ul>
            <li><a href="http://localhost/fitness_tracking_website/admin_home_page.php">Personal Info</a></li>
            <li><a href="http://localhost/fitness_tracking_website/all_doctors.php">All Doctors</a></li>
            <li><a href="http://localhost/fitness_tracking_website/all_trainers.php"> All Trainers</a></li>
            <li><a href="http://localhost/fitness_tracking_website/all_comments.php">All Comments</a></li>            
        </ul>
    </nav>

    <main>
        <section id="personal">
            <h2>Personal Info</h2>
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

                    $getClientInfoQuery = "SELECT Name, Email FROM admin WHERE Admin_ID = '$adminId'";
                    $clientInfoResult = $conn->query($getClientInfoQuery);

                    if ($clientInfoResult->num_rows > 0) {
                        $clientRow = $clientInfoResult->fetch_assoc();
                        echo "<p>Name: " . $clientRow["Name"] . "</p>";
                        echo "<p>Email: " . $clientRow["Email"] . "</p>";
                    } else {
                        echo "No personal information available for the client.";
                    }
                } else {
                    echo "Client not found.";
                }
            }

            $conn->close();
            ?>
        </section>

    </main>

    
</body>
</html>
