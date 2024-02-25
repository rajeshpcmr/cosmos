<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cosmos | Admin dashboard</title>
    <link rel="icon" href="../images/cosmos.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/admindb.css">
    
    <style>
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
            width: 100%;
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
    </style>
</head>

<body>
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <p id="confirmationText"></p>
            <button class="approve-btn" onclick="confirmAction()">Confirm</button>
            <button class="reject-btn" onclick="cancelAction()">Cancel</button>
        </div>
    </div>

    <?php
    include("../configsql.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["approve"])) {
            $booking_id = $_POST["approve"];
            // Perform SQL UPDATE for approved booking
            $sqlUpdate = "UPDATE booking SET approve_status = 'Approved' WHERE booking_id = $booking_id";
            if ($db->query($sqlUpdate) === TRUE) {
                echo "<script>
                        var amount = prompt('Please enter the approved amount:');
                        if (amount != null) {
                            window.location.href = 'update_amount.php?booking_id=$booking_id&amount=' + amount;
                        } else {
                            alert('Booking approved successfully.');
                        }
                      </script>";
            } else {
                echo "Error: " . $sqlUpdate . "<br>" . $db->error;
            }
        } elseif (isset($_POST["reject"])) {
    $booking_id = $_POST["reject"];

    // Perform SQL DELETE for rejected booking
    $sqlSelect = "SELECT * FROM booking WHERE booking_id = $booking_id";
    $result = $db->query($sqlSelect);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if entry with the same booking_id already exists in deleted_info
        $existingCheck = "SELECT * FROM deleted_info WHERE booking_id = $booking_id";
        $existingResult = $db->query($existingCheck);

        if ($existingResult->num_rows == 0) {
            // Insert the credentials into deleted_info table before deletion
            $sqlInsert = "INSERT INTO deleted_info (booking_id, username, auditorium_name, approve_status,amount)
                          VALUES ('{$row["booking_id"]}', '{$row["username"]}', '{$row["auditorium_name"]}', '{$row["approve_status"]}','{$row["auditorium_name"]}')";
            if ($db->query($sqlInsert) === TRUE) {
                // Delete the entry
                $sqlDelete = "DELETE FROM booking WHERE booking_id = $booking_id";
                if ($db->query($sqlDelete) === TRUE) {
                    echo "<script>
                            var confirmation = confirm('Booking rejected successfully. Do you want to delete this entry?');
                            if (confirmation) {
                                window.location.href = 'delete_booking.php?booking_id=$booking_id';
                            } else {
                                alert('Booking rejected successfully.');
                            }
                          </script>";
                } else {
                    echo "Error: " . $sqlDelete . "<br>" . $db->error;
                }
            } else {
                echo "Error: " . $sqlInsert . "<br>" . $db->error;
            }
        } else {
            echo "Entry with booking_id $booking_id already exists in deleted_info table.";
        }
    } else {
        echo "No booking found with the given ID.";
    }
}
    }

    // Fetch auditorium data from the table
    $sql = "SELECT B.booking_id, U.username, A.auditorium_name, B.approve_status FROM user_login U, booking B, auditorium A
            WHERE B.username=U.username AND B.auditorium_name=A.auditorium_name";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        echo "<table>";
        echo "<tr><th>Booking ID</th><th>Name</th><th>Auditorium Name</th><th>Approval Status</th><th>Approve</th><th>Reject</th><th>Delete</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["booking_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["auditorium_name"] . "</td>";
            echo "<td>" . $row["approve_status"] . "</td>";
            echo "<td>" . '<form method="POST"><button type="submit" name="approve" value="' . $row["booking_id"] . '" onclick="confirmApproval()" id="approveButton" class="approve-btn">Approve</button></form>' . "</td>";
            echo "<td>" . '<form method="POST"><button type="submit" name="reject" value="' . $row["booking_id"] . '" onclick="confirmReject()" id="rejectButton" class="reject-btn">Reject</button></form>' . "</td>";
echo "<td>" . '<form method="POST"><button type="submit" name="delete" value="' . $row["booking_id"] . '" onclick="confirmDelete()" class="reject-btn">Delete</button></form>' . "</td>";
            echo "</tr>";
        }

        echo "</table>";

    } else {
        echo "No users found.";
    }

    $db->close();
    ?>

    <br><br>
    <hr>

    <script>
        let menuicn = document.querySelector(".menuicn");
        let nav = document.querySelector(".navcontainer");

        menuicn.addEventListener("click", () => {
            nav.classList.toggle("navclose");
        });

        function confirmApproval() {
            confirm("Are you sure you want to approve?");
            // You can also pass the specific booking_id to the confirmAction function
        }

        function confirmReject() {
            confirm("Are you sure you want to reject?");
            // You can also pass the specific booking_id to the confirmAction function
        }

        function confirmDelete() {
            confirm("Are you sure you want to delete?");
            // You can also pass the specific booking_id to the confirmAction function
        }

        function displayConfirmation(message) {
            document.getElementById('confirmationText').innerText = message;
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function confirmAction() {
            // Disable the button to prevent multiple clicks
            document.getElementById('approveButton').disabled = true;
            document.getElementById('rejectButton').disabled = true;
            document.getElementById('deleteButton').disabled = true;
            // Close the modal
            document.getElementById('confirmationModal').style.display = 'none';
            // You might want to add additional logic or AJAX call for server interaction here
        }

        function cancelAction() {
            // Close the modal without taking any action
            document.getElementById('confirmationModal').style.display = 'none';
        }
    </script>

    
</body>
</html>
















