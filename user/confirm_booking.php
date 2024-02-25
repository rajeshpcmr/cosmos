<?php
include("../configsql.php");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auditorium_name = $_POST['auditorium_name'];
    $username = $_POST['username'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $booking_hours = $_POST['booking_hours'];

    // Check if the time slot is available
    $check_availability_query = "SELECT * FROM booking 
                                 WHERE auditorium_name = '$auditorium_name' 
                                 AND booking_date = '$booking_date' 
                                 AND booking_time <= '$booking_time' 
                                 AND DATE_ADD(booking_time, INTERVAL booking_hours HOUR) >= '$booking_time'";

    $availability_result = $db->query($check_availability_query);

    if ($availability_result->num_rows > 0) {
        echo "The auditorium is not available at the selected time. Please choose a different time.";
    } else {
        // Insert the booking details into the 'booking' table
        $insert_query = "INSERT INTO booking (username, auditorium_name, booking_date, booking_time, booking_hours) 
                         VALUES ('$username', '$auditorium_name', '$booking_date', '$booking_time', '$booking_hours')";

        if ($db->query($insert_query) === TRUE) {
    echo "<script>alert('Booking confirmed successfully!')</script>";
}
 else {
            echo "Error: " . $insert_query . "<br>" . $db->error;
        }
    }
} else {
    echo "Invalid request.";
}

$db->close();
?>

