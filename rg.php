<html>
<body>
<head>
    <link rel="stylesheet" href="rg.css">
<title>انشاء حساب</title>
</head>

<div class="container">
        <form class="form" method="POST">

            <p class="title">Sign up</p>
            <input name="username" placeholder="Username" class="username input" type="text">
            <input name="email" placeholder="Email" class="password input" type="email">
            <input name="password" placeholder="Password" class="password input" type="password">
            <button name="submit" class="btn" type="submit">sign up</button><br>
            <b>Already a member?</b> <a href="lg.php">Log in</a>
        </form>
    </div>

    <?php
    include("config.php");

    if(isset($_POST['submit']))
    {
        $uname = $_POST['username'];
        $pass =$_POST['password']; 
        $email =$_POST['email']; 
        if(!empty($uname) && !empty($pass)&& !empty($email))
        {
            $sqlcheck = "SELECT username FROM emp WHERE username = '$uname'";
            $resultcheck = mysqli_query($conn, $sqlcheck); 
            if (mysqli_num_rows($resultcheck) > 0)
                echo ("<h2>username already taken</h2>");
            else
            {
                $sql = "INSERT INTO emp(username,password,email)VALUES('$uname', '$pass', '$email')";
                $result = mysqli_query($conn, $sql);
                if ($result == TRUE)
                    header("location: lg.php");
                else echo "<h2>Save failed</h2>";
            }
        }
        else echo "<h2>username and password and email can't be empty</h2>";
    }
    mysqli_close($conn);
?>
</body></html>