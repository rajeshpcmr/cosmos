<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Booking Table Status</title>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        header img {
            cursor: pointer;
        }

        .main-container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
        }

        .navcontainer {
            width: 20%;
            background-color: #fff;
            padding: 20px;
        }

        .main {
            width: 80%;
            padding: 20px;
            background-color: #fff;
        }

        table {
            justify-content: center;
            align-items: center;
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .approve-btn, .reject-btn {
            background-color:red;
            padding: 10px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .approve-btn {
            background-color: green;
        }

        .approve-btn:hover {
            background-color: #00FF00;
        }

        .reject-btn {
            background-color: red;
        }

        .reject-btn:hover {
            background-color: orange;
        }
    </style>
</head>
<body>

<?php
include("../session.php");

$username = $_SESSION['username'];
if(!isset($_SESSION['username'])){
    echo "session not started";
    exit();
}

// Fetch booking data from the table
$sql = "SELECT * FROM booking where username='$username'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Booking Table Status</h2>";
    echo "<table>";
    echo "<tr>
            <th>Booking ID</th>
            <th>Username</th>
            <th>Auditorium Name</th>
            <th>Booking Date</th>
            <th>Booking Time</th>
            <th>Booking Hours</th>
            <th>Approval Status</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["booking_id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["auditorium_name"] . "</td>";
        echo "<td>" . $row["booking_date"] . "</td>";
        echo "<td>" . $row["booking_time"] . "</td>";
        echo "<td>" . $row["booking_hours"] . "</td>";
        echo "<td>" . $row["approve_status"] . "</td>";
        
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found.";
}

// Do not close the database connection here, close it after using the result set in your actual code.

?>
    <br><br>
    <a href="./auditorium_list.php" class="reject-btn">Exit</a>

</body>
</html>
