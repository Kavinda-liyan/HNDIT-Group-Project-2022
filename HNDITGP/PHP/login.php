<?php
$email = $_POST['email'];
$userpassword =$_POST['userpassword'];

    $host ="localhost";
    $dbUsername ="root";
    $dbPassword ="";
    $dbname ="crystaltech";

    //create connection...
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    $select_user="SELECT * FROM userreg WHERE email='$email'";
    $run_qry=mysqli_query($conn,$select_user);
    if (mysqli_num_rows($run_qry)>0){
        while ($row=mysqli_fetch_assoc($run_qry)){
            if(password_verify('$userpassword',password_hash($_POST['userpassword'], PASSWORD_DEFAULT))){
                echo '<script>alert("Login Successfully!")</script>';
                die();
            }
            else{
                echo '<script>alert("Incorrect Email or Password!")</script>';
                die();

            }

        }
    }

?>