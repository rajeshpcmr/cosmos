<?php
include("../configsql.php");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "username" key is set in the $_POST array
    if (isset($_POST["username"])) {
        // Get values from the form
        $username = $_POST["username"];
        $currentPassword = $_POST["currentPassword"];
        $newPassword = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        // Check if the current password matches the one in the database
        $sql = "SELECT password FROM admin_login WHERE username = '$username'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row["password"];

            if (password_verify($currentPassword, $storedPassword)) {
                // Current password is correct, proceed to update the password
                if ($newPassword == $confirmPassword) {
                    // Hash the new password
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Update the password in the database
                    $updateSql = "UPDATE admin_login SET password = '$hashedPassword' WHERE username = '$username'";

                    if ($db->query($updateSql) === TRUE) {
                        echo "Password updated successfully";
                    } else {
                        echo "Error updating password: " . $db->error;
                    }
                } else {
                    echo "New password and confirm password do not match";
                }
            } else {
                echo "Current password is incorrect";
            }
        } else {
            echo "Username not found";
        }
    } else {
        echo "Username not set in the form";
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmos | Change Password</title>
    <link rel="icon" href="../images/cosmos.png">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form action="change_password.php" method="post" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="currentPassword">Current Password:</label>
            <input type="password" name="currentPassword" required><br>

            <label for="newPassword">New Password:</label>
            <input type="password" name="newPassword" id="newPassword" required><br>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required><br>

            <input type="submit" value="Change Password">
        </form>
    </div>

    <script>
        function validateForm() {
            var newPassword = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (newPassword !== confirmPassword) {
                alert("New password and confirm password do not match!");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
