<?php
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];    
    if(!empty($name) || !empty($number) || !empty($email) || !empty($password) || !empty($repassword)){
        $host ="localhost";
    $dbUsername= "root";
    $dbPassword= "";
    $dbname="test";
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('Connection Failed ('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT ="SELECT email from registration where email = ? LIMIT 1";
        $INSERT= "INSERT into registration (name,number,email,password,repassword) values(?,?,?,?,?);

        $stmt= $conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
    
        if($rnum==0){
            $stmt->close();

            $stmt= $conn->prepare($INSERT);
            $stmt->bind_param("sisss", $name, $number, $email, $password, $repassword);
            $stmt->execute();
            echo "successfully registered";
        }else{
            echo "already registered";
        } 
        $stmt->close();
        $conn->close(); 
    }
}else{
        echo "All fields are required";
        die();
    }
  
?>
      
    