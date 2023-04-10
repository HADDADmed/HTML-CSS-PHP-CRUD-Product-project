<?php
session_start();

if(!isset($_SESSION['fname'])) {
    header("location: Index.php");
} elseif(isset($_POST['operation'])) {
    $ProductFileName = "UserData\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_DataFolder\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_Product.txt";
    if (file_exists($ProductFileName)) {
        
        $ProductName = trim($_POST['nom']);
        $QuatityToDelete = $_POST['Qt'];
        $file = fopen($ProductFileName, 'r');
        
        $temp_file = fopen('temp_dataproduct.txt', 'w+');

       
        while (!feof($file)) {
            
            $line = fgets($file);

            $fields = explode(',', $line);

            if (trim($fields[0]) == $ProductName) {

                if($fields[2]>$QuatityToDelete) {
                   
                    $fields[2]-= $QuatityToDelete;
                    fwrite($temp_file, implode(',',$fields));
                    continue;
                } elseif($fields[2]==$QuatityToDelete) {
                    $ImagePath = rtrim(end($fields),"\n");
                    continue;
                } else {
                    fclose($file);
                    fclose($temp_file);
                    unlink('temp_dataproduct.txt');
                    $error = '<span class="ereure"><b> You have\'not this quantity you have just '.$fields[2].' of '.$ProductName.' <b></span> ';
                    header("location: DeleteProduct.php?error=".urlencode($error));   
                }
            } else {
               
                fwrite($temp_file, $line);
            }
        }

    
        fclose($file);
        fclose($temp_file);

      
        unlink($ProductFileName);
        if(isset($ImagePath)) unlink($ImagePath);

        rename('temp_dataproduct.txt', $ProductFileName);

        header("location: DashBoard.php"); 
      
    } else {
        echo "<h1>Le fichier de données est introuvable !<h1>";
    }
    
} else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeleteProduct</title>
    <link rel="icon" type="image/x-icon" href="favicon9.ico">
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
    background-color: white;
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
    background: linear-gradient(black, white);
    left: 340px;
    top: -50px;
}
.shape:last-child{
    background: linear-gradient(to right,black,white);
    right: 340px;
    bottom: -50px;
}
form{
    height: 450px;
    width: 500px;
    background-color: black;
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
textarea{
    display: block;
    height: 100px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;

}
input[type="file"]{

    display: flexbox;
    height: 50;
    width: 50;
    background-color: rgba(255,255,0,0.07);
    font-size: 14px;
    font-weight: 300;
    
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
input[type="checkbox"] {
  margin-top: 20px;
  width: 50%;
  background-color: #ffffff;
  color: #080710;
  cursor: pointer;
  transform: scale(0.3);
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
            
            <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <?php include 'NavBar.php'; ?>
    <form action="DeleteProduct.php" method="POST" enctype="multipart/form-data">
    <!-- <form action="DeleteProduct.php" method="POST"> -->
		<label for="nom">Product Name:</label>
		<input type="text" id="nom" name="nom" required>
        <label for="Qt">Quantity to Delete :</label>
		<input type="number" id="Qt" name="Qt" required>
        <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?>
		<input type="submit" name="operation" value="Delete Product">
	</form>
   

</body>
</html>
<?php }?>