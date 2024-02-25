<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmos | Role</title>
    <link rel="icon" href="./images/cosmos.png">
    <style>

    

        body {

            font-family: Arial, sans-serif;
            background: url('./images/loginbg.jpg') center/cover;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .user-selection {
            display: flex;
            justify-content: space-between;
            width: 200px;
        }

        .user-box {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            flex: 1;
            margin: 0 10px;
        }

        p {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        button {
            width: 100%;
            background-color: blue;
            color: #fff;
            padding: 20px 70px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome to COSMOS Auditorium Booking</h2>
        <center><p>Login as : </p></center>
        <div class="user-selection">
            
            <br>
            <div style="align-content-center" class="user-box">
                
                <button onclick="location.href='admin/admin_login.php'">Admin</button>
            </div>

            <div class="user-box">
                <button onclick="location.href='user/user_login.php'">User</button>
            </div>
        </div>
    </div>

</body>
</html>
