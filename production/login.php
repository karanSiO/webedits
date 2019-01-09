<?php

include("connect.php");
session_start();

if(isset($_SESSION['sid'])){header('Location: http://training.coralearning.org/manage/data/production/');}
$flag=0;
if(isset($_POST['login']))
{
  $username=$_POST['username'];
  $password=$_POST['password'];
  
  /* below two commands are sql injection which stops extra characters as input */
  $user=$conn->real_escape_string($username);
  $pass=$conn->real_escape_string($password);
  $md5pass = md5($pass);
  
  $query="SELECT * FROM $database.admin_login where user_id='$user' AND password='$md5pass'"; 
  
  $result=$conn->query($query);
  
  $count=$result->num_rows;
  
  if($count==1) 
    /* $count checks if username and password are in same row */
  { 
    
    $_SESSION['sid']=session_id();
    $_SESSION['username']=$user;
    header('Location: http://training.coralearning.org/manage/data/production/');
  }
  else
  {
    $flag=1;
  }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CORA Learning</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form role="form" method="post" action="login.php">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" id="username" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="" />
              </div>
              <!-- Change this to a button or input when using this as a form -->
                                <button name="login" type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            <?php  
                                if($flag==1)
                                { ?>
                                  </br>
                                  <div class="form-group">
                                  <div class="alert alert-warning">
                      <strong>Invalid User Name / Password.</strong> 
                  </div>
                  </div>            
                                <?php
                                }
                                ?>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> CORA Learning</h1>
                  <p>©2017 All Rights Reserved by CORA Learning</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
