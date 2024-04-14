<?php
session_start();

if (!isset($_SESSION['admindata'])) {
    header("location: ../admin-login.html");
    exit(); // Ensure script execution stops after redirect
}

$userdata = $_SESSION['userdata'];
$groupdata = $_SESSION['groupdata'];

?>

<html>
<head>
    <title>Admin Dashboard</title>
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="main-section">
        <div id="header-section">
            <h1>Online Voting System - Admin Dashboard</h1>
            <a href="logout.php"><button class="btnlogout btn_admin">Logout</button></a>
        </div>
        <hr>
        <div class="admin_container">
        <div class="admin_user_data">
            <h2>User Data</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($userdata as $user) { ?>
                    <tr>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['mobile'] ?></td>
                        <td><?php echo $user['address'] ?></td>
                        <td><?php echo ($user['status'] == 0) ? '<b style="color:red">Not Voted</b>' : '<b style="color:green">Voted</b>'; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div id="Group">
            <h2 id="agd">Candidate Data</h2>
            <table id="gr_data">
                <tr>
                    <th>Candidate Name</th>
                    <th>Votes</th>
                </tr>
                <?php foreach ($groupdata as $group) { ?>
                    <tr>
                        <td><?php echo $group['name'] ?></td>
                        <td><?php echo $group['votes'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        </div>
        
    </div>
</body>
</html>
