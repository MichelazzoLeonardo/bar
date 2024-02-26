<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bar';

    $conn = new mysqli($servername, $username, $password, $dbname);
    ?>
</head>
<body>
<form action="home.php" method="post">
    <label>Piatto:
        <select>
            <?php
            $query = "SELECT * FROM prodotto;";
            $products = $conn->query($query);
            while ($p = $products->fetch_assoc())
                echo "<option value='".$p['id']."'>".$p['nome']." €".$p['prezzo']."</option>";
            ?>
        </select>
    </label>
</form>
</body>
</html>