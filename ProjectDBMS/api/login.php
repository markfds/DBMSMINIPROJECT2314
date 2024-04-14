<?php
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];


if ($role == 1) {
    $check = mysqli_query($connect, "SELECT * FROM voters WHERE mobile = '$mobile' AND password = '$password'");
} elseif ($role == 2) {
    $check = mysqli_query($connect, "SELECT * FROM groups WHERE mobile = '$mobile' AND password = '$password'");
}

if (mysqli_num_rows($check) > 0) {

    $userdata = mysqli_fetch_array($check);
    $_SESSION['userdata'] = $userdata;

    $groups = mysqli_query($connect, "SELECT * FROM groups WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
     $_SESSION['groupsdata'] = $groupsdata; 


    echo '
    <script>
    alert("Welcome Voter!");
        window.location = "../routes/dashboard.php";
    </script>
    ';
} else {
    echo '
            <script>
                alert("Data breached! Intruder alert!");
                window.location = "../ ";
            </script>
        ';
}

?>