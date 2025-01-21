<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Pemuka Ahli - KOPERASI KAKITANGAN KADA KELANTAN BHD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    :root {
        --primary-color: #2E7D32;
        --secondary-color: #4CAF50;
        --background-color: #F5F8F5;
        --card-color: #FFFFFF;
        --text-color: #1C1C1C;
        --border-color: #E8F5E9;
        --pending-color: #FFA000;
        --approved-color: #2E7D32;
        --rejected-color: #D32F2F;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .main-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .welcome-section {
        background: var(--primary-color);
        color: white;
        border-radius: 10px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        text-align: left;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .status-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .status-card {
        background: var(--card-color);
        border-radius: 10px;
        padding: 1.75rem;
        text-align: left;
        transition: transform 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border: none;
        position: relative;
        overflow: hidden;
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--secondary-color);
    }

    .status-card.pending::before { background: var(--pending-color); }
    .status-card.approved::before { background: var(--approved-color); }
    .status-card.rejected::before { background: var(--rejected-color); }

    .status-icon {
        font-size: 1.75rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .pending .status-icon { color: var(--pending-color); }
    .approved .status-icon { color: var(--approved-color); }
    .rejected .status-icon { color: var(--rejected-color); }

    .status-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    .status-count {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .applications-table {
        background: var(--card-color);
        border-radius: 10px;
        padding: 1.75rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        background-color: var(--border-color);
        border-bottom: none;
        padding: 1rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-badge.status-pending {
        background-color: #FFF7ED;
        color: #92400E;
    }

    .status-badge.status-approved {
        background-color: #F0FDF4;
        color: #166534;
    }

    .status-badge.status-rejected {
        background-color: #FEF2F2;
        color: #991B1B;
    }

    .btn-details {
        background-color: var(--primary-color);
        color: white;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-details:hover {
        background-color: #1B5E20;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-state i {
        font-size: 3rem;
        color: #94A3B8;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .status-cards {
            grid-template-columns: 1fr;
        }

        .main-container {
            padding: 1rem;
        }
    }

    .modal-content {
        border-radius: 10px;
        border: none;
    }

    .modal-header {
        background-color: var(--border-color);
        border-bottom: none;
        border-radius: 10px 10px 0 0;
    }

    .modal-footer {
        border-top: none;
        padding: 1.5rem;
    }

    .welcome-logo {
        width: 100px;
        height: auto;
        border-radius: 8px;
        object-fit: contain;
    }
</style>
<body>
    <div class="main-container">
        <!-- Back button -->
        <div class="mb-4">
            <a href="/members" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman Utama
            </a>
        </div>

        <!-- Updated Welcome Section -->
        <div class="welcome-section">
            <div class="d-flex align-items-center">
                <img src="/images/logo.jpg" alt="KOPERASI KAKITANGAN KADA KELANTAN BHD Logo" class="welcome-logo me-4">
                <div>
                    <h1 class="h3 mb-3">Papan Pemuka Ahli</h1>
                    <h2 class="h4 mb-2"><?php echo htmlspecialchars($member->full_name ?? 'Tetamu'); ?></h2>
                    <p class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Log Masuk Terakhir: <?php echo date('d M Y, H:i A', strtotime($member->last_login ?? 'now')); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="status-cards">
            <div class="status-card pending">
                <div class="status-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="status-title">Dalam Proses</div>
                <div class="status-count"><?php echo count(array_filter($applications, fn($a) => strtoupper($a['status']) === 'PENDING')); ?></div>
            </div>
            <div class="status-card approved">
                <div class="status-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="status-title">Diluluskan</div>
                <div class="status-count"><?php echo count(array_filter($applications, fn($a) => strtoupper($a['status']) === 'APPROVED')); ?></div>
            </div>
            <div class="status-card rejected">
                <div class="status-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="status-title">Ditolak</div>
                <div class="status-count"><?php echo count(array_filter($applications, fn($a) => strtoupper($a['status']) === 'REJECTED')); ?></div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="applications-table">
            <?php if (!empty($applications)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Rujukan</th>
                                <th>Jenis Pembiayaan</th>
                                <th>Tarikh Mohon</th>
                                <th>Jumlah (RM)</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applications as $application): ?>
                                <tr>
                                    <td class="fw-medium">#<?php echo htmlspecialchars($application['id']); ?></td>
                                    <td><?php echo htmlspecialchars($application['loan_type']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($application['created_at'])); ?></td>
                                    <td class="fw-medium"><?php echo number_format($application['t_amount'], 2); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower($application['status']); ?>">
                                            <?php echo getStatusText($application['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-details btn-sm" data-bs-toggle="modal" data-bs-target="#loanModal<?php echo $application['id']; ?>">
                                            Lihat Butiran
                                        </button>
                                    </td>
                                </tr>

                                <!-- Update the Modal for Loan Details -->
                                <div class="modal fade" id="loanModal<?php echo $application['id']; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Butiran Pinjaman #<?php echo htmlspecialchars($application['id']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <strong>Jenis Pembiayaan:</strong>
                                                    <p><?php echo htmlspecialchars($application['loan_type']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Jumlah:</strong>
                                                    <p>RM <?php echo number_format($application['t_amount'], 2); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Tarikh Mohon:</strong>
                                                    <p><?php echo date('d/m/Y', strtotime($application['created_at'])); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Status:</strong>
                                                    <span class="status-badge status-<?php echo strtolower($application['status']); ?>">
                                                        <?php echo getStatusText($application['status']); ?>
                                                    </span>
                                                </div>
                                                <?php if ($application['status'] === 'rejected' && !empty($application['admin_remark'])): ?>
                                                    <div class="alert alert-danger">
                                                        <h6 class="alert-heading">Sebab Penolakan:</h6>
                                                        <p class="mb-0"><?php echo nl2br(htmlspecialchars($application['admin_remark'])); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p class="text-muted">Anda belum membuat sebarang permohonan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function getStatusText($status) {
    switch(strtolower($status)) {
        case 'pending':
            return 'Dalam Proses';
        case 'approved':
            return 'Diluluskan';
        case 'rejected':
            return 'Dibatalkan';
        default:
            return 'Tidak Diketahui';
    }
}
?>