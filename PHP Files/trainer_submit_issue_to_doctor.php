<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Trainer Submit Issue to Doctor"/>
    <meta name="author" content="Author name"/>
    <title>Trainer Submit Issue to Doctor</title>
    
    <!-- Add your CSS and JS links here -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .title {
            text-align: center;
            padding-bottom: 20px;
            color: #333;
        }
        .issue-form {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .btn-submit {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body> 
    <section id="section1">
        <div class="container">
            <h1 class="title">Trainer Submit Issue to Doctor</h1>
            <div class="issue-form">
                <form method="POST" action="submit_issue.php">
                    <div class="form-group">
                        <label for="doctor_id">Select Doctor:</label>
                        <select name="doctor_id" class="form-control">
                            <?php
                            require_once("DBconnect.php");
                            $sql_doctors = "SELECT * FROM doctor";
                            $result_doctors = mysqli_query($conn, $sql_doctors);
                            while ($row_doctor = mysqli_fetch_assoc($result_doctors)) {
                                echo "<option value=\"" . $row_doctor['doctor_id'] . "\">" . $row_doctor['Name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Enter Client ID:</label>
                        <input type="text" name="client_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="issue">Issue:</label>
                        <textarea name="issue" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit">Submit Issue</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
