<?php
require_once './class.user.php'; 

$user = new User();


if (isset($_POST['uname'])) {

$user_name = $user->safe($_POST['uname']);      
$user_name = filter_var( $_POST['uname'], FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM users WHERE u_name='$user_name'";
$result = $user->db->query($sql);

//$result = mysqli_stmt_get_result($q);


//if (mysqli_num_rows($result) === 0) {
    if ($result->rowCount() === 0) {
    echo "<span class='available text-success'>&nbsp;&#x2714; " .
"This Username is available</span>";

} else {
    echo "<span class='taken text-danger'>&nbsp;&#x2718; " .
    "This Username is taken</span>";
}
}
?>