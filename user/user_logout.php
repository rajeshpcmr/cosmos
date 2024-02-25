<?php
if (isset($_POST['confirm_logout'])) {
    // Clear session variables
   $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page
    header("Location:../indexsql.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmos | Admin Logout</title>
    <link rel="icon" href="../images/cosmos.png">

    <style>
        body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    background-color: #f5f5f5;
}

.confirmation-box {
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

button, a {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    text-decoration: none;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button {
    background-color: #dc3545;
}

a {
    background-color: #28a745;
}
</style>
</head>
<body>
    <div class="confirmation-box">
        <h2>Are you sure you want to logout?</h2>
        <form method="post">
            <button type="submit" name="confirm_logout">Yes</button>
            <a href="admin_dashboard.php">No</a>
        </form>
    </div>
</body>
</html>
