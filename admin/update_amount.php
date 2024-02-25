<?php
include("../configsql.php");


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Validate and sanitize input
    $booking_id = isset($_GET["booking_id"]) ? intval($_GET["booking_id"]) : 0;
    $amount = isset($_GET["amount"]) ? floatval($_GET["amount"]) : 0.0;

    // Use prepared statement to update the approved amount
    $sqlUpdate = "UPDATE booking SET amount = ? WHERE booking_id = ?";
    
    $stmt = $db->prepare($sqlUpdate);

    // Bind parameters
    $stmt->bind_param("di", $amount, $booking_id);

    // Execute the update
    if ($stmt->execute()) {
        echo "<script>alert('Booking approved successfully. Amount updated: $amount')</script>";
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$db->close();
?>
