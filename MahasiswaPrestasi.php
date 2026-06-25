<?php
// Menyertakan file abstract class induk agar dapat diturunkan
require_once 'mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik skema Prestasi / Beasiswa Kemitraan
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    // Constructor Subclass
    public function __construct($data = []) {
        if (!empty($data)) {
            parent::__construct($data);
            $this->namaInstansiBeasiswa = $data['nama_instansi_beasiswa'] ?? '';
            $this->minimalIpkSyarat     = $data['minimal_ipk_bersyarat'] ?? 0.0;
        }
    }

    // Mengimplementasikan metode abstrak dari kelas induk (dikongkritkan sementara)
    public function hitungTagihanSemester() {
        return $this->tarif_ukt_nominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Skema: Prestasi | Instansi: " . $this->namaInstansiBeasiswa . " | Syarat IPK: " . $this->minimalIpkSyarat;
    }

    /**
     * Metode Query Spesifik untuk mengambil data Mahasiswa Prestasi saja
     * @param mysqli $db Objek koneksi database MySQLi
     * @return array Kumpulan data baris mahasiswa jalur Prestasi
     */
    public function getDaftarPrestasi($db) {
        $query = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt_nominal, jenis_pembiayaan, nama_instansi_beasiswa, minimal_ipk_bersyarat 
                  FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'Prestasi'";
        
        $result = $db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>