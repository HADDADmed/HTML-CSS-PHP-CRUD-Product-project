<?php
session_start();

if (!isset($_SESSION['fname'])) {
    header("location: Index.php");
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="icon" type="image/x-icon" href="favicon9.ico">
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
            font-family: arial;
            transition: transform 0.2s ease-in-out;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card h1 {
            margin-top: 10px;
            font-size: 24px;
        }
        .card p {
            margin: 10px;
            font-size: 18px;
        }
        .card .price {
            color: grey;
        }
        .card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        .card button:hover {
            opacity: 0.7;
        }
        /* ajouté pour l'effet d'agrandissement de la carte */
        .card:hover {
            transform: scale(1.1);
            z-index: 1;
        }
    </style>
</head>
<body>
    <?php include 'NavBar.php'; ?>
    <br><br><br><br><h1 text-align: center;>Hello, <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h1><br><br>
    <?php
        $productFileName = "UserData/" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_DataFolder/" . $_SESSION['fname'] . "_" . $_SESSION['lname'] . "_Product.txt";
        if (file_exists($productFileName)) {
            $file = fopen($productFileName, 'r');
            echo '<div class="card-container">';
            while (!feof($file)) {
                $line = fgets($file);
                $fields = explode(',', $line);
                if (isset($fields[0])&& isset($fields[1])) {
                    echo '<div class="card">';
                    echo '<img src="' . rtrim(end($fields)) . '" alt="' . $fields[0] . '">';
                    echo '<h1>' . $fields[0] . '</h1>';
                    echo '<p class="price">' . $fields[1] . ' MAD</p>';
                    echo '<p> Quantity :' . $fields[2] . 'piece </p>';
                    echo '<p>' . $fields[3] . '</p>';
                    echo '</div>';
                }
            }
            echo '</div>';
            fclose($file);
        }
    ?>
</body>
</html>
<?php } ?>
