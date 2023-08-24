<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Create Diet Plan"/>
    <meta name="author" content="Author name"/>
    <title>Create Diet Plan</title>
    
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
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            <h1 class="title">Create Diet Plan</h1>
            <?php
            require_once("DBconnect.php");

            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get client ID from form
                $client_id = $_POST['client_id'];
                
                // Insert diet plan into the diet table
                $insertSql = "INSERT INTO diet (client_id, trainer_id) VALUES ('$client_id', '$trainer_id')";
                if ($conn->query($insertSql) === TRUE) {
                    $diet_id = $conn->insert_id; // Get the auto-generated diet_id
                    
                    // Insert breakfast items
                    $breakfast_items = $_POST['breakfast_items'];
                    foreach ($breakfast_items as $item) {
                        $insertBreakfastSql = "INSERT INTO breakfast_items (diet_id, name, amount, Nut_info, calories) VALUES ('$diet_id', '$item[name]', '$item[amount]', '$item[Nut_info]', '$item[calories]')";
                        $conn->query($insertBreakfastSql);
                    }
                    
                    // Insert lunch items
                    $lunch_items = $_POST['lunch_items'];
                    foreach ($lunch_items as $item) {
                        $insertLunchSql = "INSERT INTO lunch_items (diet_id, name, amount, Nut_info, calories) VALUES ('$diet_id', '$item[name]', '$item[amount]', '$item[Nut_info]', '$item[calories]')";
                        $conn->query($insertLunchSql);
                    }
                    
                    // Insert dinner items
                    $dinner_items = $_POST['dinner_items'];
                    foreach ($dinner_items as $item) {
                        $insertDinnerSql = "INSERT INTO dinner_items (diet_id, name, amount, Nut_info, calories) VALUES ('$diet_id', '$item[name]', '$item[amount]', '$item[Nut_info]', '$item[calories]')";
                        $conn->query($insertDinnerSql);
                    }
                    
                    echo "<p>Diet plan created successfully.</p>";
                } else {
                    echo "Error creating diet plan: " . $conn->error;
                }
            }
            ?>
            <form method="POST" action="create_diet_plan.php">
                <div class="form-group">
                    <label class="form-label">Client ID:</label>
                    <input type="text" name="client_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Breakfast Items:</label>
                    <button type="button" class="btn btn-secondary" id="addBreakfast">Add Item</button>
                    <div id="breakfastItems">
                        <div class="item-row">
                            <input type="text" name="breakfast_items[0][name]" placeholder="Item Name" class="form-control" required>
                            <input type="text" name="breakfast_items[0][amount]" placeholder="Amount" class="form-control" required>
                            <input type="text" name="breakfast_items[0][Nut_info]" placeholder="Nutritional Info" class="form-control" required>
                            <input type="text" name="breakfast_items[0][calories]" placeholder="Calories" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lunch Items:</label>
                    <button type="button" class="btn btn-secondary" id="addLunch">Add Item</button>
                    <div id="lunchItems">
                        <div class="item-row">
                            <input type="text" name="lunch_items[0][name]" placeholder="Item Name" class="form-control" required>
                            <input type="text" name="lunch_items[0][amount]" placeholder="Amount" class="form-control" required>
                            <input type="text" name="lunch_items[0][Nut_info]" placeholder="Nutritional Info" class="form-control" required>
                            <input type="text" name="lunch_items[0][calories]" placeholder="Calories" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Dinner Items:</label>
                    <button type="button" class="btn btn-secondary" id="addDinner">Add Item</button>
                    <div id="dinnerItems">
                        <div class="item-row">
                            <input type="text" name="dinner_items[0][name]" placeholder="Item Name" class="form-control" required>
                            <input type="text" name="dinner_items[0][amount]" placeholder="Amount" class="form-control" required>
                            <input type="text" name="dinner_items[0][Nut_info]" placeholder="Nutritional Info" class="form-control" required>
                            <input type="text" name="dinner_items[0][calories]" placeholder="Calories" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Create Diet Plan</button>
            </form>
        </div>
    </section>
    <!-- Add your footer section and scripts here -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // Add new breakfast item row
        $('#addBreakfast').click(function () {
            $('#breakfastItems').append(`
                <div class="item-row">
                    <input type="text" name="breakfast_items[][name]" placeholder="Item Name" class="form-control" required>
                    <input type="text" name="breakfast_items[][amount]" placeholder="Amount" class="form-control" required>
                    <input type="text" name="breakfast_items[][Nut_info]" placeholder="Nutritional Info" class="form-control" required>
                    <input type="text" name="breakfast_items[][calories]" placeholder="Calories" class="form-control" required>
                </div>
            `);
        });
        
        // Add new lunch item row
        $('#addLunch').click(function () {
            $('#lunchItems').append(`
                <div class="item-row">
                    <input type="text" name="lunch_items[][name]" placeholder="Item Name" class="form-control" required>
                    <input type="text" name="lunch_items[][amount]" placeholder="Amount" class="form-control" required>
                    <input type="text" name="lunch_items[][Nut_info]" placeholder="Nutritional Info" class="form-control" required>
                    <input type="text" name="lunch_items[][calories]" placeholder="Calories" class="form-control" required>
                </div>
            `);
        });
        
        // Add new dinner item row
        $('#addDinner').click(function () {
            $('#dinnerItems').append(`
                <div class="item-row">
                    <input type="text" name="dinner_items[][name]" placeholder="Item Name" class="form-control" required>
                    <input type="text" name="dinner_items[][amount]" placeholder="Amount" class="form-control" required>
                    <input type="text" name="dinner_items[][Nut_info]" placeholder="Nutritional Info" class="form-control" required>
                    <input type="text" name="dinner_items[][calories]" placeholder="Calories" class="form-control" required>
                </div>
            `);
        });
    </script>
</body>
</html>
