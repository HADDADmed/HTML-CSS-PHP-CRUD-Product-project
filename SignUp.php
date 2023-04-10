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
    <link rel="stylesheet" href="StyleSheet.css">
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
    left: 300px;
    top: 10px;
}
.shape:last-child{
    background: linear-gradient(to right,#ff512f,#f09819);
    right: 300px;
    bottom: -700px;
}
form{
    height: 1150px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 100%;
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
.social .fb{
background-color: white ;
  margin-left: 25px;
  cursor: pointer;
  color:black;
}
.social .go{
    background-color: white ;
  margin-right: 4px;
  cursor: pointer;
  color:black;
}
.social .go:hover
{   
     background-color: gray;
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
       $email='';
            if($_SERVER['REQUEST_METHOD']== 'POST')
            {
            $email = htmlspecialchars($_POST['email']);
            // Remove illegal characters from email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            // Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $email = '<span class="ereure">invalide email format!</span>';
            else
            {

                $lname = trim(htmlspecialchars($_POST["lname"]));
                $fname = trim(htmlspecialchars($_POST["fname"]));
                $password =password_hash(trim(htmlspecialchars($_POST["password"])),PASSWORD_DEFAULT,['cost'=> 10]);
                $email = trim(htmlspecialchars($_POST["email"]));
                $tel = trim(htmlspecialchars($_POST["tel"]));
                $country=htmlspecialchars($_POST["country"]);
                $city=htmlspecialchars($_POST["city"]);
                $age=htmlspecialchars( $_POST["age"]);
                 // Ouvrir le fichier en mode lecture
                $Idcounter = fopen("UserData\ForAll\IdCounter.txt","r+");
                // Trouver la dernière ligne du fichier
                $last_line = '';
                while (($line = fgets($Idcounter)) !== false)
                 {
                    $last_line = trim($line);
                 }
                // Extraire le dernier ID de la dernière ligne
                $ids = explode(",", $last_line);
                $id = end($ids);
                $id++;
                fwrite($Idcounter, ",$id");
                // Fermer le fichier 
                fclose($Idcounter);
                //creat a diractory that hold the first name and the last of the user 
                // mkdir("UserData\\".$fname."_".$lname."DataFolder");
                mkdir("UserData\\$fname"."_".$lname."_"."DataFolder");
                mkdir("UserData\\$fname"."_".$lname."_"."DataFolder\\$fname"."_".$lname."_"."ImagesFolder");
                //creat a new file that hold the first name and the last name of the user 
                $AllDataFile = fopen("UserData\ForAll\AllUsersID&Usernams&Passwords.txt","a");
                $CreatedFile = fopen("UserData\\$fname"."_".$lname."_"."DataFolder\\$fname"."_".$lname.".txt","w+") or die("ther is a problem while creating file ") ;
                fwrite($AllDataFile,"$id,$fname,$lname,$email,$tel,$password,$country,$city,$age\n");
                // fwrite($CreatedFile,"$id,$fname,$lname,$email,$tel,$password,$country,$city,$age");
                fwrite($CreatedFile,"ID:$id\nFIRST NAME:$fname\nLAST NAME:$lname\nEMAIL:$email\nPHONE NUMBER:$tel\nPASSWORD:$password\nCOUNTRY:$country\nCITY:$city\nAGE:$age\n");
                fclose($AllDataFile);
                fclose($CreatedFile);
                header("location: Index.php");
            }
            }
    ?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="SignUp.php" method='POST'>
        <h3>Creat a new accout</h3>
        <label for="fname" >First Name</label>
        <input type="text" name="fname" id="fname" placeholder="first name" required>
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" placeholder="last name" required>
        <label for="password" >Password</label>
        <input type="password" name="password" placeholder="password" id="password" required>
        <label for="tel">Phone nuber</label>
        <input type="tel" name="tel" placeholder="Phone" id="tel" required>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="E-mail" id="email" required>
        <label for="country">Country</label>
        <input type="text" name="country" placeholder="country" id="country" required>
        <label for="city">City</label>
        <input type="text" name="city" placeholder="city" id="city" required>
        <label for="age">Age</label>
        <input type="number" min="1" max="100" step="1"  placeholder="age" required name="age" id="age">
        <input class="test" type="submit" value="Sign UP">
        <div class="social">
        <a href="Index.php" ><div class="go">Back to Login Page </div></a>
        </div>
    </form>
    
    <!-- <form action="SignUp.php" method="post">
        <label for="fname" >First Name</label>
        <input type="text" name="fname" id="fname" placeholder="first name" required><br>
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" placeholder="last name" required><br>
        <label for="password" >Password</label>
        <input type="password" name="password" placeholder="password" id="password" required><br>
        <label for="tel">Phone nuber</label>
        <input type="tel" name="tel" placeholder="Phone" id="tel" required><br>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="E-mail" id="email" required>
        <?php //echo $email ; ?><br>
        <label for="country">Country</label>
        <input type="text" name="country" placeholder="country" id="country" required><br>
        <label for="city">City</label>
        <input type="text" name="city" placeholder="city" id="city" required><br>
        <label for="age">Age</label>
        <input type="number" min="1" max="100" step="1"  placeholder="age" required name="age" id="age"><br>
        <input type="submit" > <br>
        <a href="Index.php">Retour à la page d'accueil</a>
    </form> -->

</body>
</html>