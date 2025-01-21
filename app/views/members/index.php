<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KADA - Lembaga Kemajuan Pertanian Kemubu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2E7D32;    /* Dark green */
            --secondary-color: #4CAF50;  /* Medium green */
            --accent-color: #81C784;     /* Light green */
            --text-dark: #1B5E20;        /* Dark green text */
            --text-light: #E8F5E9;       /* Light green text */
            --background-overlay: rgba(255, 255, 255, 0.95); /* Light overlay */
        }

        body {
            background-image: url('/images/padi_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        /* Main content wrapper */
        .main-wrapper {
            flex: 1;
            padding: 2rem 0;
            margin-top: 100px; /* Add space for fixed header */
            min-height: calc(100vh - 200px); /* Adjust this value based on your footer height */
            display: flex;
            flex-direction: column;
        }

        .content-container {
            background-color: var(--background-overlay);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            max-width: 1400px;
            padding: 2rem;
            flex: 1;
        }

        /* Add this new style for the page wrapper */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Footer styles */
        footer {
            margin-top: auto;
            width: 100%;
        }

        /* Logo section */
        .logo-section {
            background-color: var(--background-overlay);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        /* Navigation */
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

        /* Keep your existing profile sidebar and other specific member styles */
        .profile-sidebar {
            background-color: var(--background-overlay);
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .member-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .member-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-active {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-pending {
            background-color: #fff3e0;
            color: #ef6c00;
        }

        .member-action-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .member-action-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .member-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .member-info-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .member-info-list li:last-child {
            border-bottom: none;
        }

        /* Profile Sidebar Styles */
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
            padding: 20px;
            background-color: var(--background-overlay);
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile-section img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .user-info {
            flex-grow: 1;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .sidebar-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .sidebar-scrollable {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .dropdown-header {
            padding: 10px;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item {
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .ms-auto {
            margin-left: auto !important;
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
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
                    <img src="<?= $user['profile_picture'] ?? '/images/default-avatar.png' ?>" alt="Pengguna" class="rounded-circle">
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

        <!-- Main content wrapper -->
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

                <!-- Welcome Section -->
                <section class="welcome-section py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card mb-4 position-relative">
                                <img src="/images/padi2.jpg" class="card-img" alt="KADA Padi Field" style="height: 600px; object-fit: cover;">
                                <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background: rgba(0, 0, 0, 0.5);">
                                    <div class="text-center text-white">
                                        <h2 class="mb-4 fw-bold">Selamat Datang ke KADA</h2>
                                        <p class="lead" style="max-width: 800px;">
                                            Lembaga Kemajuan Pertanian Kemubu (KADA) adalah sebuah agensi di bawah Kementerian Pertanian dan Keterjaminan Makanan yang bertanggungjawab memajukan sektor pertanian di kawasan Kemubu, Kelantan. KADA komited untuk meningkatkan hasil pertanian dan kesejahteraan para petani melalui pelbagai program pembangunan dan teknologi moden.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Sejarah section -->
                <section id="sejarah" class="py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0 text-center">Sejarah KADA</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-4 mb-3">
                                            <img src="/images/s1.jpg" class="img-fluid rounded" alt="Sejarah KADA 1" style="height: 200px; width: 100%; object-fit: cover;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="info-content h-100">
                                                <p>Disempurnakan penubuhannya pada 30 Mac 1972 melalui Akta 69, Akta Lembaga Pertanian Kemubu, 1972 dan dilancarkan dengan rasminya oleh Y.A.B. Tun Hj. Abdul Razak bin Hussein, Perdana Menteri Malaysia pada 2 Mac 1973.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-8">
                                            <div class="info-content h-100">
                                                <p>Setelah KADA diwujudkan, Kerajaan Negeri Kelantan pula menyusuli tindakan dengan meluluskan Enakmen Pihak Berkuasa Kemajuan Pertanian Kemubu, 1972 (Enakmen no.2 Tahun 1972 Kelantan) membolehkan Menteri Pertanian dan Perikanan melaksanakan Akta Lembaga Kemajuan Pertanian Kemubu, 1972 mulai 1 Ogos 1972.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <img src="/images/s2.jpg" class="img-fluid rounded" alt="Sejarah KADA 2" style="height: 200px; width: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <img src="/images/s3.png" class="img-fluid rounded" alt="Sejarah KADA 3" style="height: 200px; width: 100%; object-fit: cover;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="info-content h-100">
                                                <p>Kampung Kemubu terletak di tebing Sungai Kelantan, 30km dari Kota Bharu telah disemadikan namanya dalam lipatan sejarah KADA. Di situlah terbina sebuah rumah pam membekalkan air ke Rancangan Pengairan Kemubu (RPK), rancangan terbesar dalam gugusan rancangan-rancangan pengairan lain yang dipersatukan di bawah kuasa pengendalian KADA.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Modal for Application Options -->
                <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="applicationModalLabel">Pilih Halaman</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p class="mb-4">Sila pilih salah satu pilihan di bawah untuk meneruskan:</p>
                                <a href="/members/loans" class="btn btn-primary w-100 mb-2" style="font-size: 1.1rem; padding: 0.75rem;">Jenis Pinjaman</a>
                                <a href="/members/profile" class="btn btn-secondary w-100" style="font-size: 1.1rem; padding: 0.75rem;">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer stays outside wrapper -->
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Profile Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const profileSidebar = document.getElementById('profileSidebar');
            
            profileButton.addEventListener('click', function(e) {
                e.preventDefault();
                profileSidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileSidebar.contains(e.target) && !profileButton.contains(e.target)) {
                    profileSidebar.classList.remove('active');
                }
            });
        });
    </script>

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

    <script>
        // Update all logout links to show confirmation modal
        document.addEventListener('DOMContentLoaded', function() {
            const logoutLinks = document.querySelectorAll('a[href="/logout"]');
            logoutLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
                    logoutModal.show();
                });
            });
        });

        // Function to clear cache and handle logout
        function clearCacheAndLogout(event) {
            // Clear browser cache
            window.location.replace('/logout');
            
            // Prevent browser back button
            if (window.history && window.history.pushState) {
                window.history.pushState('', '', '/userlogin');
                window.onpopstate = function () {
                    window.history.pushState('', '', '/userlogin');
                };
            }
            
            // Clear localStorage if any
            localStorage.clear();
            
            // Clear sessionStorage
            sessionStorage.clear();
            
            return true;
        }
    </script>
</body>
</html>