<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
        label, input[type="text"], input[type="email"], input[type="password"], select, input[type="submit"] {
            display: block;
            margin-bottom: 20px;
            width: 100%;
        }
        input[type="text"], input[type="email"], input[type="password"], select {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
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
        p.success-message, p.error-message {
            color: #ff0000;
            margin-top: 5px;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
        .signup-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .signup-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .input-container {
            position: relative;
            margin-bottom: 20px;
        }
        .input-container label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            background-color: #fff;
            padding: 0 5px;
            font-size: 14px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form method="post" action="sign_up.php">
            <div class="input-container">
                <label for="role"></label>
                <select id="role" name="role">
                    <option value="client">Client</option>
                    <option value="trainer">Trainer</option>
                    <option value="doctor">Doctor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="input-container">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-container">
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div id="extra-fields" class="input-container"></div>
            <button class="signup-button" type="submit">Sign Up</button>
        </form>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fitness_tracking_database";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $role = $_POST["role"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $name = $_POST["name"];

                switch ($role) {
                    case "client":
                        $age = $_POST["age"];
                        $gender = $_POST["gender"];
                        $height = $_POST["height"];
                        $weight = $_POST["weight"];
                        
                        $insertClientQuery = "INSERT INTO Client (Email, Password, Name, Age, Gender, Height, Weight) VALUES ('$email', '$password', '$name', '$age', '$gender', '$height', '$weight')";
                        if ($conn->query($insertClientQuery) !== TRUE) {
                            echo "Error inserting client information: " . $conn->error;
                            exit;
                        }
                        break;
                    case "trainer":
                        $specialization = $_POST["specialization"];
                        $experience = $_POST["experience"];
                        
                        $insertTrainerQuery = "INSERT INTO Trainer (Email, Password, Name, Specialization, Experience) VALUES ('$email', '$password', '$name', '$specialization', '$experience')";
                        if ($conn->query($insertTrainerQuery) !== TRUE) {
                            echo "Error inserting trainer information: " . $conn->error;
                            exit;
                        }
                        break;
                    case "doctor":
                        $patientNumber = $_POST["patient_number"];
                        
                        $insertDoctorQuery = "INSERT INTO Doctor (Email, Password, Name, patient_number) VALUES ('$email', '$password', '$name', '$patientNumber')";
                        if ($conn->query($insertDoctorQuery) !== TRUE) {
                            echo "Error inserting doctor information: " . $conn->error;
                            exit;
                        }
                        break;
                    case "admin":
                        $insertAdminQuery = "INSERT INTO Admin (Email, Password, Name) VALUES ('$email', '$password', '$name')";
                        if ($conn->query($insertAdminQuery) !== TRUE) {
                            echo "Error inserting admin information: " . $conn->error;
                            exit;
                        }
                        break;
                }

                header("Location: http://localhost/fitness_tracking_website/sign_in.php");
            }

            $conn->close();
            ?>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const roleSelect = document.getElementById("role");
        const extraFieldsContainer = document.getElementById("extra-fields");

        roleSelect.addEventListener("change", function() {
            const selectedRole = roleSelect.value;
            extraFieldsContainer.innerHTML = "";

            switch (selectedRole) {
                case "client":
                    extraFieldsContainer.innerHTML = `
                        <input type="number" name="age" placeholder="Age" required>
                        <input type="text" name="gender" placeholder="Gender" required>
                        <input type="number" name="height" placeholder="Height" required>
                        <input type="number" name="weight" placeholder="Weight" required>
                    `;
                    break;
                case "trainer":
                    extraFieldsContainer.innerHTML = `
                        <input type="text" name="specialization" placeholder="Specialization" required>
                        <input type="number" name="experience" placeholder="Experience" required>
                    `;
                    break;
            }
        });
    });
    </script>
</body>
</html>