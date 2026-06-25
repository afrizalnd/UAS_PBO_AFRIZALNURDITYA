<?php

// Mendefinisikan abstract class Mahasiswa
abstract class Mahasiswa {
    // Properti terenkapsulasi (protected) sesuai dengan kolom database di Tahap 1
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarif_ukt_nominal;

    // Constructor untuk memetakan (mapping) data langsung dari array baris database
    public function __construct($data) {
        $this->id_mahasiswa      = $data['id_mahasiswa'] ?? null;
        $this->nama_mahasiswa    = $data['nama_mahasiswa'] ?? '';
        $this->nim               = $data['nim'] ?? '';
        $this->semester          = $data['semester'] ?? 0;
        $this->tarif_ukt_nominal = $data['tarif_ukt_nominal'] ?? 0.0;
    }

    // =========================================================================
    // METODE GETTER (Publik) - Untuk Keamanan Akses Enkapsulasi di halaman View
    // =========================================================================
    public function getIdMahasiswa() {
        return $this->id_mahasiswa;
    }

    public function getNamaMahasiswa() {
        return $this->nama_mahasiswa;
    }

    public function getNim() {
        return $this->nim;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getTarifUktNominal() {
        return $this->tarif_ukt_nominal;
    }

    // =========================================================================
    // METODE ABSTRAK (Wajib Kosong / Tanpa Isi/Body)
    // =========================================================================
    
    // Wajib diimplementasikan kelas anak untuk mengalkulasi tagihan akhir semester + subsidi/surcharge
    abstract public function hitungTagihanSemester();

    // Wajib diimplementasikan kelas anak untuk menampilkan info akademik spesifik jalur
    abstract public function tampilkanSpesifikasiAkademik();
}