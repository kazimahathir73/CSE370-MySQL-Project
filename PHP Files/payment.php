<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
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
            width: 800px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Payments</h1>

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
        $paymentsQuery = "SELECT * FROM payment WHERE Client_id = '$clientID'";
        $paymentsResult = $conn->query($paymentsQuery);

        if ($paymentsResult->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Month</th><th>Status</th><th>Amount</th></tr>';
            while ($row = $paymentsResult->fetch_assoc()) {
                $month = $row["month"];
                $status = $row["status"];
                $amount = $row["amount"];

                echo '<tr>';
                echo '<td>' . $month . '</td>';
                echo '<td>' . $status . '</td>';
                echo '<td>' . $amount . ' ৳ </td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No payment records available.</p>';
        }
            
        $conn->close();
        ?>
    </div>
</body>
</html>
