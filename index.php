<?php
$insert=false;
if(isset($_POST['name'])){
    //set connections variable 
$server  = "localhost";
$username = "root";
$password = "";
//create a database connection 
$con = mysqli_connect($server, $username, $password);
//check for connection success 
if (!$con){
    die("connection to this database failed due to ".
    mysqli_connect_error());
}
        echo "success connecting to the db";
        //collect post variable 
        $name =$_POST['name'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $desc = $_POST['desc'];
$sql =  "INSERT INTO `trip US `.'trip' (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES ('$name','$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";

    //echo $sql;
    //execute the query 
    if ($con->query($sql)== true){
        // echo"successfully inserted";
        //flag for successful insertion 

        $insert=true;

    }
    else {
        echo "ERROR: $sql <br> $con->error";
    }
    //close the database connection 
    $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to travel form </title>
    <link href="https://fonts.google.com/specimen/Alan+Sans" rel="stylesheet">  
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="bg.jpg" alt="IIT kharagpur"></img>
    <div class ="container">
        <h1>Welcome to Hacker's Throne </h1>
        <p> Enter  your details and submit this form  to confirm your participation in the hackathon </p>
        <?php
        if ($insert==true ){
         echo "<p class='submitmsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip with us </p>";
        }
        ?>
        <form action ="index.php" method="post">
            <input type ="text" name=" name " id="name" placeholder ="Enter your name">
            <input type ="text" name="age" id="age" placeholder ="Enter your age">
            <input type ="text" name=" gender " id="gender" placeholder ="Enter your gender">
            <input type ="text" name=" email " id="email" placeholder ="Enter your email">
            <input type ="text" name=" phone " id="phone" placeholder ="Enter your phone">
            <textarea name ="desc" id="desc" cols="30" rows="10" placeholder="Enter more  information here. We are happy to help you :)"></textarea>
            <button class="btn">Submit</button>
             <!-- <button class="btn">Reset</button> -->

        </form>
    </div>
    <script src="index.js"></script>
   
</body>
</html>
