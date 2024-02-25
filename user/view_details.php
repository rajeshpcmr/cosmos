<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Auditorium Details</title>
    <link rel="icon" href="../images/cosmos.png">

    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.auditorium-details {
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

p {
    margin-bottom: 20px;
}

.booking-btn {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.booking-btn:hover {
    background-color: #45a049;
}

    </style>
</head>

<body>

    <?php
    include("../configsql.php");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if (isset($_GET['auditorium'])) {
        $auditorium_name = $_GET['auditorium'];

        $sql = "SELECT * FROM auditorium WHERE auditorium_name = '$auditorium_name'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>

            <div class="auditorium-details">
                <h2>Auditorium Details - <?php echo $row["auditorium_name"]; ?></h2>
                <p><strong>Auditorium Name:</strong> <?php echo $row["auditorium_name"]; ?></p>
                <p><strong>Capacity:</strong> <?php echo $row["capacity"]; ?></p>
                <p><strong>Seating Cofiguration:</strong> <?php echo $row["seating_configuration"]; ?></p>
                <p><strong>Type:</strong> <?php echo $row["type"]; ?></p>
                <p><strong>Place:</strong> <?php echo $row["place"]; ?></p>
                <!-- Add more details as needed -->

                <form action="process_booking.php" method="get">
                    <input type="hidden" name="auditorium_name" value="<?php echo $row["auditorium_name"]; ?>">
                    <button type="submit" class="booking-btn">Book Auditorium</button><br><br>
                    <a style="background-color:red; text-decoration:none" href="./auditorium_list.php" class="booking-btn">Exit</a>
                </form>
            </div>

    <?php
        } else {
            echo "Auditorium not found.";
        }
    } else {
        echo "Invalid request.";
    }

    $db->close();
    ?>

</body>

</html>
