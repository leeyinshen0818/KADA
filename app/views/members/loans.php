<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Skim Pembiayaan Ahli</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2E7D32;
            --secondary-color: #4CAF50;
            --accent-color: #81C784;
            --text-dark: #1B5E20;
            --text-light: #E8F5E9;
            --background-overlay: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Profile Sidebar */
        .profile-sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1031;
            display: flex;
            flex-direction: column;
        }

        .profile-sidebar.active {
            right: 0;
        }

        .user-profile-section {
            padding: 15px 20px;
            background-color: var(--background-overlay);
            border-bottom: 1px solid #eee;
        }

        .user-info {
            text-align: center;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .dropdown-header {
            padding: 0.5rem 1rem;
            margin-top: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-header i {
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }

        .dropdown-item {
            padding: 0.7rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
            text-decoration: none;
        }

        .dropdown-item i {
            color: var(--secondary-color);
            width: 20px;
            text-align: center;
        }

        .dropdown-item .fa-chevron-right {
            margin-left: auto;
            font-size: 0.8rem;
            color: #999;
        }

        /* Main content wrapper */
        .main-wrapper {
            flex: 1;
            padding: 2rem 0;
            margin-top: 100px;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            max-width: 1400px;
            padding: 2rem;
        }

        .loans-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            padding: 20px;
        }

        .loan-container {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-top: 4px solid var(--secondary-color);
        }

        .loan-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .loan-container h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .loan-features {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }

        .loan-features li {
            padding: 5px 0;
            color: #555;
            position: relative;
            padding-left: 25px;
        }

        .loan-features li:before {
            content: '✓';
            color: var(--secondary-color);
            position: absolute;
            left: 0;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .learn-more-button, .apply-button {
            padding: 8px 20px;
            border-radius: 5px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
            flex: 1;
            text-align: center;
            text-decoration: none;
        }

        .learn-more-button {
            background-color: var(--text-light);
            color: var(--primary-color);
        }

        .apply-button {
            background-color: var(--primary-color);
            color: white;
        }

        .learn-more-button:hover {
            background-color: var(--accent-color);
        }

        .apply-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Modal styles */
        .modal-content {
            border: none;
            border-radius: 8px;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .loan-details h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .loan-details ul {
            padding-left: 20px;
        }

        .loan-details ul ul {
            margin-top: 10px;
        }

        .loan-details li {
            margin-bottom: 8px;
        }

        /* Add styles for header, navigation, and sidebar */
        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .logo-section h1 {
            color: var(--primary-color);
            line-height: 1.2;
        }

        .main-nav {
            background-color: var(--primary-color);
            border-radius: 8px;
            margin: -1rem 1rem 2rem 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .main-nav .nav-link {
            color: var(--text-light) !important;
            padding: 1rem 1.5rem !important;
            font-weight: 400;
            transition: all 0.3s ease;
        }

        .main-nav .nav-link:hover {
            background-color: var(--secondary-color);
        }

        /* Footer styles */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        footer .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="logo-section">
        <div class="container">
            <div class="row align-items-center py-2">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <img src="/images/logo.jpg" alt="Logo KADA" class="img-fluid me-3" style="max-height: 70px; width: auto;">
                        <div class="d-flex flex-column">
                            <h1 class="mb-0 fs-4 fw-bold text-success">Lembaga Kemajuan Pertanian Kemubu</h1>
                            <span class="text-secondary fs-6">KADA</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="#" id="profileButton" class="nav-link">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Sidebar -->
    <div class="profile-sidebar" id="profileSidebar">
        <div class="sidebar-content">
            <!-- User Profile Section at Top (Fixed) -->
            <div class="user-profile-section">
                <div class="user-info">
                    <div class="user-name"><?= $pendingData['name'] ?? 'Nama Pengguna' ?></div>
                    <a href="/logout" class="btn btn-sm btn-success">Log Keluar</a>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="sidebar-scrollable">
                <!-- Profile Section -->
                <div class="dropdown-header">
                    <i class="fas fa-user"></i>Profil
                </div>
                <a class="dropdown-item" href="/members/profile">
                    <i class="fas fa-id-card"></i>
                    <span>Lihat Profil</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>

                <!-- Dashboard Section -->
                <div class="dropdown-header">
                    <i class="fas fa-th-large"></i>Papan Pemuka
                </div>
                <a class="dropdown-item" href="/members/dashboard">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Status Permohonan</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>

                <!-- My Saving Account -->
                <div class="dropdown-header">
                    <i class="fas fa-piggy-bank"></i>Simpanan Saya
                </div>
                <a class="dropdown-item" href="/members/saving_acc">
                    <i class="fas fa-wallet"></i>
                    <span>Akaun Simpanan Saya</span>
                    <i class="fas fa-chevron-right ms-auto"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
        <div class="content-container">
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light main-nav">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/members">UTAMA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/members/m_info">MAKLUMAT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/members/benefits">MANFAAT AHLI</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PINJAMAN</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/members/loans">Jenis Pinjaman</a></li>
                                    <li><a class="dropdown-item" href="/members/m_loanCalc">Kalkulator Pinjaman</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/members/customerService">PERKHIDMATAN PELANGGAN</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h2 class="mb-0 text-center">Skim Pembiayaan Untuk Ahli</h2>
                            </div>
                            <div class="card-body">
                                <div class="loans-grid">
                                    <!-- Al Bai -->
                                    <div class="loan-container">
                                        <h2>Pembiayaan Al Bai</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Patuh Syariah</li>
                                            <li>Proses yang telus</li>
                                            <li>Tiada cagaran diperlukan</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('albai')" class="learn-more-button">Maklumat Lanjut</button>
                                            <button onclick="checkProfileStatus()" class="apply-button">Mohon Sekarang</button>
                                        </div>
                                    </div>

                                    <!-- Al Innah -->
                                    <div class="loan-container">
                                        <h2>Pembiayaan Al Innah</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Fleksibel dan mudah</li>
                                            <li>Proses kelulusan cepat</li>
                                            <li>Terma yang menarik</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('alinnah')" class="learn-more-button">Maklumat Lanjut</button>
                                            <button onclick="checkProfileStatus()" class="apply-button">Mohon Sekarang</button>
                                        </div>
                                    </div>

                                    <!-- Skim Khas -->
                                    <div class="loan-container">
                                        <h2>Pembiayaan Skim Khas</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Kelulusan segera</li>
                                            <li>Bayaran bulanan tetap</li>
                                            <li>Tiada penalti penyelesaian awal</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('peribadi')" class="learn-more-button">Maklumat Lanjut</button>
                                            <button onclick="checkProfileStatus()" class="apply-button">Mohon Sekarang</button>
                                        </div>
                                    </div>

                                    <!-- Road Tax & Insuran -->
                                    <div class="loan-container">
                                        <h2>Pembiayaan Road Tax & Insuran</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Kadar yang kompetitif</li>
                                            <li>Proses mudah</li>
                                            <li>Perlindungan komprehensif</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('kenderaan')" class="learn-more-button">Maklumat Lanjut</button>
                                            <button onclick="checkProfileStatus()" class="apply-button">Mohon Sekarang</button>
                                        </div>
                                    </div>

                                    <!-- Al Qardhul Hasan -->
                                    <div class="loan-container">
                                        <h2>Pembiayaan Al Qardhul Hasan</h2>
                                        <p>Kadar: 4.2% setahun</p>
                                        <ul class="loan-features">
                                            <li>Tempoh fleksibel</li>
                                            <li>Margin sehingga 90%</li>
                                            <li>Perlindungan takaful</li>
                                        </ul>
                                        <div class="button-group">
                                            <button onclick="showDetails('perumahan')" class="learn-more-button">Maklumat Lanjut</button>
                                            <button onclick="checkProfileStatus()" class="apply-button">Mohon Sekarang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-3" id="contactInfo">
        <div class="container">
            <div class="row justify-content-center text-center g-4">
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Hubungi Kami</h6>
                    <address class="small mb-0">
                        Lembaga Kemajuan Pertanian Kemubu<br>
                        Peti Surat 127, Bandar Kota Bharu,<br>
                        15710 Kota Bharu, Kelantan<br>
                        <i class="fas fa-phone"></i> +60 97455388<br>
                        <i class="fas fa-envelope"></i> prokada@kada.gov.my
                    </address>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Imbas QR</h6>
                    <img src="/images/QR.jpg" alt="QR Code" class="qr-code" 
                         style="max-width: 70px; cursor: pointer;" 
                         onclick="openQRModal(this.src)">
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Ikuti Kami</h6>
                    <div class="social-links">
                        <a href="https://www.facebook.com/kadakemubu/" class="text-light">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                    <div class="mt-2 small">
                        <small>&copy; 2023 KADA. Semua hak terpelihara.</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Loan Details Modal -->
    <div class="modal fade" id="loanDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title fw-bold" id="modalTitle"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="modalContent" class="loan-details">
                        <!-- Content will be inserted here by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add QR Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <img src="" id="modalQRImage" class="img-fluid" alt="QR Code Large">
                    <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this modal for profile status -->
    <div class="modal fade" id="profileStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold">Status Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p id="profileStatusMessage" class="text-danger fw-bold"></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutConfirmModalLabel">Pengesahan Log Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Adakah anda pasti untuk log keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="/logout" class="btn btn-danger" onclick="clearCacheAndLogout(event)">Log Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loanInfo = {
            albai: {
                title: "Pembiayaan Al Bai",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al Bai</h3>
                    <p>Pembiayaan Al Bai adalah skim pembiayaan yang mematuhi prinsip Syariah:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah pembiayaan: RM1,000 - RM50,000</li>
                        <li>Dokumen yang diperlukan:
                            <ul>
                                <li>Salinan Kad Pengenalan</li>
                                <li>Slip gaji 3 bulan terkini</li>
                                <li>Penyata bank 3 bulan terkini</li>
                            </ul>
                        </li>
                    </ul>`
            },
            alinnah: {
                title: "Pembiayaan Al Innah",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al Innah</h3>
                    <p>Pembiayaan Al Innah menawarkan penyelesaian kewangan yang fleksibel:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah pembiayaan: RM1,000 - RM50,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Proses kelulusan yang cepat</li>
                                <li>Tiada cagaran diperlukan</li>
                                <li>Terma yang fleksibel</li>
                            </ul>
                        </li>
                    </ul>`
            },
            peribadi: {
                title: "Pembiayaan Skim Khas",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Skim Khas</h3>
                    <p>Pembiayaan peribadi untuk pelbagai keperluan anda:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: 1 - 10 tahun</li>
                        <li>Jumlah pembiayaan: RM1,000 - RM100,000</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kelulusan segera</li>
                                <li>Bayaran bulanan tetap</li>
                                <li>Tiada penalti penyelesaian awal</li>
                            </ul>
                        </li>
                    </ul>`
            },
            kenderaan: {
                title: "Pembiayaan Road Tax & Insuran",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Road Tax & Insuran</h3>
                    <p>Pembiayaan kenderaan yang komprehensif:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: sehingga 9 tahun</li>
                        <li>Margin pembiayaan: sehingga 90%</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kadar yang kompetitif</li>
                                <li>Proses dokumentasi yang mudah</li>
                                <li>Perlindungan takaful komprehensif</li>
                            </ul>
                        </li>
                    </ul>`
            },
            perumahan: {
                title: "Pembiayaan Al Qardhul Hasan",
                content: `
                    <h3>Maklumat Terperinci Pembiayaan Al Qardhul Hasan</h3>
                    <p>Pembiayaan perumahan yang komprehensif untuk rumah idaman anda:</p>
                    <ul>
                        <li>Kadar keuntungan: 4.2% setahun</li>
                        <li>Tempoh pembiayaan: sehingga 35 tahun</li>
                        <li>Margin pembiayaan: sehingga 90%</li>
                        <li>Kelebihan:
                            <ul>
                                <li>Kadar pembiayaan yang kompetitif</li>
                                <li>Tempoh pembayaran yang fleksibel</li>
                                <li>Proses dokumentasi yang mudah</li>
                                <li>Perlindungan takaful komprehensif</li>
                            </ul>
                        </li>
                        <li>Dokumen yang diperlukan:
                            <ul>
                                <li>Salinan Kad Pengenalan</li>
                                <li>Slip gaji 3 bulan terkini</li>
                                <li>Penyata bank 6 bulan terkini</li>
                                <li>Surat Tawaran Pekerjaan</li>
                                <li>Dokumen berkaitan hartanah</li>
                            </ul>
                        </li>
                    </ul>`
            }
        };

        function showDetails(loanType) {
            const modal = new bootstrap.Modal(document.getElementById('loanDetailsModal'));
            document.getElementById('modalTitle').textContent = loanInfo[loanType].title;
            document.getElementById('modalContent').innerHTML = loanInfo[loanType].content;
            modal.show();
        }

        // Updated script for sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profileSidebar = document.getElementById('profileSidebar');
            const body = document.body;
            
            profileButton.addEventListener('click', function(e) {
                e.preventDefault();
                profileSidebar.classList.toggle('active');
                // Prevent body scroll when sidebar is open
                if (profileSidebar.classList.contains('active')) {
                    body.style.overflow = 'hidden';
                } else {
                    body.style.overflow = '';
                }
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileSidebar.contains(e.target) && !profileButton.contains(e.target)) {
                    profileSidebar.classList.remove('active');
                    body.style.overflow = '';
                }
            });

            // Update all logout links to show confirmation modal
            const logoutLinks = document.querySelectorAll('a[href="/logout"]');
            logoutLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
                    logoutModal.show();
                });
            });
        });

        function openQRModal(imgSrc) {
            document.getElementById('modalQRImage').src = imgSrc;
            new bootstrap.Modal(document.getElementById('qrModal')).show();
        }

        function checkProfileStatus() {
            fetch('/members/check-profile-status')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'approved') {
                        window.location.href = '/registerLoan';
                    } else {
                        const modal = new bootstrap.Modal(document.getElementById('profileStatusModal'));
                        let message = '';
                        switch(data.status) {
                            case 'pending':
                                message = 'Profil anda masih dalam proses semakan. Sila tunggu sehingga profil anda diluluskan untuk memohon pinjaman.';
                                break;
                            case 'rejected':
                                message = 'Maaf, profil anda telah ditolak. Sila hubungi pihak pentadbir untuk maklumat lanjut.';
                                break;
                            default:
                                message = 'Sila lengkapkan pendaftaran profil anda terlebih dahulu sebelum memohon pinjaman.';
                        }
                        const messageElement = document.getElementById('profileStatusMessage');
                        messageElement.textContent = message;
                        messageElement.className = 'text-danger fw-bold';
                        modal.show();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ralat semasa menyemak status profil. Sila cuba lagi.');
                });
        }

        function clearCacheAndLogout(event) {
            window.location.replace('/logout');
            
            if (window.history && window.history.pushState) {
                window.history.pushState('', '', '/userlogin');
                window.onpopstate = function () {
                    window.history.pushState('', '', '/userlogin');
                };
            }
            
            localStorage.clear();
            sessionStorage.clear();
            
            return true;
        }
    </script>
</body>
</html>