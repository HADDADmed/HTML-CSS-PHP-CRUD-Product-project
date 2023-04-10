
<?php
 session_start();
    if(!isset($_SESSION['fname']))
    {
        header("location: Index.php");
    }
    elseif(isset($_POST['Add']))
    {
        $file = $_FILES['file'];
        $FileName= $_FILES['file']['name'];
        $FileTmpLocation= $_FILES['file']['tmp_name'];
        $FileSize= $_FILES['file']['size'];
        $FileError= $_FILES['file']['error'];
        $FileType= $_FILES['file']['type'];
        $FileExt=explode('.',$FileName);
        $FileActualExt= strtolower(end($FileExt));
        $AllowedFormat = array('jpg','jpeg','png','gif');
        if(in_array($FileActualExt,$AllowedFormat))
            {
                if($FileError == 0)
                {
                    if($FileSize < 50000000)
                    {
                    $NewFileName = uniqid('',true).".".$FileActualExt;
                    $dirPath = "UserData\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_DataFolder\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_ImagesFolder\\";
                    $FileDestination = $dirPath . $NewFileName;
                    move_uploaded_file($FileTmpLocation, $FileDestination);
                    // $FileDestination = "UserData\\$_SESSION['fname']"."_".$_SESSION['lname'].$FileDestination = "UserData\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_DataFolder\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_ImagesFolder\\" . $NewFileName;
                    // $FileDestination = "UserData\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_DataFolder\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_ImagesFolder\\" . $NewFileName;
                    // move_uploaded_file($FileTmpLocation,$FileDestination);
                   //collecting Product Data 
                    $ProductName= $_POST['nom'];
                    $ProductPrice = $_POST['prix'];
                    $ProductQuantity =$_POST['Qt'];
                    $ProductDescription = $_POST['description'];
                    $CreatedProductFile = fopen("UserData\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_DataFolder\\" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_Product.txt","a+") or die("ther is a problem while creating file ") ;
                    fwrite($CreatedProductFile,"$ProductName,$ProductPrice,$ProductQuantity,$ProductDescription,$FileDestination\n");
                    header("location: DashBoard.php"); 
                    }else 
                    {   $error = '<span class="ereure"><b> your Image size is tooo big !<b></span> ';
                        header("location: AddNewProduct.php?error=".urlencode($error));   }
                }else 
                 {   $error = '<span class="ereure"><b>there was an error while uploading your image pleas try againe !<b></span> ';
                    header("location: AddNewProduct.php?error=".urlencode($error));   }
            }else 
            {   $error = '<span class="ereure"><b>you can not upload images of this type !<b></span> ';
                header("location: AddNewProduct.php?error=".urlencode($error));
                                                                       }
    }else
    {
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddNewProduct</title>
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
    position: relative;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: fixed;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(black, white);
    left: 350px;
    top: 270px;
}
.shape:last-child{
    background: linear-gradient(to right,black,white);
    right: 350px;
    bottom: -750px;
}
form{
    height: 800px;
    width: 500px;
    background-color: black;
    position: relative;
    transform: translate(-50%,-50%);
    top: -10px;
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
    
    <form action="AddNewProduct.php" method="POST" enctype="multipart/form-data">
		<label for="nom">Product Name:</label>
		<input type="text" id="nom" name="nom" required>
		<label for="prix">Procuct Price :</label>
		<input type="number" id="prix" name="prix" min="0" required>
        <label for="Qt">Quantity :</label>
		<input type="number" id="Qt" name="Qt" min="0" required>
		<label for="description">Product Description :</label>
		<textarea id="description" name="description" rows="4" cols="50"></textarea>
        <label for="img">Upload an imag</label>
        <input type="file" name="file">
        <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?>
		<input class="test" type="submit" name="Add" value="Add Product">
    </form>  
    </div>
        <?php include 'NavBar.php'; ?>

</body>
</html>
<?php } ?>
