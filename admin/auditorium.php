<?php
include("../configsql.php");

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set in the $_POST array
    
        // Get data from the form
        $auditorium_name = $_POST['auditorium_name'];
        $capacity = $_POST['capacity'];
        $seating_configuration = $_POST['seating_configuration'];
        $type = $_POST['type'];
        $place = $_POST['place'];

        // Use prepared statement to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO auditorium 
        (auditorium_name, capacity,seating_configuration,type,place) 
        VALUES (?, ?,?,?,?)");
        $stmt->bind_param("sisss", $auditorium_name, $capacity,$seating_configuration,$type,$place);

        if ($stmt->execute()) {
            echo "Auditorium details added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        

        $stmt->close();
    
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
    <link rel="icon" href="../images/cosmos.png">

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
}

input {
    padding: 8px;
    margin-bottom: 16px;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
a{
    text-decoration:none;
    background-color: red;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Add Auditorium Details</h2>
        <form action="auditorium.php" method="post">
            <label for="auditorium_name">Auditorium Name:</label>
            <input type="text" id="auditorium_name" name="auditorium_name" required>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" required>

            <label for="seating_configuration">Seat configuration:</label>
            <input type="text" id="seating_configuration" name="seating_configuration" required>

            <label for="type">Size</label>
            <input type="text" id="type" name="type" required>

            <label for="place">Place</label>
            <input type="text" id="place" name="place" required>



            <button type="submit">Add Auditorium</button><br>
            <left><a href="./admin_dashboard.php">Exit</a></left>
        </form>
    </div>
</body>
</html>
