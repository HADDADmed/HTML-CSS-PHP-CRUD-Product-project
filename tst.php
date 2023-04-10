

<?php
 session_start();
    if(!isset($_SESSION['fname']))
    {
        header("location: MainLoginPage.php");
    }
    elseif(isset($_POST['Add']))
    {
        //collecting all the img information
        $file = $_FILES['file'];
        $FileName= $_FILES['file']['name'];
        $FileTmpLocation= $_FILES['file']['tmp_name'];
        $FileSize= $_FILES['file']['size'];
        $FileError= $_FILES['file']['error'];
        $FileType= $_FILES['file']['type'];
        $FileExt=explode('.',$FileName);
        $FileActualExt= strtolower(end($FileExt));
        //check if the format of the immage are allowed to upload
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
    <title>Product Operation</title>
    <link rel="icon" type="image/x-icon" href="favicon9.ico">
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>
        <?php include 'NavBar.php'; ?>
        <br>
        <h1>Here Mr <?php echo $_SESSION['fname']." ".$_SESSION['lname']." "?> you can add a new Product :</h1>
        <br><h3>Just fill out this form </h3><br>
	<form action="AddNewProduct.php" method="POST" enctype="multipart/form-data">
		<label for="nom">Product Name:</label>
		<input type="text" id="nom" name="nom" required><br><br>
		<label for="prix">Procuct Price :</label>
		<input type="number" id="prix" name="prix" min="0" required><br><br>
        <label for="Qt">Quantity :</label>
		<input type="number" id="Qt" name="Qt" min="0" required><br><br
		<label for="description">Product Description :</label><br>
		<textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
        <label for="img">Upload an imag</label><br>
        <input type="file" name="file">
        <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?><br><br>
		<input type="submit" name="Add" value="Add Product">
	</form>
    
</body>
</html>

<?php }?>