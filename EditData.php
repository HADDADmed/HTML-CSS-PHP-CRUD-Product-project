<?php
 session_start();
 
 if(!isset($_SESSION['fname']))
 {
    header("location: Index.php");
 }elseif(isset($_POST['submit'])){


    $AllDataFile = fopen("UserData\ForAll\AllUsersID&Usernams&Passwords.txt", 'r+');
    $CreatedFile = fopen("UserData/{$_SESSION['fname']}_{$_SESSION['lname']}_DataFolder/{$_SESSION['fname']}_{$_SESSION['lname']}.txt", 'w+') or die("there is a problem while creating file");
    $AllDataFilePath = "UserData\ForAll\AllUsersID&Usernams&Passwords.txt";
    $tmpAllDataFile = fopen('tmpAllDataFile.txt', 'w+');

if($_POST['submit'] == "Change Email") {
    $CurrentEmail = htmlspecialchars($_POST['email1']);
    $NewEmail = htmlspecialchars($_POST['email']);
    rewind($AllDataFile);
    while(!feof($AllDataFile)) {
        $line = fgets($AllDataFile);
        $fields = explode(',', $line);
        if((trim($fields[1]) == $_SESSION['fname']) && (trim($fields[2]) == $_SESSION['lname'])) {
            if($fields[3] == $CurrentEmail) {
                $fields[3] = $NewEmail;
                fwrite($tmpAllDataFile, implode(',', $fields));
                fwrite($CreatedFile, "ID:$fields[0]\nFIRST NAME:$fields[1]\nLAST NAME:$fields[2]\nEMAIL:$fields[3]\nPHONE NUMBER:$fields[4]\nPASSWORD:$fields[5]\nCOUNTRY:$fields[6]\nCITY:$fields[7]\nAGE:$fields[8]");
                continue;
            } else {
                fclose($AllDataFile);
                fclose($CreatedFile);
                fclose($tmpAllDataFile);
                unlink('tmpAllDataFile.txt');
                $error1 = $CurrentEmail.' this is not your current Email';
                header("location: EditData.php?error1=".urlencode($error1));
                exit;
            }
        } else {
            fwrite($tmpAllDataFile, $line);
        }
    }
     
        } elseif($_POST['submit'] == "Change Phone Number" )
        {
            $CurrentTel = htmlspecialchars($_POST['tel1']);   
            $NewTel = htmlspecialchars($_POST['tel']);
            while (!feof($AllDataFile))
             {
            
                $line = fgets($AllDataFile);
                $fields = explode(',', $line);
              if ((trim($fields[1]) == $_SESSION['fname'])&& (trim($fields[2]) == $_SESSION['lname'])) 
                {
                    if($fields[4]==$CurrentTel){
                    $fields[4]=$NewTel;
                    fwrite($tmpAllDataFile, implode(',',$fields));
                    fwrite($CreatedFile,"ID:$fields[0]\nFIRST NAME:$fields[1]\nLAST NAME:$fields[2]\nEMAIL:$fields[3]\nPHONE NUMBER:$fields[4]\nPASSWORD:$fields[5]\nCOUNTRY:$fields[6]\nCITY:$fields[7]\nAGE:$fields[8]");
                    continue;
                    }else {
                         fclose($AllDataFile);
                         fclose($CreatedFile); 
                         fclose($tmpAllDataFile);
                        unlink('tmpAllDataFile.txt.txt');
                        $error2 = $CurentTel.'this is not your current Phone number';
                        header("location: EditData.php?error2=".urlencode($error2));   
                            exit;
                    }

                } else {
                   
                    fwrite($tmpAllDataFile, $line);
                }
            }

        }elseif($_POST['submit'] == "Change Password"){

            $CurrentPassword = htmlspecialchars($_POST['current-password']);   
            $NewPassword = htmlspecialchars($_POST['new-password']);
            $ConfirmPassword = htmlspecialchars($_POST['confirm-password']);
            if( $ConfirmPassword==$NewPassword)
           { while (!feof($AllDataFile))
             {
            
                $line = fgets($AllDataFile);
                $fields = explode(',', $line);
              if ((trim($fields[1]) == $_SESSION['fname'])&& (trim($fields[2]) == $_SESSION['lname'])) 
                {
                    if($fields[5]==$CurrentPassword){
                    $fields[5]=$NewPassword;
                    fwrite($tmpAllDataFile, implode(',',$fields));
                    fwrite($CreatedFile,"ID:$fields[0]\nFIRST NAME:$fields[1]\nLAST NAME:$fields[2]\nEMAIL:$fields[3]\nPHONE NUMBER:$fields[4]\nPASSWORD:$fields[5]\nCOUNTRY:$fields[6]\nCITY:$fields[7]\nAGE:$fields[8]");
                    continue;
                    }else {
                         fclose($AllDataFile);
                         fclose($CreatedFile); 
                         fclose($tmpAllDataFile);
                        unlink('tmpAllDataFile.txt.txt');
                        $error3 = '<span class="ereure"><b> '.$CurrentPassword.'this is not your current Password ! <b></span> ';
                        header("location: EditData.php?error=".urlencode($error3));   
                            exit;
                    }

                } else {
                   
                    fwrite($tmpAllDataFile, $line);
                }
            }}else{
                    fclose($AllDataFile);
                         fclose($CreatedFile); 
                         fclose($tmpAllDataFile);
                        unlink('tmpAllDataFile.txt.txt');
                        $error3 = '<span class="ereure"><b> you  have not enter the same password Password ! <b></span> ';
                        header("location: EditData.php?error3=".urlencode($error3));   
                            exit;
            }


        }

            fclose($AllDataFile);
            fclose($CreatedFile); 
            fclose($tmpAllDataFile);          
            unlink($AllDataFilePath);
            rename('tmpAllDataFile.txt', $AllDataFilePath);
            header("location: DashBoard.php"); 
}

 else{
?>  
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="icon" type="image/x-icon" href="favicon9.ico">
    <style>
        /* Style pour le formulaire */
        body {
            background-color: #f2f2f2;
            color: #000000;
            font-family: Arial, sans-serif;
        }
        .error-message {
            color: red;
            border: 1px solid red;
            background-color: white;
            padding: 5px;
            margin-bottom: 10px;
        }
        .form-container {
            
            margin: 10px 0;
            padding: 10px;
            text-align : center ;
            align-items: center;
            background-color: #ffffff;
            border: 1px solid #000000;
            border-radius: 5px;
        }

        .form-container h2 {
            margin: 0 0 10px;
        }

        .form-container label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-container input[type=text], 
        .form-container input[type=number], 
        .form-container input[type=password] {
            width: 250px;
            padding: 5px;
            border: 1px solid #000000;
            border-radius: 3px;
        }

        .form-container input[type=submit] {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #000000;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-container input[type=submit]:hover {
            background-color: #333333;
        }
    </style>
</head>
<body>
    <?php include 'NavBar.php'; ?>
     <h1><br> Page to Edit Data </h1>

    <!-- Formulaire pour éditer l'e-mail -->
    <div class="form-container">
        <form action="EditData.php" method="POST">
            <h2>Edit Email </h2>
            <label for="email1">Curent Email:</label>
            <input type="text" id="email1" required name="email1"><br>
            <label for="email">New Email:</label>
            <input type="text" id="email" required name="email">
            <br><br>
            <input type="submit" name="submit" value="edit dat">
        </form>
    </div>

    <!-- Formulaire pour éditer le numéro de téléphone -->
    <div class="form-container">
        <form action="EditData.php" method="POST">
            <h2>Edit Phone number </h2>
            <?php if (isset($_GET['error2'])) { echo '<span class="error-message">'.$_GET['error2'].'</span><br>'; } ?>
            <label for="tel1">Curent Phone Number:</label>
            <input type="number" id="tel1" required name="tel1"><br>
            <label for="tel">New Phone Number:</label>
            <input type="number" id="tel" required name="tel">
            <br>
            <br>
             <input type="submit" name="submit" value="Change Phone Number">
        </form>
    </div>
    <div class="form-container">
    <form action="EditData.php" method='POST'>
                <h2>Change Password</h2>
                <?php if (isset($_GET['error3'])) { echo $_GET['error3']; } ?>
                <label for="current-password">Current Password:</label>
                <input type="password" required id="current-password" name="current-password">
                <br>
                <label for="new-password">New Password:</label>
                <input type="password"  required id="new-password" name="new-password">
                <br>
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" required  id="confirm-password" name="confirm-password">
                <br>
                <br>
                <input type="submit" name="submit" value="Change Password">
    </form>
    </div>
</body>
</html>

<?php } ?>