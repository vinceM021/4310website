<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
session_start();


//print "<pre> \$_POST = " . print_r($_POST, true) . "</pre><br>";
//print "<pre> \$_SESSION = " . print_r($_SESSION, true) . "</pre>";


// if user is logged in
if ( isset($_SESSION['USER']['user_id']) ) {
  if ( isset($_GET['logout']) ) {
    // logout user
    unset($_SESSION['USER']);
    header( 'Location: login.php');
    die();
  }
  // if yes then show volenteer page
  // die

  header( 'Location: homelog.php');
  die();
}

// if this is a _post
if (!empty($_POST)) {


//if this is the login post
  if ($_POST["state"] == "login") {
  // do  process login attempt
  //check db for username
      $user_data = db_get_user($_POST['email']);
      if (!$user_data) {
        // show error
        show_login_form("User does not exist.");
        die();
      }

    //print "<pre> \$user_data = " . print_r($user_data, true) . "</pre>";
    //var_dump($user_data);

    //check password
    if (password_verify($_POST["password"], $user_data["password"])) {
    // if login was sucessful
      //show sucess screen
      //die
      $_SESSION['USER'] = $user_data;

      header('Location: homelog.php');
      die();
    } else {
      // show error message
      //die
      show_login_form("Incorrect password.");
      die();
    }


  } else if ($_POST["state"] == "new") {
// if this is the start sign up post
  // show sign up form
  show_sign_up_form();
  die();
  // die
  } else if ($_POST["state"] == "sign up") {
// if this is the sign up information post
  //do process sgn up data

// check if user exsists
//check db for username
    $user_data = db_get_user($_POST['email']);
    if ($user_data) {
      // show error
      show_sign_up_form("You already have an account.");
      die();
    }
//insert into the database then show sucess
    // hash password
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    db_insert_user( $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $password_hash);
  // if sign up was sucessful
    //show sucess screen
    //die
    show_login_form("Your account has been created! Please log in.");
    die();
  // show error message
  //die
  }
}
//show login form
show_login_form();
die();
  //die


//show wtf error message
  //die



function show_login_form($error_message=false) {

  $alert_box = "";
  if (!empty($error_message)) {
    $alert_box = '<div class="alert alert-warning" role="alert">' . $error_message .'</div>';
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
        <h2>login Here</h2>

        <?= $alert_box ?>

        <form action="" method="post">
          <div class="form-group">
            <input type="hidden" name="state" value="login">
            <label>email address</label>
            <input type="text" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit"  class="btn btn-primary"> login </button>
        </form>

        <form action="" method="post">
            <input type="hidden" name="state" value="new">
          <button type="submit"  class="btn btn-primary"> sign up </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
  <?php
}

function show_sign_up_form($error_message=false) {

  $alert_box = "";
  if (!empty($error_message)) {
    $alert_box = '<div class="alert alert-warning" role="alert">' . $error_message .'</div>';
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
            <h2>Create an account</h2>

            <?= $alert_box ?>

            <form action="" method="post">
              <input type="hidden" name="state" value="sign up">

                <div class="form-group">
                    <label>first name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>last name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>phone number</label>
                    <input type="text" name="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>email address</label>
                    <input type="text" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit"  class="btn btn-primary"> Sign Up </button>
              </form>
            </div>
          </div>
        </div>
      </body>
  </html>
  <?php
}
