<?php 

include("connect.php");

$name = $_POST["name"];
$mobile = $_POST["mobile"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
$address = $_POST["address"];
$image = $_FILES['photo']['name'];    
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($role == 1) {
    $table = 'voters';
} elseif ($role == 2) {
    $table = 'groups';
}

if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../uploads/$image");
    $insert = mysqli_query($connect, "INSERT INTO $table (name, mobile, address, password, photo, role, status, votes) VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)");
    if ($insert) {
        echo '
            <script>
                alert("Registration Successful!");
                window.location = "../";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("An error was encountered while registration. Please try again.");
                window.location = "../routes/register.html";
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("One of the provided password does not match the other");
            window.location = "../routes/register.html";
        </script>
    ';
}

?>
