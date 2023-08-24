<!DOCTYPE html>
<html>
<head>
    <title>Fitness Tracking Website</title>
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
        label, select, input[type="password"], input[type="submit"] {
            display: block;
            margin-bottom: 20px;
            width: 100%;
        }
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
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
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p.error-message {
            color: #ff0000;
            margin-top: 5px;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Fitness Tracking Website</h1>
        
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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];
                $password = $_POST["password"];
                $role = $_POST["role"];

                $_SESSION["email"] = $email;

                switch ($role) {
                    case "client":
                        $table = "client";
                        $redirectURL = "client_home_page.php";
                        break;
                    case "trainer":
                        $table = "trainer";
                        $redirectURL = "trainer_home_page.php";
                        break;
                    case "doctor":
                        $table = "doctor";
                        $redirectURL = "doctor_home_page.php";
                        break;
                    case "admin":
                        $table = "admin";
                        $redirectURL = "admin_home_page.php";
                        break;
                    default:
                        echo "<p class='error-message'>Invalid role.</p>";
                        exit;
                }

                $sql = "SELECT * FROM $table WHERE email = '$email' AND password = '$password'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    header("Location: http://localhost/fitness_tracking_website/$redirectURL");
                } else {
                    echo "<p class='error-message'>Invalid credentials. Please try again.</p>";
                }
            }

            $conn->close();
        
        ?>

        <div class="sign-option">
            <a href="#">Sign In</a>
            <span> | </span>
            <a href="http://localhost/fitness_tracking_website/sign_up.php">Sign Up</a>       
        </div>

        <p> </p>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <p> </p>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="role">Select Role:</label>
            <select id="role" name="role">
                <option value="client">Client</option>
                <option value="trainer">Trainer</option>
                <option value="doctor">Doctor</option>
                <option value="admin">Admin</option>
            </select>
            
            <input type="submit" value="Sign In">
        </form>
    </div>
</body>
</html>
