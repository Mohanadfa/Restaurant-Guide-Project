<html>
<body>

<head>
    <link rel="stylesheet" href="lg.css">
<title>تسجيل دخول</title>
</head>

<div class="container">
        <form class="form" method="POST">

            <p class="title">Login</p>
            <input name="user" placeholder="Uesername" class="username input" type="text">
            <input name="pass" placeholder="Password" class="password input" type="password">
            <button name="submit" class="btn" type="submit">Login</button><br>
            <b>Have not an account yet?</b> <a href="rg.php">Sign Up</a>
        </form>
    </div>
<?php
    include("config.php");
    session_start();
    if(isset($_POST['submit']))
    {

        $user = $_POST['user'];
        $pass =$_POST['pass']; 
        if(!empty($user) && !empty($pass))
        {
            $sql = "SELECT username,password FROM emp WHERE 
            username = '$user' and password = '$pass'";
            $result=mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) == 1)
            {
                $_SESSION['login_user'] = $user;
                header("location: welcome_name.php");
            }
            else 
                echo "<h2>Your Login username or Password is invalid</h2>";

        }
        else echo "<h2>username and password can't be empty</h2>";
    }
    mysqli_close($conn);
?>
</body>
</html>