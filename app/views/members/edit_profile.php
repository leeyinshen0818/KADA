<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemaskini Profil Ahli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient">
    <div class="container mt-4">
        <!-- Back button -->
        <div class="mb-4">
            <a href="/member-profile" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Profil
            </a>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg rounded-4 border-0 animate__animated animate__fadeIn">
            <div class="card-header bg-success bg-gradient text-white py-4 rounded-top-4">
                <h4 class="mb-0 text-center">
                    <i class="fas fa-user-edit me-2"></i>Kemaskini Profil Ahli
                </h4>
            </div>

            <div class="card-body p-4">
                <form action="/members/update-profile" method="POST" class="needs-validation" novalidate>
                    <!-- Personal Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body position-relative">
                            <div class="ribbon bg-success text-white">Peribadi</div>
                            <h5 class="card-title text-success mb-4">
                                <i class="fas fa-user me-2"></i>Maklumat Peribadi
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Penuh</label>
                                    <input type="text" class="form-control" name="name" 
                                           value="<?= htmlspecialchars($pendingData['name'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Kad Pengenalan</label>
                                    <input type="text" class="form-control" name="ic_no" 
                                           value="<?= htmlspecialchars($pendingData['ic_no'] ?? '') ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jantina</label>
                                    <select class="form-select" name="gender" required>
                                        <option value="Male" <?= ($pendingData['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Lelaki</option>
                                        <option value="Female" <?= ($pendingData['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Agama</label>
                                    <input type="text" class="form-control" name="religion" 
                                           value="<?= htmlspecialchars($pendingData['religion'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bangsa</label>
                                    <input type="text" class="form-control" name="race" 
                                           value="<?= htmlspecialchars($pendingData['race'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Perkahwinan</label>
                                    <select class="form-select" name="marital_status" required>
                                        <option value="Single" <?= ($pendingData['marital_status'] ?? '') === 'Single' ? 'selected' : '' ?>>Bujang</option>
                                        <option value="Married" <?= ($pendingData['marital_status'] ?? '') === 'Married' ? 'selected' : '' ?>>Berkahwin</option>
                                        <option value="Divorced" <?= ($pendingData['marital_status'] ?? '') === 'Divorced' ? 'selected' : '' ?>>Bercerai</option>
                                        <option value="Widowed" <?= ($pendingData['marital_status'] ?? '') === 'Widowed' ? 'selected' : '' ?>>Balu/Duda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body position-relative">
                            <div class="ribbon bg-success text-white">Pekerjaan</div>
                            <h5 class="card-title text-success mb-4">
                                <i class="fas fa-briefcase me-2"></i>Maklumat Pekerjaan
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">No. Ahli</label>
                                    <input type="text" class="form-control" name="member_number" 
                                           value="<?= htmlspecialchars($pendingData['member_number'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. PF</label>
                                    <input type="text" class="form-control" name="pf_number" 
                                           value="<?= htmlspecialchars($pendingData['pf_number'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jawatan</label>
                                    <input type="text" class="form-control" name="position" 
                                           value="<?= htmlspecialchars($pendingData['position'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Gred</label>
                                    <input type="text" class="form-control" name="grade" 
                                           value="<?= htmlspecialchars($pendingData['grade'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Gaji Bulanan</label>
                                    <input type="number" step="0.01" class="form-control" name="monthly_salary" 
                                           value="<?= htmlspecialchars($pendingData['monthly_salary'] ?? '') ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body position-relative">
                            <div class="ribbon bg-success text-white">Hubungan</div>
                            <h5 class="card-title text-success mb-4">
                                <i class="fas fa-address-card me-2"></i>Maklumat Perhubungan
                            </h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Alamat Rumah</label>
                                    <textarea class="form-control" name="home_address" rows="2" required><?= htmlspecialchars($pendingData['home_address'] ?? '') ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Poskod Rumah</label>
                                    <input type="text" class="form-control" name="home_postcode" 
                                           value="<?= htmlspecialchars($pendingData['home_postcode'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Negeri Rumah</label>
                                    <select class="form-select" name="home_state" required>
                                        <?php
                                        $states = ['Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan', 'Pahang', 
                                                  'Perak', 'Perlis', 'Pulau Pinang', 'Sabah', 'Sarawak', 'Selangor', 
                                                  'Terengganu', 'Wilayah Persekutuan Kuala Lumpur', 'Wilayah Persekutuan Labuan', 
                                                  'Wilayah Persekutuan Putrajaya'];
                                        foreach ($states as $state): ?>
                                            <option value="<?= $state ?>" <?= ($pendingData['home_state'] ?? '') === $state ? 'selected' : '' ?>><?= $state ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Telefon Kantor</label>
                                    <input type="text" class="form-control" name="office_phone" 
                                           value="<?= htmlspecialchars($pendingData['office_phone'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Telefon Rumah</label>
                                    <input type="text" class="form-control" name="home_phone" 
                                           value="<?= htmlspecialchars($pendingData['home_phone'] ?? '') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Fax</label>
                                    <input type="text" class="form-control" name="fax" 
                                           value="<?= htmlspecialchars($pendingData['fax'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Family Members -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body position-relative">
                            <div class="ribbon bg-success text-white">Keluarga</div>
                            <h5 class="card-title text-success mb-4">
                                <i class="fas fa-users me-2"></i>Maklumat Ahli Keluarga
                                <button type="button" class="btn btn-success btn-sm float-end" id="add-family-member">
                                    <i class="fas fa-plus me-1"></i>Tambah Ahli Keluarga
                                </button>
                            </h5>
                            
                            <div id="family-members-container">
                                <?php 
                                $familyMembers = $pendingData['family_members'] ?? [['name' => '', 'ic_no' => '', 'relationship' => '']];
                                foreach ($familyMembers as $index => $family): 
                                ?>
                                    <div class="family-member-entry border rounded p-3 mb-3 bg-light">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Nama Ahli Keluarga</label>
                                                <input type="text" class="form-control" 
                                                       name="family_members[<?= $index ?>][name]" 
                                                       value="<?= htmlspecialchars($family['name']) ?>" 
                                                       placeholder="Masukkan nama penuh"
                                                       required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">No. Kad Pengenalan</label>
                                                <input type="text" class="form-control" 
                                                       name="family_members[<?= $index ?>][ic_no]" 
                                                       value="<?= htmlspecialchars($family['ic_no']) ?>" 
                                                       placeholder="Contoh: 890123045678"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">Hubungan</label>
                                                <select class="form-select" name="family_members[<?= $index ?>][relationship]" required>
                                                    <option value="">Pilih Hubungan</option>
                                                    <option value="Spouse" <?= ($family['relationship'] ?? '') === 'Spouse' ? 'selected' : '' ?>>Pasangan</option>
                                                    <option value="Child" <?= ($family['relationship'] ?? '') === 'Child' ? 'selected' : '' ?>>Anak</option>
                                                    <option value="Parent" <?= ($family['relationship'] ?? '') === 'Parent' ? 'selected' : '' ?>>Ibu/Bapa</option>
                                                    <option value="Sibling" <?= ($family['relationship'] ?? '') === 'Sibling' ? 'selected' : '' ?>>Adik-beradik</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <?php if ($index > 0): ?>
                                                    <button type="button" class="btn btn-danger remove-family-member" title="Buang Ahli Keluarga">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
    /* Copy the existing styles from profile.php */
    .bg-gradient {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .hover-shadow {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(40, 167, 69, 0.15)!important;
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

    .form-control, .form-select {
        border: 1px solid #ced4da;
        padding: 0.5rem 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    /* Enhanced professional styles */
    .form-control, .form-select {
        padding: 0.625rem 0.875rem;
        font-size: 0.95rem;
        border-color: #dee2e6;
        border-radius: 0.5rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
    }

    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .family-member-entry {
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .family-member-entry:hover {
        background-color: #f8f9fa;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .card {
        border-radius: 0.75rem;
        overflow: hidden;
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

    /* Add these styles for better button interactions */
    .btn-success, .btn-danger {
        transition: all 0.2s ease;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .family-member-entry {
        transition: all 0.3s ease;
    }

    .family-member-entry:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    /* Animation for new entries */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .family-member-entry {
        animation: slideDown 0.3s ease;
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('family-members-container');
        const addButton = document.getElementById('add-family-member');

        // Function to create new family member entry
        function createFamilyMemberEntry(index) {
            return `
                <div class="family-member-entry border rounded p-3 mb-3 bg-light">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nama Ahli Keluarga</label>
                            <input type="text" class="form-control" 
                                   name="family_members[${index}][name]" 
                                   placeholder="Masukkan nama penuh"
                                   required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">No. Kad Pengenalan</label>
                            <input type="text" class="form-control" 
                                   name="family_members[${index}][ic_no]" 
                                   placeholder="Contoh: 890123045678"
                                   required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Hubungan</label>
                            <select class="form-select" name="family_members[${index}][relationship]" required>
                                <option value="">Pilih Hubungan</option>
                                <option value="Spouse">Pasangan</option>
                                <option value="Child">Anak</option>
                                <option value="Parent">Ibu/Bapa</option>
                                <option value="Sibling">Adik-beradik</option>
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-family-member" title="Buang Ahli Keluarga">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        // Add new family member
        addButton.addEventListener('click', function() {
            const currentCount = container.querySelectorAll('.family-member-entry').length;
            const newMemberHtml = createFamilyMemberEntry(currentCount);
            container.insertAdjacentHTML('beforeend', newMemberHtml);
        });

        // Remove family member
        container.addEventListener('click', function(e) {
            const removeButton = e.target.closest('.remove-family-member');
            if (removeButton) {
                const entry = removeButton.closest('.family-member-entry');
                const entriesCount = container.querySelectorAll('.family-member-entry').length;
                
                if (entriesCount > 1) {
                    entry.remove();
                    
                    // Reindex remaining entries
                    const entries = container.querySelectorAll('.family-member-entry');
                    entries.forEach((entry, index) => {
                        entry.querySelectorAll('input, select').forEach(input => {
                            const name = input.getAttribute('name');
                            if (name) {
                                input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                            }
                        });
                    });
                } else {
                    // If it's the last entry, just clear the fields
                    entry.querySelectorAll('input, select').forEach(input => {
                        input.value = '';
                    });
                }
            }
        });

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    </script>
</body>
</html>
