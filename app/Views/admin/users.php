<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?> - Shopping Admin - User Details</title>
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
        .address-column {
            width: 200px;
            white-space: normal;
            word-wrap: break-word;
        }
        .search-container input {
            flex: 1;
            max-width: 240px;
        }
        .search-container button {
            width: 60px;
            padding: 0.375rem 0.5rem;
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
                    const userId = this.dataset.userId;
                    const status = this.checked ? 'active' : 'inactive';
                    const url = `<?= site_url('admin/user/toggle-status') ?>/${userId}/${status}`;
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
                            // If the update failed, revert the toggle switch
                            this.checked = !this.checked;
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // If there's an error, revert the toggle switch
                        this.checked = !this.checked;
                        alert('An error occurred while updating the status.');
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">User Details</h4>
                                    <div class="search-container">
                                        <form action="" method="get" class="d-flex">
                                            <input type="text" class="form-control" name="search" placeholder="Search users..." value="<?= $search ?? '' ?>">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($users)): ?>
                                                <?php $i = 1; foreach ($users as $user): ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?= esc($user['name']) ?></td>
                                                        <td><?= esc($user['email']) ?></td>
                                                        <td><?= esc($user['phone']) ?></td>
                                                        <td>
                                                            <div class="image-container">
                                                                <img src="<?= esc($user['image']) ?>" alt="User Image">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="toggle-container">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input status-toggle" type="checkbox" 
                                                                         id="status<?= $user['id'] ?>" 
                                                                         data-user-id="<?= $user['id'] ?>"
                                                                         <?= $user['status'] === 'active' ? 'checked' : '' ?>>
                                                                    <label class="form-check-label" for="status<?= $user['id'] ?>">
                                                                        <span class="switch-text-active">Active</span>
                                                                        <span class="switch-text-inactive">Inactive</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">No users found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    <?= $pager->links('users', 'bootstrap5', 1) ?>
                                </div>
                                
                                <!-- Total Records -->
                                <div class="text-center mt-3">
                                    <p>Total Records: <?= number_format($total) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
