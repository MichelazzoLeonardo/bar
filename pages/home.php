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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['prodotto']) && isset($_POST['cameriere']) && isset($_POST['quantita'])) {
        include 'Ordinazione.php';

        $ordinazione = new Ordinazione($_POST['prodotto'], $_POST['cameriere'], $_POST['quantita']);
    }
    ?>
</head>
<body>
<form action="home.php" method="post">
    <label>Piatto:
        <select name="prodotto">
            <?php
            $query = "SELECT * FROM prodotto;";
            $products = $conn->query($query);
            while ($p = $products->fetch_assoc())
                echo "<option value='".$p['id']."'>".$p['nome']." €".$p['prezzo']."</option>";
            ?>
        </select>
    </label><br>
    <label>Cameriere:
        <select name="cameriere">
            <?php
            $query = "SELECT * FROM cameriere;";
            $camerieri = $conn->query($query);
            while ($c = $camerieri->fetch_assoc())
                echo "<option value='".$c['id']."'>".$c['nome']."</option>";
            ?>
        </select>
    </label><br>
    <label>Quantità:
        <input type="number" name="quantita" value="1" required>
    </label><br>
    <input class="submit" type="submit" value="aggiungi">
</form>
<br>
<form action="showOrders.php" method="post">
    <input type="submit" value="mostra ordinazioni">
</form>
</body>
</html>