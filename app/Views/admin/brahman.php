<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?> - Shopping Admin - Brahman Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('css/admin.css') ?>" rel="stylesheet">
    <style>
        .main-content {
            margin-left: 250px;
        }
        .table td {
            vertical-align: middle;
        }
        .image-container {
            max-width: 100px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
        }
        /* Center SL No column */
        .table th:first-child,
        .table td:first-child {
            text-align: center;
        }
        /* Center status toggle column */
        .table td:last-child {
            text-align: center;
        }
        .toggle-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }
        .form-check {
            display: inline-block;
        }
        .form-check-label {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .switch-text-active,
        .switch-text-inactive {
            display: none;
            font-size: 0.875rem;
            color:rgb(255, 255, 255);
        }
        .status-toggle:checked + .form-check-label .switch-text-active {
            display: inline;
        }
        .status-toggle:not(:checked) + .form-check-label .switch-text-inactive {
            display: inline;
        }
        /* Custom colors */
        .form-check-input:checked[type="checkbox"] {
            background-color: #198754 !important;
            border-color: #198754 !important;
        }
        .form-check-input:not(:checked)[type="checkbox"] {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
        .form-check-input:checked[type="checkbox"] ~ .form-check-label::before {
            background-color: #198754 !important;
        }
        .form-check-input:not(:checked)[type="checkbox"] ~ .form-check-label::before {
            background-color: #dc3545 !important;
        }
        /* Toggle switch circle */
        .form-check-input[type="checkbox"] + .form-check-label::after {
            background-color: #fff !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all toggle switches
            const toggleSwitches = document.querySelectorAll('.status-toggle');
            toggleSwitches.forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const brahmanId = this.dataset.id;
                    const status = this.checked ? 'active' : 'inactive';
                    const url = `<?= site_url('admin/brahman/toggle-status') ?>/${brahmanId}/${status}`;
                    
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            _token: '<?= csrf_token() ?>'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            // If update failed, revert the switch state
                            this.checked = !this.checked;
                            alert('Failed to update status');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // If there's an error, revert the switch state
                        this.checked = !this.checked;
                        alert('An error occurred while updating status');
                    });
                });
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?= view('admin/templates/sidebar') ?>
        <div class="main-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Brahman Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Aadhaar No</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Aadhaar Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($brahmans as $brahman): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td class="image-container">
                                        <?php if ($brahman['image']): ?>
                                            <img src="<?= esc($brahman['image']) ?>" alt="Brahman Photo" class="img-thumbnail">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo esc($brahman['name']); ?></td>
                                    <td><?php echo esc($brahman['aadhaar_no']); ?></td>
                                    <td><?php echo esc($brahman['address']); ?></td>
                                    <td><?php echo esc($brahman['city']); ?></td>
                                    <td><?php echo esc($brahman['state']); ?></td>
                                    <td><?php echo esc($brahman['pincode']); ?></td>
                                    <td class="image-container">
                                        <?php if ($brahman['aadhaar_image']): ?>
                                            <img src="<?= esc($brahman['aadhaar_image']) ?>" alt="Aadhaar Card" class="img-thumbnail">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="toggle-container">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" 
                                                       type="checkbox"
                                                       id="statusToggle<?= $brahman['id'] ?>"
                                                       data-id="<?= $brahman['id'] ?>"
                                                       <?php echo $brahman['status'] === 'active' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="statusToggle<?= $brahman['id'] ?>">
                                                    <span class="switch-text-active">Active</span>
                                                    <span class="switch-text-inactive">Inactive</span>
                                                </label>
                                            </div>
                                        </div>
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
</body>
</html>
