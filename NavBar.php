
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="icon" type="image/x-icon" href="favicon9.ico">
    <link rel="stylesheet" href="StyleSheet.css">

    <style type="text/css">
        
        *{
            padding: 0;
            margin: 0;
        }
        #navbar
        {
            position: fixed;
            top: 0;
            width: 100%;
            background: #000;
            

        }
        #navbar ul{
            list-style-type: none;
            text-align: center;
            color: white;
        }

        #navbar li 
        {
            display: inline-block;
            padding: 10px;
        }
        #navbar li a{
            /* font-size: 30px; */
            text-decoration: none;  
            color: white;
        }
    </style>
</head>
<body>  

  <div id="navbar">
     <ul>
        <li>  <a href="DashBoard.php">Homme Page</a>  </li>
        <li>  <a href="AddNewProduct.php" >Add New Product</a> </li>
        <li>  <a href="DeleteProduct.php">Delete Product</a> </li>
        <li>  <a href="EditData.php">Edit Data</a> </li>
        <li>  <a href="Disconect.php">Disconect</a> </li> 
        <li>  <a href="test.php" target="_blank">Test</a> </li>  
     </ul>    
  </div>

</body>
</html>
