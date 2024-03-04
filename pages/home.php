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

    $conn = new mysqli($servername, $username, $password);
    $query = "CREATE DATABASE IF NOT EXISTS bar;";
    $conn->query($query);

    $conn = new mysqli($servername, $username, $password, $dbname);
    $query ="CREATE TABLE IF NOT EXISTS prodotto (
        id int(11) PRIMARY KEY AUTO_INCREMENT,
        nome varchar(255) NOT NULL,
        prezzo decimal(5,2) NOT NULL
    );";
    $conn->query($query);
    $query = "CREATE TABLE IF NOT EXISTS cameriere (
        id int(11) PRIMARY KEY AUTO_INCREMENT,
        nome varchar(255) NOT NULL
    );";
    $conn->query($query);
    $query = "CREATE TABLE IF NOT EXISTS ordinazione (
        id int(11) PRIMARY KEY AUTO_INCREMENT,
        idProdotto int(11) NOT NULL,
        idCameriere int(11) NOT NULL,
        quantita int(11) NOT NULL,
        stato varchar(50) NOT NULL,
        dataOra datetime NOT NULL,
        FOREIGN KEY (idProdotto) REFERENCES prodotto (id),
        FOREIGN KEY (idCameriere) REFERENCES cameriere (id)
    );";
    $conn->query($query);


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