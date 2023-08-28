<?php
session_start(); // magic word to start a session.
include("includes/db.php");
if (isset($_POST['Create'])) {
    $nickname = mysqli_real_escape_string($con,$_POST['nickname']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $get_email = "SELECT * FROM users WHERE email='$email'";
    $run_email = mysqli_query($con, $get_email);
    $count = mysqli_num_rows($run_email);
    if ($count>0) {
        echo "<script>alert('Email is aleady existed!')</script>";
    }
    else{
        $pass = mysqli_real_escape_string($con,$_POST['pass']);
        $pass_ = mysqli_real_escape_string($con,$_POST['pass_']);
        if($_POST['pass']!=$_POST['pass_']) 
        {
            echo "<script>alert('Please reinput your password!')</script>";
        }
        else{
            $role = mysqli_real_escape_string($con,$_POST['role']);
            if($_POST['role']!='admin'&&$_POST['role']!='customer'){
                echo "<script>alert('Please input valid role: admin or customer!')</script>";
            }
            else{
                $gender = mysqli_real_escape_string($con,$_POST['gender']);
                if($_POST['gender']!='male'&&$_POST['gender']!='female'){
                    echo "<script>alert('Please input valid gender!')</script>";
                }
                else{
                    $number = mysqli_real_escape_string($con,$_POST['number']);
                    //INSERT INTO `users` (`id`, `nickname`, `email`, `pwd`, `role`, `gender`, `phone`, `fav_list`) VALUES (NULL, 'hh', 'shopowner1@qq.com', '123', 'shop owner', 'male', '123456', NULL);
                    $get_user = "insert ignore into product_category(nickname, email, pwd, role, gender, phone )values('$nickname','$email','$pass','$role','$gender','$number')";
                    $run_user = mysqli_query($con, $get_user);
                    $count = mysqli_num_rows($run_user);
                    if ($count==1) {
                        $_SESSION['can302'] = $email; 
                        $row_admin = mysqli_fetch_array($run_user);
                        session_regenerate_id();
                        echo "<script>alert('Create ".$row_user['nickname']."!')</script>";
                        echo "<script>window.open('login.php','_self')</script>";
                    }
                    else{
                        echo "<script>alert('There is something Wrong!')</script>";
                    }
                }
                

            }
           
        }
        
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link rel="stylesheet" href="/can302/styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="/can302/font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/can302/styles/style.css">
    <script src="/can302/js/jquery-331.min.js"></script>
    <script src="/can302/js/bootstrap-337.min.js"></script>
</head>

<body>
    <div class="col-lg-2" style="text-align:center"><!-- container begin -->
    </div>
    <div class="col-lg-8" style="text-align:center"><!-- container begin -->
        <form action="" class="well" method="Post"><!-- form begin -->
            <h2 class="form-login-heading text-center"> Register Page </h2>
            <br>
            <input type="text" class="form-control" placeholder="NickName" name="nickname" required>
            <br>
            <input type="text" class="form-control" placeholder="Email Address" name="email" required>
            <br>
            <input type="password" class="form-control" placeholder="Your Password" name="pass" required>
            <br>
            <input type="password" class="form-control" placeholder="Corfirm Your Password" name="pass_" required>
            <br>
            <input type="text" class="form-control" placeholder="Administrator or Customer" name="role" required>
            <br>
            <input type="text" class="form-control" placeholder="Male or Female" name="gender" required>
            <br>
            <input type="int" class="form-control" placeholder="Phone Number" name="number" required>
            <br>
            <a href="login.php"><button class="btn btn-primary" type="button" name="Back">Back</button></a>
            <button class="btn btn-primary" type="submit" name="Create">Create</button>
            
        </form><!-- form finish -->
    </div><!-- container finish --> 
</body>
</html>
