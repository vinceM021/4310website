<?php
// follows this guide https://phpdelusions.net/pdo

require_once 'config.php';

// Connect to the MySQL Database
function get_dbpdo() {
    $host = DB_HOST;
    $db   = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASSWORD;
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
         $pdo = new PDO($dsn, $user, $pass, $options);
         return $pdo;
    } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}


// get user info based on email address - will return array or false if not in db
function db_get_user($email) {
    $pdo =  get_dbpdo();

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    return $user;
}

// get user info based on jobs - will return array or false if not in db
function db_get_jobs() {
    $pdo =  get_dbpdo();

    $stmt = $pdo->prepare('SELECT * FROM jobs');
    $jobs = $stmt->fetch();

    return $jobs;
}

// adds new user to the users table
function db_insert_user($email, $first_name, $last_name, $phone_number, $password) {
    $pdo =  get_dbpdo();

    $stmt = $pdo->prepare('insert into users (first_name, last_name, email, phone_number, password) values (:first_name, :last_name, :email, :phone_number, :password)');
    $stmt->execute(['email' => $email, 'first_name' => $first_name, 'last_name' => $last_name, 'phone_number' => $phone_number, 'password' => $password]);
}
