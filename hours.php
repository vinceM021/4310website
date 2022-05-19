<head>
    <title>Volunteer Main Page</title>
    <meta charset="UTF-8">
</head>

<body>
    <?php
            include("database.php");
            $servername = "localhost";
            $username = "kurt";
            $password = "angle";
            $dbname = "volunteers";



            $conn = new mysqli($servername, $username, $password, $dbname);
            echo "<h2> Hour Log Verification Page </h2>";
            if($conn->connect_error){
              die("Connection failed: ". $conn->connect_error);
            }
           

                $volId = $_REQUEST['VolID'];
                $date = $_REQUEST['Date'];
                $timeIn = $_REQUEST['TimeIn'];
                $timeOut = $_REQUEST['TimeOut'];
                $TaskID = $_REQUEST['TaskID'];

                $sql = "INSERT INTO volunteer_hours (vol_id, curr_date, time_in, time_out, task_id) VALUES ('$volId', '.$date', '$timeIn', '$timeOut', '$TaskID')" ;
                
                if($conn->query($sql) === TRUE){
                  echo "<p> Successfully updated ".mysqli_affected_rows($conn)." record(s). </p>";
                  echo "<p> <a href='volunteer.php'>Click here to return to the volunteers page</a></p>";
                }
                else{ 
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
    ?>          

</body>

