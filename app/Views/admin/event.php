<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?> - Shopping Admin</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120px;
        }
        .image-container img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        .search-container {
            width: 300px;
            display: flex;
            gap: 0.5rem;
        }
        .search-container input {
            flex: 1;
            max-width: 240px;
        }
        .search-container button {
            width: 60px;
            padding: 0.375rem 0.5rem;
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
            color: rgb(255, 255, 255);
        }
        .status-toggle:checked + .form-check-label .switch-text-active {
            display: inline;
        }
        .status-toggle:not(:checked) + .form-check-label .switch-text-inactive {
            display: inline;
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
        .form-check-input[type="checkbox"] + .form-check-label::after {
            background-color: #fff !important;
        }
        .toggle-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
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
    </style>
</head>
<body>
    <div class="row">
        <?= view('admin/templates/sidebar') ?>
        <div class="main-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"><?= $title ?></h3>
                        <form id="searchForm" method="get" action="" class="search-container">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search Events..." value="<?= esc(service('request')->getGet('search') ?? '') ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($events as $event): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td class="image-container">
                                        <?php if ($event['image']): ?>
                                            <img src="<?= esc($event['image']) ?>" alt="Event Image" class="img-thumbnail">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($event['name']); ?></td>
                                    <td><?= esc($event['description']); ?></td>
                                    <td><?= esc($event['type']); ?></td>
                                    <td>
                                        <div class="toggle-container">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" 
                                                       type="checkbox"
                                                       id="statusToggle<?= $event['id'] ?>"
                                                       data-id="<?= $event['id'] ?>"
                                                       <?= $event['status'] === 'active' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="statusToggle<?= $event['id'] ?>">
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
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?= $pager->links('events', 'bootstrap5', 1) ?>
                    </div>
                    <!-- Total Records -->
                    <div class="text-center mt-3">
                        <p>Total Records: <?= number_format($total) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all toggle switches
            const toggleSwitches = document.querySelectorAll('.status-toggle');
            
            toggleSwitches.forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const eventId = this.dataset.id;
                    const status = this.checked ? 'active' : 'inactive';
                    const url = `<?= site_url('admin/event/toggle-status') ?>/${eventId}/${status}`;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
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
</body>
</html>
