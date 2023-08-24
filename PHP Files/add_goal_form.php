<!DOCTYPE html>
<html>
<head>
    <title>Add New Goal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        label, input[type="text"], input[type="date"], input[type="checkbox"] {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="checkbox"] {
            display: inline-block;
            width: auto;
            margin-left: 10px;
        }

        input[type="submit"] {
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
    <header>
        <h1>Add New Goal</h1>
    </header>

    <div class="container">
        <form method="POST" action="add_goal.php">
            <label for="target">Target(s):</label>
            <input type="text" name="target[]" id="target" multiple>
            <label for="goal_type">Goal Type:</label>
            <input type="text" name="goal_type" id="goal_type">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date">
            <label for="achieved">Achieved:</label>
            <input type="checkbox" name="achieved" id="achieved" value="1"> <!-- Value "1" represents true -->
            <br>
            <input type="submit" value="Add Goal">
        </form>
    </div>
</body>
</html>