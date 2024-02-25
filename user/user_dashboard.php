<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge"> 
    <meta name="viewport" 
          content="width=device-width,  
                   initial-scale=1.0">
    
    <title>Cosmos | User dashboard</title>
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
                        <h3> Dashboard</h3> 
                    </div>  
  
                     
  
                    <div style="background-color:#fff"class="nav-option option4"> 
                        <img src= "../images/auditoriums.png"
                            class="nav-img" 
                            alt="institution"> 
                        <a style="color:purple" href="./auditorium_list.php">Auditorium</a>
                    </div> 

                    <div style="background-color:#fff" class="nav-option option3"> 
                        <img src= "../images/booking.png"                            
                        class="nav-img" 

                            alt="report"> 
                        <a style="color:purple" href="./track_status.php">Track status</a>
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
                        <a style="color:purple" href="user_logout.php">Logout</a>
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
  
            <div class="box-container"> 
  
                <div class="box box1"> 
                    <div class="text"> 
                        <h2 class="topic-heading">10</h2> 
                        <h2 class="topic">Number of Auditoriums</h2> 
                    </div> 
                    <img src="../images/auditoriums.png">
                </div> 
  
                
  
                <div class="box box3"> 
                    <div class="text"> 
                        <h2 class="topic-heading">3.2k</h2> 
                        <h2 class="topic">Bookings</h2> 
                    </div> 
  
                    <img src= "../images/booking.png"
                        alt="comments"> 
                </div> 
  
                <div class="box box4"> 
                    <div class="text"> 
                        <h2 class="topic-heading">25</h2> 
                        <h2 class="topic">Events arranged</h2> 
                    </div> 
  
                    <img src= "../images/events.png">
                </div> 
            </div> 
  
            <div class="report-container"> 
              
                <div class="report-header"> 
                    <h1 class="recent-Articles">Auditorium List</h1> 
                    <button class="view">View All</button> 
                </div> 
  
                <div class="report-body"> 
                        <div ng-app="auditoriumApp" ng-controller="auditoriumController" class="auditorium-container">
        <!-- Auditorium List Table -->
        <h2>Auditorium List</h2>
        <table>
            <thead>
                <tr>
                    <th>Auditorium Name</th>
                    <th>Likes</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="auditorium in auditoriums">
                    <td>{{ auditorium.name }}</td>
                    <td>{{ auditorium.likes }}</td>
                    <td>{{ auditorium.comments }}</td>
                </tr>
            </tbody>
        </table>
    </div>

  
                </div> 
            </div> 
        </div> 
    </div>  
</body> 
 <script>
        var app = angular.module("auditoriumApp", []);
        app.controller("auditoriumController", function ($scope) {
            $scope.auditoriums = [
                { name: "Auditorium 1", likes: 100, comments: 20 },
                { name: "Auditorium 2", likes: 150, comments: 30 },
                { name: "Auditorium 3", likes: 120, comments: 25 },
                // Add more auditorium data as needed
            ];
        });
    </script>
<html>
<script>
let menuicn = document.querySelector(".menuicn"); 
let nav = document.querySelector(".navcontainer"); 
  
menuicn.addEventListener("click", () => { 
    nav.classList.toggle("navclose"); 
})
</script>