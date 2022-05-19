<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "kurt", "angle", "volunteers");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
$date1 = $_REQUEST['date'];
if($date1) {
    $date1 = date( 'Y-m-d', strtotime($date1));
} else {
    $date1 = '';
}
echo $date1;
// Attempt insert query execution
$sql = "INSERT INTO volunteer_info (first_name, last_name, birth_date) VALUES ('$first_name', '$last_name', '$date1')";
if(mysqli_query($link, $sql)){
    header('Location: volunteer.php');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>