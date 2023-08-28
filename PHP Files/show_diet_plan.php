<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Client's Diet Plan"/>
    <meta name="author" content="Author name"/>
    <title>Client's Diet Plan</title>
    
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
        }
        .title {
            text-align: center;
            padding: 20px 0;
            color: #333;
        }
        .diet-plan {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        .diet-plan:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .diet-item {
            margin-bottom: 10px;
        }
        .item-label {
            font-weight: bold;
            width: 140px;
            display: inline-block;
        }
    </style>
</head>
<body> 
    <section id="section1">
        <div class="container">
            <h1 class="title">Client's Diet Plan</h1>
            <div class="diet-plan">
                <?php
                require_once("DBconnect.php");
                session_start();

                if (isset($_SESSION["email"])) {
                    $clientEmail = $_SESSION["email"];
        
                    $getUserIDQuery = "SELECT client_id FROM client WHERE email = '$clientEmail'";
                    $userIDResult = $conn->query($getUserIDQuery);
        
                    if ($userIDResult->num_rows > 0) {
                        $row = $userIDResult->fetch_assoc();
                        $client_id = $row["client_id"];
                    }
                }
                // Query to fetch client's diet plan
                $sql_diet = "SELECT * FROM diet WHERE client_id = $client_id";
                $result_diet = mysqli_query($conn, $sql_diet);
                
                if (mysqli_num_rows($result_diet) > 0) {
                    $row_diet = mysqli_fetch_assoc($result_diet);
                    $diet_id = $row_diet['diet_id']; // Get the diet_id
                    
                    // Query to fetch breakfast items for the diet plan
                    $sql_breakfast = "SELECT * FROM breakfast_items WHERE diet_id = $diet_id";
                    $result_breakfast = mysqli_query($conn, $sql_breakfast);
                    
                    // Query to fetch lunch items for the diet plan
                    $sql_lunch = "SELECT * FROM lunch_items WHERE diet_id = $diet_id";
                    $result_lunch = mysqli_query($conn, $sql_lunch);
                    
                    // Query to fetch dinner items for the diet plan
                    $sql_dinner = "SELECT * FROM dinner_items WHERE diet_id = $diet_id";
                    $result_dinner = mysqli_query($conn, $sql_dinner);
                    
                    ?>
                    <div class="diet-item">
                        <h3>Breakfast</h3>
                        <?php
                        while ($row_breakfast = mysqli_fetch_assoc($result_breakfast)) {
                            echo "<p><strong>Item:</strong> " . $row_breakfast['name'] . "<br>";
                            echo "<strong>Amount:</strong> " . $row_breakfast['amount'] . "<br>";
                            echo "<strong>Nutritional Info:</strong> " . $row_breakfast['Nut_info'] . "<br>";
                            echo "<strong>Calories:</strong> " . $row_breakfast['calories'] . "</p>";
                        }
                        ?>
                    </div>
                    <div class="diet-item">
                        <h3>Lunch</h3>
                        <?php
                        while ($row_lunch = mysqli_fetch_assoc($result_lunch)) {
                            echo "<p><strong>Item:</strong> " . $row_lunch['name'] . "<br>";
                            echo "<strong>Amount:</strong> " . $row_lunch['amount'] . "<br>";
                            echo "<strong>Nutritional Info:</strong> " . $row_lunch['Nut_info'] . "<br>";
                            echo "<strong>Calories:</strong> " . $row_lunch['calories'] . "</p>";
                        }
                        ?>
                    </div>
                    <div class="diet-item">
                        <h3>Dinner</h3>
                        <?php
                        while ($row_dinner = mysqli_fetch_assoc($result_dinner)) {
                            echo "<p><strong>Item:</strong> " . $row_dinner['name'] . "<br>";
                            echo "<strong>Amount:</strong> " . $row_dinner['amount'] . "<br>";
                            echo "<strong>Nutritional Info:</strong> " . $row_dinner['Nut_info'] . "<br>";
                            echo "<strong>Calories:</strong> " . $row_dinner['calories'] . "</p>";
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    echo "<p>No diet plan available.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
</body>
</html>

