<?php
session_start();
include("connect.php");

// Get vote details
$votes = $_POST['gvotes'];
$total_votes = $votes + 1;
$id = $_POST['gid'];
$role = $_SESSION['userdata']['role'];


// Update votes based on role


    $update_votes = mysqli_query($connect, "UPDATE groups SET votes = '$total_votes' WHERE id = '$id' ") or die(mysqli_error($connect));


$uid = $_SESSION['userdata']['id'];

// Update user status
if($role==1 and  $update_votes)
{
    $table='voters';
    $update_user_status = mysqli_query($connect, "UPDATE $table SET status = 1 WHERE id = '$uid' ") or die(mysqli_error($connect));

}
elseif($role==2 and  $update_votes){
    $table='groups';
    $update_user_status = mysqli_query($connect, "UPDATE $table SET status = 1 WHERE id = '$uid' ") or die(mysqli_error($connect));
}


if ($update_votes and $update_user_status) {
    // Fetch updated group data
    $groups = mysqli_query($connect, "SELECT id, name, votes, photo FROM groups");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    echo '
            <script>
                alert("Voting successful!");
                window.location = "../routes/dashboard.php";
            </script>
    ';

} else {
    echo '
            <script>
                alert("An error was encountered while voting. Please try again.");
                window.location = "../routes/dashboard.php";
            </script>
    ';
}

?>
