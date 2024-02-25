<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge"> 
    <meta name="viewport" 
          content="width=device-width,  
                   initial-scale=1.0">
    
    <title>Cosmos | Admin dashboard</title>
    <link rel="icon" href="../images/cosmos.png">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

   
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../styles/admindb.css">
<body> 
    
    <!-- for header part -->
    <header> 
  
        <div class="logosec"> 
            <div class="logo">Cosmos</div> 
            <img src= "../images/toggle.png"
                class="icn menuicn" 
                id="menuicn" 
                alt="menu-icon"> 
        </div> 
  
        <div class="searchbar"> 
            <input type="text" 
                   placeholder="Search"> 
            <div class="searchbtn"> 
              <img src= "../images/search.png"
                    class="icn srchicn" 
                    alt="search-icon"> 
              </div> 
        </div> 
  
        <div class="message"> 
            <div class="circle"></div> 
            <img src= "../images/notification.png"
                 class="icn" 
                 alt=""> 
            <div class="dp"> 
              <img src= "../images/profile.png"
                    class="dpicn" 
                    alt="dp"> 
              </div> 
        </div> 
  
    </header> 
  
    <div class="main-container"> 
        <div class="navcontainer"> 
            <nav class="nav"> 
                <div class="nav-upper-options"> 
                    <div class="nav-option option1"> 
                        <img src= "../images/dashboard.png"
                            class="nav-img" 
                            alt="dashboard"> 
                        <a style="color:white; text-decoration:none"href="./admin_dashboard.php"><h3> Dashboard</h3> 
                    </div>  
  
                    <div style="background-color:#fff" class="nav-option option3"> 
                        <img src= "../images/booking.png"                            
                        class="nav-img" 

                            alt="report"> 
                        <a style="color:purple" href="./admin_booking_management.php">Management</a>
                    </div> 
  
                    <div style="background-color:#fff"class="nav-option option4"> 
                        <img src= "../images/auditoriums.png"
                            class="nav-img" 
                            alt="institution"> 
                        <a style="color:purple" href="./auditorium.php">Auditorium</a>
                    </div> 
  
                    <div style="background-color:#fff" class="nav-option option5"> 
                        <img src= "../images/users.png"
                            class="nav-img" 
                            alt="blog"> 
                        <a style="color:purple" href="./user_management.php">Users</a>
                    </div> 
  
                    <div style="background-color:#fff" class="nav-option option6"> 
                        <img src= "../images/password.png"                            class="nav-img" 
                            alt="settings"> 
                        <a style="color:purple" href="../change_password.php">Password</a>
                    </div> 
  
                    <div style="background-color:#fff;"class="nav-option logout"> 
                        <img src="../images/logout.png"
                            class="nav-img" 
                            alt="logout"> 
                        <a style="color:purple" href="admin_logout.php">Logout</a>
                    </div> 

                    <div style="background-color:#fff;"class="nav-option logout"> 
                        <img src="../images/settings.png"
                            class="nav-img" 
                            alt="logout"> 
                        <a style="color:purple" href="settings.php">Settings</a>
                    </div>
  
                </div> 
            </nav> 
        </div> 
        <div class="main"> 
  
            <div class="searchbar2"> 
                <input type="text" 
                       name="" 
                       id="" 
                       placeholder="Search"> 
                <div class="searchbtn"> 
                  <img src= "../images/search2.png"
                        class="icn srchicn" 
                        alt="search-button"> 
                  </div> 
            </div> 
  
             
  
            <div class="report-container"> 
              
                <div class="report-header"> 
                    
                </div> 
  
                <div class="report-body"> 
        <!-- Auditorium List Table -->
        <h2>User detail List</h2>
<?php
include("../configsql.php");

$usersPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $usersPerPage;

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch auditorium data from the table
$sql = "SELECT * FROM user_register LIMIT $offset, $usersPerPage";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>User Name</th><th>First Name</th><th>Last Name</th><th>Phone</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
        $totalPages = ceil($result->num_rows / $usersPerPage);

        echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i'>$i</a>";
    }
    echo "</div>";
} else {
    echo "No users found.";
}

$db->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Display Use details</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}


    </style>
    <style>
    .pagination {
        display: flex;
        margin-top: 20px;
    }

    .pagination a {
        padding: 10px;
        margin-right: 5px;
        text-decoration: none;
        background-color: #4caf50;
        color: white;
        border-radius: 5px;
    }
</style>

</head>
<!-- <body>
    <div class="container">
        <h2>Auditorium Details</h2>
        <?php include("user_register.php"); ?>
    </div>
</body> -->
</html>

    

  
                </div> 
            </div> 
        </div> 
    </div>  
</body> 

<html>
<script>
let menuicn = document.querySelector(".menuicn"); 
let nav = document.querySelector(".navcontainer"); 
  
menuicn.addEventListener("click", () => { 
    nav.classList.toggle("navclose"); 
})
</script>