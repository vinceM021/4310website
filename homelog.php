<?php
session_start();

// if user is logged in
$logged_in = false;
if ( isset($_SESSION['USER']['user_id']) ) {
  $logged_in = true;
}

?>
<html>
<head>
  <title> Volunteer login and registration </title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>Hello, this is the start page!</h1>
<?php
 if ($logged_in) {
   // user is logged in
   print "<h2>Hello " . $_SESSION['USER']['first_name'] . ", welcome back!</h2>";
   print "<p> You are logged in. </p>";
   print "<p> <a href='login.php?logout=1'>Click here to log out</a></p>";
 } else {
   // user is not logged in
   print "<p> <a href='login.php'>Click here to log in</a></p>";
 }
 ?>
    </div>
  </div>
</div>
</body>
</html>
