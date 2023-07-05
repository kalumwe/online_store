<?php
require_once './class.user.php'; 

$user = new User();


if (isset($_POST['uemail'])) {

$email = $user->safe($_POST['uemail']);      
$email = filter_var( $_POST['uemail'], FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $user->db->query($sql);

//$result = mysqli_stmt_get_result($q);


//if (mysqli_num_rows($result) === 0) {
    if ($result->rowCount() === 0) {
    echo "<span class='available text-success'>&nbsp;&#x2714; " .
"This email is available</span>";

} else {
    echo "<span class='taken text-danger'>&nbsp;&#x2718; " .
    "This email is taken</span>";
}
}
?>