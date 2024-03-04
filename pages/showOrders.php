<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script>

    </script>
    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bar';
    $conn = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT p.nome as p, c.nome as c, quantita, stato, dataOra 
        FROM ordinazione JOIN cameriere c ON (c.id = idCameriere) JOIN prodotto p ON (p.id = idProdotto);";
    $ordinazioni = $conn->query($query);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        include 'Ordinazione.php';
        Ordinazione::update($_POST['update']);
    }
    ?>
</head>
<body>
<table>
    <tr>
        <th>Prodotto</th>
        <th>Cameriere</th>
        <th>Quantità</th>
        <th>Stato</th>
        <th>Data/Ora</th>
        <th></th>
    </tr>
    <?php
    while ($ord = $ordinazioni->fetch_assoc()) {
        echo "
            <tr>
                <td>".$ord['p']."</td>
                <td>".$ord['c']."</td>
                <td>".$ord['quantita']."</td>
                <td>".$ord['stato']."</td>
                <td>".$ord['dataOra']."</td>";
        if ($ord['stato'] == 'in attesa')
            echo "<td>
                <form action='showOrders.php' method='post'>
                    <input type='hidden' name='update' value='".$ord['dataOra']."'>
                    <input type='submit' value='update'>
                </form>
            </td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>