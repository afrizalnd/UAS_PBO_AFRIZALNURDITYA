<?php
// Menyertakan file abstract class induk agar dapat diturunkan
require_once 'mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan spesifik skema Bidikmisi / KIP-K
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    // Constructor Subclass
    public function __construct($data = []) {
        if (!empty($data)) {
            parent::__construct($data);
            $this->nomorKipKuliah  = $data['nomor_kip_kuliah'] ?? '';
            $this->danaSakuSubsidi = $data['dana_saku_subsidi'] ?? 0.0;
        }
    }

    // Mengimplementasikan metode abstrak dari kelas induk (dikongkritkan sementara)
    public function hitungTagihanSemester() {
        return 0.0;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Skema: Bidikmisi | No KIP-K: " . $this->nomorKipKuliah . " | Subsidi Saku: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    /**
     * Metode Query Spesifik untuk mengambil data Mahasiswa Bidikmisi saja
     * @param mysqli $db Objek koneksi database MySQLi
     * @return array Kumpulan data baris mahasiswa jalur Bidikmisi
     */
    public function getDaftarBidikmisi($db) {
        $query = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt_nominal, jenis_pembiayaan, nomor_kip_kuliah, dana_saku_subsidi 
                  FROM tabel_mahasiswa 
                  WHERE jenis_pembiayaan = 'Bidikmisi'";
        
        $result = $db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>