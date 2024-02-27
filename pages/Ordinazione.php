<?php

class Ordinazione {
    private $idProdotto;
    private $idCameriere;
    private $quantita;
    private $stato;
    private $data_ora;

    public function __construct($idProdotto, $idCameriere, $quantita)
    {
        $this->idProdotto = $idProdotto;
        $this->idCameriere = $idCameriere;
        $this->quantita = $quantita;
        $this->stato = 'in attesa';
        $this->data_ora = date('Y-m-d H:i:s');
        $this->add();
    }
    private function add(): void {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'bar';

        $conn = new mysqli($servername, $username, $password, $dbname);
        $query = "INSERT INTO ordinazione (idProdotto, idCameriere, quantita, stato, dataOra)
                    VALUES($this->idProdotto, $this->idCameriere, $this->quantita, '$this->stato', '$this->data_ora');";
        $conn->query($query);
    }
    public static function update($dataOra):void {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'bar';

        $conn = new mysqli($servername, $username, $password, $dbname);
        $query = "UPDATE ordinazione
                    SET stato='servito'
                    WHERE dataOra='$dataOra';";
        $conn->query($query);
    }
}