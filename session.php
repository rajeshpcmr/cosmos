<?php
// include('config.php');
// session_start();
// $user_check = $_SESSION['username'];
// $ses_sql = mysqli_query($db, "SELECT username FROM user_login WHERE username = '$user_check'");
// $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
// $login_session = $row['username'];
// if (!($_SESSION['login_user'])) {
//     header("location:/");
// }
session_start();
if(!isset($_SESSION['username'])){
    echo "session not started";
    exit();
}

?>
