<?php
// 1. Menyertakan file koneksi database dan seluruh berkas class komponen OOP
require_once 'koneksi.php';
require_once 'mahasiswa.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// Mengambil objek koneksi database yang sudah diinisialisasi
$db = $koneksiObj->db;

// 2. Instansiasi objek subclass untuk mengeksekusi metode query spesifik (Tahap 4)
$mandiriObj   = new MahasiswaMandiri();
$bidikmisiObj = new MahasiswaBidikmisi();
$prestasiObj  = new MahasiswaPrestasi();

// Mengambil data mentah (array) secara terpisah berdasarkan kategori pembiayaan (Query Spesifik)
$dataRawMandiri   = $mandiriObj->getDaftarMandiri($db);
$dataRawBidikmisi = $bidikmisiObj->getDaftarBidikmisi($db);
$dataRawPrestasi  = $prestasiObj->getDaftarPrestasi($db);

$totalMandiri   = count($dataRawMandiri);
$totalBidikmisi = count($dataRawBidikmisi);
$totalPrestasi  = count($dataRawPrestasi);
$totalMahasiswa = $totalMandiri + $totalBidikmisi + $totalPrestasi;

// 3. Mapping data mentah menjadi kumpulan Objek Konkrit (Polimorfisme)
$listMandiri = [];
foreach ($dataRawMandiri as $row) { $listMandiri[] = new MahasiswaMandiri($row); }

$listBidikmisi = [];
foreach ($dataRawBidikmisi as $row) { $listBidikmisi[] = new MahasiswaBidikmisi($row); }

$listPrestasi = [];
foreach ($dataRawPrestasi as $row) { $listPrestasi[] = new MahasiswaPrestasi($row); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Registrasi & Pembayaran Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800">

    <nav class="bg-slate-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-600 rounded-lg">
                        <i class="fa-solid fa-graduation-cap text-xl text-amber-400"></i>
                    </div>
                    <div>
                        <span class="font-bold text-md tracking-wider block">PORTAL KEUANGAN MAHASISWA</span>
                        <span class="text-xs text-slate-400 block">Sistem Rekapitulasi Registrasi Pembayaran UKT</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-xs bg-slate-800 px-3 py-1.5 rounded-full border border-slate-700 font-medium">
                        <i class="fa-solid fa-database text-emerald-400 mr-2"></i>Status: Terkoneksi
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Registrasi</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1"><?= $totalMahasiswa; ?> <span class="text-sm font-normal text-slate-500">Siswa</span></h3>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl"><i class="fa-solid fa-users text-lg"></i></div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200/60 flex items-center justify-between cursor-pointer hover:border-blue-400 transition" onclick="switchTab('mandiri')">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Skema Mandiri</p>
                    <h3 class="text-2xl font-bold text-blue-600 mt-1"><?= $totalMandiri; ?> <span class="text-sm font-normal text-slate-500">Siswa</span></h3>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-wallet text-lg"></i></div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200/60 flex items-center justify-between cursor-pointer hover:border-emerald-400 transition" onclick="switchTab('bidikmisi')">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Skema Bidikmisi</p>
                    <h3 class="text-2xl font-bold text-emerald-600 mt-1"><?= $totalBidikmisi; ?> <span class="text-sm font-normal text-slate-500">Siswa</span></h3>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl"><i class="fa-solid fa-hand-holding-dollar text-lg"></i></div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200/60 flex items-center justify-between cursor-pointer hover:border-purple-400 transition" onclick="switchTab('prestasi')">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Skema Prestasi</p>
                    <h3 class="text-2xl font-bold text-purple-600 mt-1"><?= $totalPrestasi; ?> <span class="text-sm font-normal text-slate-500">Siswa</span></h3>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl"><i class="fa-solid fa-award text-lg"></i></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="border-b border-slate-100 bg-slate-50/50 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex flex-wrap gap-2">
                    <button id="tab-mandiri" onclick="switchTab('mandiri')" class="px-4 py-2 text-sm font-semibold rounded-lg transition shadow-sm bg-blue-600 text-white">
                        <i class="fa-solid fa-wallet mr-2"></i>Mahasiswa Mandiri
                    </button>
                    <button id="tab-bidikmisi" onclick="switchTab('bidikmisi')" class="px-4 py-2 text-sm font-semibold rounded-lg transition text-slate-600 hover:bg-slate-100">
                        <i class="fa-solid fa-hand-holding-dollar mr-2"></i>Mahasiswa Bidikmisi
                    </button>
                    <button id="tab-prestasi" onclick="switchTab('prestasi')" class="px-4 py-2 text-sm font-semibold rounded-lg transition text-slate-600 hover:bg-slate-100">
                        <i class="fa-solid fa-award mr-2"></i>Mahasiswa Prestasi
                    </button>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari Nama atau NIM..." class="pl-9 pr-4 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500 bg-white w-full sm:w-64">
                </div>
            </div>

            <div class="p-2 overflow-x-auto">
                
                <div id="content-mandiri" class="tab-content block">
                    <table class="w-full text-left border-collapse table-search">
                        <thead>
                            <tr class="bg-slate-800 text-white text-xs uppercase tracking-wider border-b border-slate-700">
                                <th class="p-4 rounded-tl-lg">NIM</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4 text-center">Semester</th>
                                <th class="p-4">Tarif UKT Dasar</th>
                                <th class="p-4">Spesifikasi Finansial (Info Polimorfik)</th>
                                <th class="p-4 text-right">Total Tagihan</th>
                                <th class="p-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php foreach ($listMandiri as $mhs): ?>
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="p-4 font-mono font-medium text-slate-500 target-nim"><?= htmlspecialchars($mhs->getNim()); ?></td>
                                <td class="p-4 font-semibold text-slate-900 target-name"><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                                <td class="p-4 text-center"><span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full text-xs font-bold">Sem <?= htmlspecialchars($mhs->getSemester()); ?></span></td>
                                <td class="p-4 text-slate-600">Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                <td class="p-4 text-xs"><span class="bg-slate-50 px-2.5 py-1.5 rounded-md border border-slate-200 block text-slate-600"><i class="fa-solid fa-circle-info text-blue-500 mr-1.5"></i><?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                <td class="p-4 text-right font-bold text-blue-600">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                <td class="p-4 text-center">
                                    <button onclick="openPaymentModal('<?= htmlspecialchars($mhs->getNamaMahasiswa()); ?>', '<?= htmlspecialchars($mhs->getNim()); ?>', 'Mandiri', <?= $mhs->hitungTagihanSemester(); ?>)" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded-md font-semibold transition">
                                        <i class="fa-solid fa-receipt mr-1.5"></i>Bayar
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div id="content-bidikmisi" class="tab-content hidden">
                    <table class="w-full text-left border-collapse table-search">
                        <thead>
                            <tr class="bg-emerald-800 text-white text-xs uppercase tracking-wider border-b border-emerald-700">
                                <th class="p-4 rounded-tl-lg">NIM</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4 text-center">Semester</th>
                                <th class="p-4">Tarif UKT Dasar</th>
                                <th class="p-4">Spesifikasi Subsidi (Info Polimorfik)</th>
                                <th class="p-4 text-right">Total Tagihan</th>
                                <th class="p-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php foreach ($listBidikmisi as $mhs): ?>
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="p-4 font-mono font-medium text-slate-500 target-nim"><?= htmlspecialchars($mhs->getNim()); ?></td>
                                <td class="p-4 font-semibold text-slate-900 target-name"><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                                <td class="p-4 text-center"><span class="bg-emerald-50 text-emerald-700 px-2.5 py-0.5 rounded-full text-xs font-bold">Sem <?= htmlspecialchars($mhs->getSemester()); ?></span></td>
                                <td class="p-4 text-slate-600">Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                <td class="p-4 text-xs"><span class="bg-emerald-50/60 px-2.5 py-1.5 rounded-md border border-emerald-100 block text-emerald-800"><i class="fa-solid fa-handshake-angle text-emerald-600 mr-1.5"></i><?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                <td class="p-4 text-right"><span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-md text-xs font-bold tracking-wide">Rp 0 (SUBSIDI PENUH)</span></td>
                                <td class="p-4 text-center">
                                    <button disabled class="bg-slate-200 text-slate-400 text-xs px-3 py-1.5 rounded-md font-semibold cursor-not-allowed">
                                        <i class="fa-solid fa-check border-slate-300 mr-1.5"></i>Lunas
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div id="content-prestasi" class="tab-content hidden">
                    <table class="w-full text-left border-collapse table-search">
                        <thead>
                            <tr class="bg-purple-800 text-white text-xs uppercase tracking-wider border-b border-purple-700">
                                <th class="p-4 rounded-tl-lg">NIM</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4 text-center">Semester</th>
                                <th class="p-4">Tarif UKT Dasar</th>
                                <th class="p-4">Spesifikasi Beasiswa (Info Polimorfik)</th>
                                <th class="p-4 text-right">Total Tagihan</th>
                                <th class="p-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php foreach ($listPrestasi as $mhs): ?>
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="p-4 font-mono font-medium text-slate-500 target-nim"><?= htmlspecialchars($mhs->getNim()); ?></td>
                                <td class="p-4 font-semibold text-slate-900 target-name"><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                                <td class="p-4 text-center"><span class="bg-purple-50 text-purple-700 px-2.5 py-0.5 rounded-full text-xs font-bold">Sem <?= htmlspecialchars($mhs->getSemester()); ?></span></td>
                                <td class="p-4 text-slate-600">Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                <td class="p-4 text-xs"><span class="bg-purple-50/60 px-2.5 py-1.5 rounded-md border border-purple-100 block text-purple-800"><i class="fa-solid fa-trophy text-purple-600 mr-1.5"></i><?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                <td class="p-4 text-right font-bold text-purple-600">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                <td class="p-4 text-center">
                                    <button onclick="openPaymentModal('<?= htmlspecialchars($mhs->getNamaMahasiswa()); ?>', '<?= htmlspecialchars($mhs->getNim()); ?>', 'Prestasi', <?= $mhs->hitungTagihanSemester(); ?>)" class="bg-purple-600 hover:bg-purple-700 text-white text-xs px-3 py-1.5 rounded-md font-semibold transition">
                                        <i class="fa-solid fa-receipt mr-1.5"></i>Bayar
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

    <div id="paymentModal" class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300 mx-4">
            <div class="bg-slate-900 p-4 text-white flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-money-bill-transfer text-amber-400"></i>
                    <span class="font-bold text-sm tracking-wide">Invoicing Pembayaran Kuliah</span>
                </div>
                <button onclick="closePaymentModal()" class="text-slate-400 hover:text-white transition"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between border-b border-slate-100 pb-2">
                        <span class="text-xs text-slate-400 font-medium">Nama Mahasiswa</span>
                        <span id="modal-name" class="text-xs font-bold text-slate-800">-</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-2">
                        <span class="text-xs text-slate-400 font-medium">NIM</span>
                        <span id="modal-nim" class="text-xs font-mono font-bold text-slate-800">-</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-2">
                        <span class="text-xs text-slate-400 font-medium">Skema Skim</span>
                        <span id="modal-scheme" class="text-xs font-bold text-slate-800">-</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mt-2 text-center">
                        <span class="text-[11px] uppercase text-slate-400 font-bold tracking-wider">Nomor Virtual Account (BNI Host)</span>
                        <div class="flex items-center justify-center space-x-2 mt-1">
                            <h2 id="modal-va" class="text-lg font-mono font-bold text-slate-900 tracking-wide">98800250102001</h2>
                            <button onclick="copyToClipboard()" class="text-indigo-600 hover:text-indigo-800 text-xs" title="Salin Kode"><i class="fa-solid fa-copy"></i></button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center bg-amber-50 border border-amber-200/60 p-4 rounded-xl mt-4">
                        <span class="text-xs text-amber-800 font-bold">Total Wajib Bayar</span>
                        <span id="modal-total" class="text-lg font-extrabold text-amber-700">Rp 0</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-6">
                    <button onclick="closePaymentModal()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs py-3 rounded-xl transition">Batal</button>
                    <button onclick="simulateSuccessPayment()" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs py-3 rounded-xl transition shadow-sm"><i class="fa-solid fa-paper-plane mr-1.5"></i>Konfirmasi Lunas</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Mekanisme Perpindahan Tab Kategori
        function switchTab(jalur) {
            document.querySelectorAll('.tab-content').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('block');
            });
            document.getElementById('content-' + jalur).classList.remove('hidden');
            document.getElementById('content-' + jalur).classList.add('block');

            const tabs = ['mandiri', 'bidikmisi', 'prestasi'];
            const activeColors = { mandiri: 'bg-blue-600', bidikmisi: 'bg-emerald-600', prestasi: 'bg-purple-600' };

            tabs.forEach(t => {
                const btn = document.getElementById('tab-' + t);
                btn.className = "px-4 py-2 text-sm font-semibold rounded-lg transition text-slate-600 hover:bg-slate-100";
            });

            const activeBtn = document.getElementById('tab-' + jalur);
            activeBtn.className = `px-4 py-2 text-sm font-semibold rounded-lg transition shadow-sm text-white ${activeColors[jalur]}`;
            
            document.getElementById('searchInput').value = "";
            filterTable();
        }

        // Fungsi Mekanisme Filter Live Search Bar (Secara Realtime)
        function filterTable() {
            const input = document.getElementById("searchInput").value.toUpperCase();
            const activeBody = document.querySelector('.tab-content:not(.hidden) .table-search tbody');
            const rows = activeBody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const nameCol = rows[i].querySelector(".target-name");
                const nimCol = rows[i].querySelector(".target-nim");
                
                if (nameCol || nimCol) {
                    const txtName = nameCol.textContent || nameCol.innerText;
                    const txtNim = nimCol.textContent || nimCol.innerText;
                    
                    if (txtName.toUpperCase().indexOf(input) > -1 || txtNim.toUpperCase().indexOf(input) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }

        // Fungsi Interaktif Modal Pop-Up Pembayaran UKT
        function openPaymentModal(name, nim, scheme, totalBill) {
            document.getElementById('modal-name').innerText = name;
            document.getElementById('modal-nim').innerText = nim;
            document.getElementById('modal-scheme').innerText = 'Jalur ' + scheme;
            document.getElementById('modal-total').innerText = 'Rp ' + totalBill.toLocaleString('id-ID');
            
            // Generate Nomor VA fiktif berbasis gabungan kode institusi (988) + NIM
            document.getElementById('modal-va').innerText = '988' + nim;

            const modal = document.getElementById('paymentModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('.transform').classList.remove('scale-95');
                modal.querySelector('.transform').classList.add('scale-100');
            }, 10);
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.classList.add('opacity-0');
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function copyToClipboard() {
            const vaNumber = document.getElementById('modal-va').innerText;
            navigator.clipboard.writeText(vaNumber);
            alert('✓ Nomor Virtual Account berhasil disalin ke papan klip: ' + vaNumber);
        }

        function simulateSuccessPayment() {
            alert('💸 Transaksi Sukses!\nSistem berhasil memverifikasi pembayaran UKT mahasiswa yang bersangkutan.');
            closePaymentModal();
        }
    </script>
</body>
</html>