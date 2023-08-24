<!DOCTYPE html>
<html>
<head>
    <title>Trainer Home</title>
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
        <h1>Trainer's Portal</h1>
    </header>

    <nav>
        <ul>
            <li><a href="http://localhost/fitness_tracking_website/trainer_home_page.php">Personal Info</a></li>
            <li><a href="http://localhost/fitness_tracking_website/create_diet_plan.php">Create Diet Plan</a></li>
            <li><a href="http://localhost/fitness_tracking_website/create_workout_routine.php">Create workout Plan</a></li>
            <li><a href="http://localhost/fitness_tracking_website/trainer_submit_issue_to_doctor.php">Issue to Doctor</a></li>

            
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
                $traineremail = $_SESSION["email"];


                $getUserIDQuery = "SELECT trainer_id FROM trainer WHERE email = '$traineremail'";
                $userIDResult = $conn->query($getUserIDQuery);

                if ($userIDResult->num_rows > 0) {
                    $row = $userIDResult->fetch_assoc();
                    $trainerid = $row["trainer_id"];

                    $gettrainerInfoQuery = "SELECT name, specialization, experience FROM trainer WHERE trainer_id = '$trainerid'";
                    $trainerInfoResult = $conn->query($gettrainerInfoQuery);

                    if ($trainerInfoResult->num_rows > 0) {
                        $trainerRow = $trainerInfoResult->fetch_assoc();
                        echo "<p>Name: " . $trainerRow["name"] . "</p>";
                        echo "<p>Specialization: " . $trainerRow["specialization"] . "</p>";
                        echo "<p>Experience: " . $trainerRow["experience"] . "</p>";

                    } else {
                        echo "No personal information available for the trainer.";
                    }
                } else {
                    echo "trainer not found.";
                }
            }

            $conn->close();
            ?>
        </section>

    </main>

    
</body>
</html>