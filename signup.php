<?php 
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'condatabase.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $existSql = "SELECT * FROM `signup` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        echo "<script>alert('Email Already Exists');</script>";
        include 'index.php';
    }
    else{
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `signup` (`username`, `email`, `password`) VALUES ( '$username', '$email', '$hash');";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $createtable ="CREATE TABLE $username (dt DATE PRIMARY KEY, studytimecount INT(20), breaktimecount INT(20));";
               $results = mysqli_query($conn,$createtable);
                header("Location: index.php");
            }   
        }
        else{
             echo "<script>alert('Passwords do not match!');</script>";
             include 'index.php';
        }
    }
}
?>

