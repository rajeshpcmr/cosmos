<?php
include("../configsql.php");
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $password = md5($password);

    // Insert into register table
   $sqlRegister = $db->prepare("INSERT INTO user_register (firstname, lastname, username, phone,password) VALUES (?, ?, ?, ?, ?)");
$sqlRegister->bind_param("sssis", $firstname, $lastname, $username, $phone, $password);
$resultRegister = $sqlRegister->execute();


    if ($resultRegister) {
        // Registration successful
        echo '<script>alert("Registration successful. You can now login.");</script>';
        header("Location: ./user_login.php");
    } else {
        $error = "Error inserting into register table: " . $db->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmos | User Registration</title>
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
        <h2>User Registration</h2>
        <div class="inner-box">
        
    <form method="post" class="register-form">

        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="phone">Phone number:</label>
        <input type="number" id="phone" name="phone" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>

        </div>

        <div class="error"><?php echo $error; ?></div>
    </div>

</body>
</html>
