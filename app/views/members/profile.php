<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Add Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body class="bg-gradient">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success bg-gradient mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/members">
                <img src="/images/logo.jpg" alt="Koperasi Logo" class="navbar-logo me-2">
                Sistem Koperasi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/members">
                            <i class="fas fa-home me-1"></i> Laman Utama
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/member-profile">
                            <i class="fas fa-user me-1"></i> Profil
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Only Error Message Display -->
        <?php if (isset($error_message) || isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Notice:</strong> 
                <?= isset($error_message) ? htmlspecialchars($error_message) : htmlspecialchars($_SESSION['error_message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Member Status Display -->
        <?php if (isset($memberStatus) && $memberStatus !== 'approved'): ?>
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Status Keahlian: <?= ucfirst($memberStatus ?? 'Dalam Proses') ?></h4>
                <p>Beberapa ciri hanya tersedia untuk ahli yang diluluskan. Sila tunggu permohonan keahlian anda diproses.</p>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($pendingData) && $pendingData): ?>
            <div class="card shadow-lg rounded-4 border-0 animate__animated animate__fadeIn">
                <div class="card-header bg-success-subtle text-success py-4 rounded-top-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-circle me-2"></i>Member Profile
                            <div class="mt-3">
                                <?php
                                $statusClass = '';
                                $statusText = '';
                                
                                switch($pendingData['status']) {
                                    case 'approved':
                                        $statusClass = 'bg-success';
                                        $statusText = 'Diluluskan';
                                        break;
                                    case 'rejected':
                                        $statusClass = 'bg-danger';
                                        $statusText = 'Ditolak';
                                        break;
                                    default:
                                        $statusClass = 'bg-warning text-dark';
                                        $statusText = 'Dalam Proses';
                                }
                                ?>
                                <span class="badge <?= $statusClass ?> fs-6 py-2 px-4 rounded-pill">
                                    <i class="fas <?= ($pendingData['status'] === 'approved') ? 'fa-check-circle' : 
                                                  (($pendingData['status'] === 'rejected') ? 'fa-times-circle' : 'fa-clock') ?> me-2"></i>
                                    <?= $statusText ?>
                                </span>
                            </div>
                        </h4>
                        <!-- Add Edit Button -->
                        <a href="/members/edit-profile" class="btn btn-light">
                            <i class="fas fa-edit me-2"></i>Kemaskini Profil
                        </a>
                    </div>
                </div>

                <?php if ($pendingData['status'] === 'rejected' && isset($pendingData['admin_remark'])): ?>
                    <div class="rejection-notice alert alert-danger mx-4 mt-4 animate__animated animate__fadeIn">
                        <h5 class="alert-heading">
                            <i class="fas fa-exclamation-circle me-2"></i>Rejection Reason:
                        </h5>
                        <p class="mb-0"><?= htmlspecialchars($pendingData['admin_remark']) ?></p>
                        <hr>
                        <p class="mb-0 small">
                            <i class="fas fa-info-circle me-2"></i>
                            Please review the reason above and submit a new application addressing these concerns.
                        </p>
                    </div>
                <?php endif; ?>

                <div class="card-body p-4 bg-white">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card border-0 shadow-sm h-100 hover-shadow">
                                <div class="card-body position-relative">
                                    <div class="ribbon bg-success text-white">Peribadi</div>
                                    <h5 class="card-title text-success mb-3 mt-2">
                                        <i class="fas fa-user me-2"></i>Maklumat Peribadi
                                    </h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th class="text-muted">Nama</th>
                                            <td><?= htmlspecialchars($pendingData['name']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">No. KP</th>
                                            <td><?= htmlspecialchars($pendingData['ic_no']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Jantina</th>
                                            <td><?= htmlspecialchars($pendingData['gender']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Agama</th>
                                            <td><?= htmlspecialchars($pendingData['religion']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Bangsa</th>
                                            <td><?= htmlspecialchars($pendingData['race']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Status Perkahwinan</th>
                                            <td><?= htmlspecialchars($pendingData['marital_status']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card border-0 shadow-sm h-100 hover-shadow">
                                <div class="card-body position-relative">
                                    <div class="ribbon bg-success text-white">Pekerjaan</div>
                                    <h5 class="card-title text-success mb-3 mt-2">
                                        <i class="fas fa-briefcase me-2"></i>Maklumat Pekerjaan
                                    </h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th class="text-muted">No. Ahli</th>
                                            <td><?= htmlspecialchars($pendingData['member_number']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">No. PF</th>
                                            <td><?= htmlspecialchars($pendingData['pf_number']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Jawatan</th>
                                            <td><?= htmlspecialchars($pendingData['position']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Gred</th>
                                            <td><?= htmlspecialchars($pendingData['grade']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Gaji Bulanan</th>
                                            <td>RM <?= number_format($pendingData['monthly_salary'], 2) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card border-0 shadow-sm h-100 hover-shadow">
                                <div class="card-body position-relative">
                                    <div class="ribbon bg-success text-white">Hubungan</div>
                                    <h5 class="card-title text-success mb-3 mt-2">
                                        <i class="fas fa-address-card me-2"></i>Maklumat Perhubungan
                                    </h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th class="text-muted">Alamat Rumah</th>
                                            <td><?= htmlspecialchars($pendingData['home_address']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Kod Pos Rumah</th>
                                            <td><?= htmlspecialchars($pendingData['home_postcode']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Negeri Rumah</th>
                                            <td><?= htmlspecialchars($pendingData['home_state']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Telefon Kantor</th>
                                            <td><?= htmlspecialchars($pendingData['office_phone']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Telefon Rumah</th>
                                            <td><?= htmlspecialchars($pendingData['home_phone']) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Fax</th>
                                            <td><?= htmlspecialchars($pendingData['fax']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow-lg rounded-4 border-0 text-center py-5 hover-shadow animate__animated animate__fadeIn">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="empty-state-icon">
                            <i class="fas fa-user-plus text-primary opacity-75"></i>
                        </div>
                    </div>
                    <h4 class="text-primary">No Pending Registration</h4>
                    <p class="mb-4 text-muted">You haven't submitted your membership application yet.</p>
                    <a href="/member-profile" class="btn btn-primary btn-lg rounded-pill px-5 animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-plus-circle me-2"></i>Submit Application
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- After the existing cards, add this new section -->
        <?php if (!empty($pendingData) && !empty($pendingData['family_members'])): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm hover-shadow">
                        <div class="card-body position-relative">
                            <div class="ribbon bg-success text-white">Keluarga</div>
                            <h5 class="card-title text-success mb-4">
                                <i class="fas fa-users me-2"></i>Maklumat Ahli Keluarga
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="fw-semibold">Nama</th>
                                            <th class="fw-semibold">No. Kad Pengenalan</th>
                                            <th class="fw-semibold">Hubungan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pendingData['family_members'] as $family): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($family['name']) ?></td>
                                                <td><?= htmlspecialchars($family['ic_no']) ?></td>
                                                <td>
                                                    <?php
                                                    $relationships = [
                                                        'Spouse' => 'Pasangan',
                                                        'Child' => 'Anak',
                                                        'Parent' => 'Ibu/Bapa',
                                                        'Sibling' => 'Adik-beradik'
                                                    ];
                                                    echo $relationships[$family['relationship']] ?? $family['relationship'];
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

<style>
/* Modern gradient background */
.bg-gradient {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Enhanced card hover effects */
.hover-shadow {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(40, 167, 69, 0.15)!important;
}

/* Stylish ribbon design */
.ribbon {
    position: absolute;
    top: 10px;
    right: -15px;
    padding: 3px 15px;
    background: linear-gradient(45deg, #28a745 0%, #20c997 100%);
    color: white;
    transform: rotate(45deg);
    font-size: 0.8rem;
    z-index: 1;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Table styling */
.table th {
    font-weight: 600;
    width: 40%;
    color: #4a5568;
}

.table td {
    color: #2d3748;
}

/* Card styling */
.card {
    overflow: hidden;
    transition: all 0.3s ease;
    border-radius: 10px;
}

/* Empty state icon styling */
.empty-state-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(78, 115, 223, 0.1);
    border-radius: 50%;
}

.empty-state-icon i {
    font-size: 3rem;
}

/* Enhanced section cards */
.card-body {
    position: relative;
    padding: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}

/* Animated elements */
.animate__animated {
    animation-duration: 0.8s;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #4e73df;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #224abe;
}

.navbar-logo {
    height: 40px;
    width: auto;
    border-radius: 4px;
    object-fit: contain;
}

/* For mobile responsiveness */
@media (max-width: 768px) {
    .navbar-logo {
        height: 32px;
    }
}

/* Enhanced styles for a more professional look */
.table {
    font-size: 0.95rem;
}

.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    padding: 1rem;
    font-weight: 600;
    color: #2c3e50;
}

.table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}

.table-hover tbody tr:hover {
    background-color: rgba(40, 167, 69, 0.05);
}

.card {
    border-radius: 0.75rem;
    overflow: hidden;
}

.card-body {
    padding: 1.5rem;
}

.ribbon {
    position: absolute;
    top: 10px;
    right: -15px;
    padding: 3px 15px;
    background: linear-gradient(45deg, #28a745 0%, #20c997 100%);
    color: white;
    transform: rotate(45deg);
    font-size: 0.8rem;
    z-index: 1;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.text-muted {
    color: #6c757d !important;
}

.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08) !important;
}
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
