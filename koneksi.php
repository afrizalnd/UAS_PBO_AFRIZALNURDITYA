<?php
class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = ""; // Sesuaikan dengan password MySQL laptopmu
    private $database = "db_uas_pbo_ti1d_afrizalnurditya";
    public $db;

    public function __construct() {
        // Membuat koneksi ke MySQLi
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Validasi penanganan error koneksi
        if ($this->db->connect_error) {
            die("Koneksi database gagal terhubung: " . $this->db->connect_error);
        }
    }
}

// Inisialisasi global untuk mempermudah pemanggilan di file index
$koneksiObj = new Koneksi();
?>