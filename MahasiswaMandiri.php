<?php
// Menyertakan file abstract class induk agar dapat diturunkan
require_once 'mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik skema Mandiri (private untuk enkapsulasi)
    private $golonganUkt;
    private $namaWali;

    // Constructor Subclass
    public function __construct($data = []) {
        // Jika data dari database dilewatkan, petakan ke properti induk dan anak
        if (!empty($data)) {
            parent::__construct($data);
            $this->golonganUkt = $data['golongan_ukt'] ?? '';
            $this->namaWali    = $data['nama_wali'] ?? '';
        }
    }

    // Mengimplementasikan metode abstrak dari kelas induk (dikongkritkan sementara)
    public function hitungTagihanSemester() {
        return $this->tarif_ukt_nominal;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Skema: Mandiri | Golongan: " . $this->golonganUkt . " | Wali: " . $this->namaWali;
    }

    /**
     * Metode Query Spesifik untuk mengambil data Mahasiswa Mandiri saja
     * @param mysqli $db Objek koneksi database MySQLi
     * @return array Kumpulan data baris mahasiswa jalur Mandiri
     */
    public function getDaftarMandiri($db) {
        $query = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt_nominal, jenis_pembiayaan, golongan_ukt, nama_wali 
                  FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'Mandiri'";
        
        $result = $db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>