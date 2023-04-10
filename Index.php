<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Main Login</title>
 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE </title>
    <link rel="icon" type="image/x-icon" href="favicon9.ico">
    <!-- <link rel="stylesheet" href="StyleSheet.css"> -->
    <!--Stylesheet-->
    <style media="screen">
      *,*:before,*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
a{
    text-decoration :none ;
}
.ereure{
    color: red;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(#1845ad, #23a2f6);
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(to right,#ff512f,#f09819);
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
input[type="submit"]{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.test:hover {
    background-color: gray;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
/* .social .fb{
background-color: white ;
  margin-left: 25px;
  cursor: pointer;
  color:black;
} */
.social .go{
    background-color: white ;
    font-weight:600;
    font-size:18px;
  margin-right: 4px;
  cursor: pointer;
  color:black;
}
.social .go:hover
{   
     background-color: blue;
}
.social .fb:hover
{   
     background-color: orange;
}
.sosial button[type="submit"]
{    border:10px;
    border-color:black;
    
}
    </style>
</head>
<body>
<?php
    $eror='';

    if($_SERVER['REQUEST_METHOD']== 'POST')
     {
            if((isset($_POST["username"])&&isset($_POST["password"])))
         {
            $username = trim(htmlspecialchars($_POST["username"]));
            $password = trim(htmlspecialchars($_POST["password"]));
            $data = array();
            $AllUsersData = fopen("UserData\ForAll\AllUsersID&Usernams&Passwords.txt","r");
            
            while (!feof($AllUsersData))
            {
                $line = fgets($AllUsersData);
                $data = explode(",",$line);
                if((isset($data[2])&&isset($data[3])))
                 {
                    if(($username==$data[3]||$username==$data[4]) && (password_verify($password,$data[5])))
                    {
                        session_start();
                        $_SESSION['fname'] = trim(htmlspecialchars($data[1]));
                        $_SESSION['lname'] = trim(htmlspecialchars($data[2]));
                        header("location: DashBoard.php");
                        exit;
                    }
                 }   
            }
            $eror = "Username or Password incorect pleas try againe";
        } 
    }         
    ?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="Index.php" method='POST'>
        <h3>Login Here</h3>
        <?php echo '<span class="ereure"> '.$eror.'</span>';?>
        <label for="username">Username<span class="ereure"><b>*</b></span></label>
        <input type="text" name="username" placeholder="Email or Phone" required id="username">
        <label for="password">Password<span class="ereure"><b>*</b></span></label>
        <input type="password" name="password" placeholder="Password" required id="password">
        <input class="test" type="submit" value="Login">
        <div class="social">
        <a href="SignUp.php" ><div class="go">Sign UP</div></a>
        </div>
    </form>
    
</body>
</html>