<?php
include("../configsql.php");
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_login WHERE username = '$username' AND password = '$password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to user dashboard or home page
        header("Location: admin_dashboard.php");
    } else {
         echo '<script>alert("Invalid username or password");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmos | Admin login</title>
    <link rel="icon" href="../images/cosmos.png">
    <style>
        
    body {
    font-family: Arial, sans-serif;
    background: url('../images/loginbg.jpg') center/cover;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
    text-align: center;
    background-color: rgba(255, 255, 255, 0.8); /* Background color with opacity */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Box shadow for a subtle lift */
}

h2 {
    margin-bottom: 20px;
}

form {
    width: 300px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 10px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    background-color: #1c0cef;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0d083e;
}

.error {
    color: #ff0000;
    margin-top: 10px;
}

    </style>
</head>
<body>

    <div class="container">
    <h2>Admin Login</h2>
    <div class="inner-box">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

    <div class="error"><?php echo $error; ?></div>
</div>


</body>
</html>
