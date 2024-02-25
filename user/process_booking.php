<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Auditorium</title>
    <link rel="icon" href="../images/cosmos.png">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .booking-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .confirm-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: red;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
        }

        .cancel-btn:hover {
            background-color: #800000;
        }
        
    </style>
</head>

<body>

    <?php
    include("../configsql.php");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if (isset($_GET['auditorium_name'])) {
        $auditorium_name = $_GET['auditorium_name'];

        // Retrieve more details about the auditorium as needed

    ?>

        <div class="booking-form">
            <h2>Book Auditorium - <?php echo $auditorium_name; ?></h2>
            <form action="confirm_booking.php" method="post">
                <input type="hidden" name="auditorium_name" value="<?php echo $auditorium_name; ?>">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="booking_date">Book Date:</label>
                <input type="date" id="booking_date" name="booking_date" required>

                <label for="booking_time">Book Time:</label>
                <input type="time" id="booking_time" name="booking_time" required>

                <label for="booking_hours">Book Hours:</label>
                <input type="number" id="booking_hours" name="booking_hours" required>
                

                <!-- Add more input fields for booking details (e.g., booking hours, number of minutes) -->
                <button type="submit" class="confirm-btn">Confirm Booking</button><br><br>
                <a href="./auditorium_list.php" class="cancel-btn">Cancel</a>
            </form>
            <br>
        </div>
        
    <?php
    } else {
        echo "Invalid request.";
    }

    $db->close();
    ?>

</body>

</html>
