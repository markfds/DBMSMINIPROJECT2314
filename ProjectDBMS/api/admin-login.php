<?php
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];

    $checkadmin = mysqli_query($connect, "SELECT * FROM admins WHERE mobile = '$mobile' AND password = '$password'");
    $checkuser = mysqli_query($connect, "SELECT * FROM voters");
   
$userdata = array();

// Check if the query was successful
if ($checkuser) {
    // Fetch each row of data and store it in the $groupdata array
    while ($row = mysqli_fetch_assoc($checkuser)) {
        $userdata[] = $row;
    }
} else {
    // Handle the case where the query fails
    // You can set $groupdata to an empty array or handle the error as needed
    $userdata = array();
}
$_SESSION['userdata'] = $userdata;

$checkgrp = mysqli_query($connect, "SELECT * FROM groups");
// Initialize an empty array to store group data
$groupdata = array();

// Check if the query was successful
if ($checkgrp) {
    // Fetch each row of data and store it in the $groupdata array
    while ($row = mysqli_fetch_assoc($checkgrp)) {
        $groupdata[] = $row;
    }
} else {
    // Handle the case where the query fails
    // You can set $groupdata to an empty array or handle the error as needed
    $groupdata = array();
}

$_SESSION['groupdata'] = $groupdata;

if (mysqli_num_rows($checkadmin) > 0) {

    $admindata = mysqli_fetch_array($checkadmin);
    $_SESSION['admindata'] = $admindata;


    echo '
    <script>
    alert("You Again???");
        window.location = "../routes/admin.php";
    </script>
    ';
} else {
    echo '
            <script>
                alert("Theif Theif Theif");
                window.location = "../ ";
            </script>
        ';
}

?>