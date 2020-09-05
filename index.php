<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login/Registration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style>
        body {
    margin-left: 30%;
    color: #6a6f8c;
    background: #c8c8c8;
    font: 400 16px/18px 'Open Sans', sans-serif;
    
}

.login-box {
    width: 100%;
    margin: auto;
    max-width: 525px;
    min-height: 670px;
    position: relative;
    box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19)
}

.login-snip {
    width: 100%;
    height: 100%;
    position: absolute;
    padding: 90px 70px 50px 70px;
    background: rgba(0, 77, 77, .9)
}

.login-snip .login,
.login-snip .sign-up-form {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    position: absolute;
    transform: rotateY(180deg);
    backface-visibility: hidden;
    transition: all .4s linear
}

.login-snip .sign-in,
.login-snip .sign-up,
.login-space .group .check {
    display: none
}

.login-snip .tab,
.login-space .group .label,
.login-space .group .button {
    text-transform: uppercase
}

.login-snip .tab {
    font-size: 18px;
    margin-right: 15px;
    padding-bottom: 5px;
    margin: 0 15px 10px 0;
    display: inline-block;
    border-bottom: 2px solid transparent
}

.login-snip .sign-in:checked+.tab,
.login-snip .sign-up:checked+.tab {
    color: #fff;
    border-color: #1161ee
}

.login-space {
    min-height: 345px;
    position: relative;
    perspective: 1000px;
    transform-style: preserve-3d
}

.login-space .group {
    margin-bottom: 15px
}

.login-space .group .label,
.login-space .group .input,
.login-space .group .button {
    width: 100%;
    color: #fff;
    display: block
}

.login-space .group .input,
.login-space .group .button {
    border: none;
    padding: 15px 20px;
    border-radius: 25px;
    background: rgba(255, 255, 255, .1)
}

.login-space .group input[data-type="password"] {
    text-security: circle;
    -webkit-text-security: circle
}

.login-space .group .label {
    color: #aaa;
    font-size: 12px
}

.login-space .group .button {
    background: #1161ee
}

.login-space .group label .icon {
    width: 15px;
    height: 15px;
    border-radius: 2px;
    position: relative;
    display: inline-block;
    background: rgba(255, 255, 255, .1)
}

.login-space .group label .icon:before,
.login-space .group label .icon:after {
    content: '';
    width: 10px;
    height: 2px;
    background: #fff;
    position: absolute;
    transition: all .2s ease-in-out 0s
}

.login-space .group label .icon:before {
    left: 3px;
    width: 5px;
    bottom: 6px;
    transform: scale(0) rotate(0)
}

.login-space .group label .icon:after {
    top: 6px;
    right: 0;
    transform: scale(0) rotate(0)
}

.login-space .group .check:checked+label {
    color: #fff
}

.login-space .group .check:checked+label .icon {
    background: #1161ee
}

.login-space .group .check:checked+label .icon:before {
    transform: scale(1) rotate(45deg)
}

.login-space .group .check:checked+label .icon:after {
    transform: scale(1) rotate(-45deg)
}

.login-snip .sign-in:checked+.tab+.sign-up+.tab+.login-space .login {
    transform: rotate(0)
}

.login-snip .sign-up:checked+.tab+.login-space .sign-up-form {
    transform: rotate(0)
}

*,
:after,
:before {
    box-sizing: border-box
}

.clearfix:after,
.clearfix:before {
    content: '';
    display: table
}

.clearfix:after {
    clear: both;
    display: block
}

a {
    color: inherit;
    text-decoration: none
}

.hr {
    height: 2px;
    margin: 60px 0 50px 0;
    background: rgba(255, 255, 255, .2)
}

.foot {
    text-align: center
}

.card {
    width: 500px;
    left: 100px
}

::placeholder {
    color: #b3b3b3
}
    </style>
    </head>
    <body>
        <?php
        require_once "connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset( $_POST['register']) ) {

                 $username = stripslashes($_REQUEST['username']);
        
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con,  trim($_POST["username"]));
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con,  trim($_POST["email"]));
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,  trim($_POST["password"]));
        $create_datetime = date("Y-m-d H:i:s");
         $sql = "SELECT * FROM `users` WHERE username='$username' OR email = '$email'";
        $res = mysqli_query($con, $sql) ;
        $rows = mysqli_num_rows($res);
        
        if ($rows >= 1) { 

            $resultStatement="You are already a member please login.";
        }else{
                $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {

             $resultStatement="You are registered successfully.";
        } else {

             $resultStatement="Required fields are missing.";
        }
        }
            }
             else if( $_POST['signin'] ) {
                 if (isset($_POST['user'])) {
        $username = stripslashes($_REQUEST['user']);    // removes backslashes
        $username = mysqli_real_escape_string($con, trim($_POST["user"]));
        $password = stripslashes($_REQUEST['pass']);
        $password = mysqli_real_escape_string($con, trim($_POST["pass"]));
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {

             $resultStatement="You are logged in successfully.";
        } else {

            $resultStatement="Incorrect Username/password. Try loggin again";
        }
    }
        }
        }
        ?>
        <div class="row">
    <div class="col-md-6 mx-auto p-0">
        <div class="card">
            <div class="login-box">
                
                <div class="login-snip"> 
                    <h5 style="color:white;text-align:center;"> 
                        <?php if(isset($resultStatement)){
                        echo $resultStatement; }
                        ?>
                </h5>
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                    <label for="tab-1" class="tab">Login</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up">
                    <label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-space">
                        <div class="login">
                            <form id="login" action="" method="post">
                            <div class="group"> <label for="user" class="label">Username</label> <input id="user" name="user" type="text" class="input" placeholder="Enter your username"> </div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" name="pass" type="password" class="input" data-type="password" placeholder="Enter your password"> </div>
                            <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                            <div class="group"> <input type="submit" name="signin" class="button" value="Sign In"> </div>
                            <div class="hr"></div>
                            </form>
                        </div>
                        <div class="sign-up-form">
                            <form id="register" action="" method="post">
                                <div class="group"> <label for="user" class="label">Username</label> <input id="user" name="username" type="text" class="input" placeholder="Create your Username" required> </div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" name="password" type="password" class="input" data-type="password" placeholder="Create your password" required> </div>
                            <!--<div class="group"> <label for="pass" class="label">Confirm Password</label> <input id="pass" name="pass" type="password" class="input" data-type="password" placeholder="confirm your password"> </div>-->
                            <div class="group"> <label for="email" class="label">Email Address</label> <input id="email" name="email" type="email" class="input" placeholder="Enter your email address" required> </div>
                            <div class="group"> <input type="submit" name="register" class="button" value="Register"> </div>
                            <div class="hr"></div>
                            <div class="foot"> <label for="tab-1">Already Member?</label> </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
