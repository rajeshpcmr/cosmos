<?php
include("../configsql.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $booking_id = $_GET['booking_id'];

    if (isset($_GET["booking_id"])) {
    $booking_id = $_GET["booking_id"];

    // Use prepared statement
    $stmt = $db->prepare("DELETE FROM booking WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Booking deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Booking ID not provided.";
}
}

$db->close();
?>
