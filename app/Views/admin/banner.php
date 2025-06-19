<?php $title = 'Banner Management'; ?>
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
            height: 100px;
        }
        .image-container img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 4px;
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
        .table th:first-child,
        .table td:first-child {
            text-align: center;
        }
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
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bannerModal" data-action="create">
                                <i class="bi bi-plus-circle"></i> Create Banner
                            </button>
                            <form id="searchForm" method="get" action="" class="search-container">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search Banners..." value="<?= esc(service('request')->getGet('search') ?? '') ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Button Text</th>
                                    <th>Button Link</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($banners as $banner): ?>
                                <tr id="banner-row-<?= $banner['id'] ?>">
                                    <td><?= $i++; ?></td>
                                    <td class="image-container">
                                        <?php if ($banner['image']): ?>
                                            <img src="<?= esc($banner['image']) ?>" alt="Banner Image">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($banner['title']); ?></td>
                                    <td><?= esc($banner['subtitle']); ?></td>
                                    <td><?= esc($banner['button_text']); ?></td>
                                    <td><?= esc($banner['button_link']); ?></td>
                                    <td>
                                        <div class="toggle-container">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" 
                                                       type="checkbox"
                                                       id="statusToggle<?= $banner['id'] ?>"
                                                       data-id="<?= $banner['id'] ?>"
                                                       <?= $banner['status'] === 'active' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="statusToggle<?= $banner['id'] ?>">
                                                    <span class="switch-text-active">Active</span>
                                                    <span class="switch-text-inactive">Inactive</span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info edit-banner" 
                                                data-id="<?= $banner['id'] ?>" 
                                                data-action="edit"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#bannerModal">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?= $pager->links('banners', 'bootstrap5', 1) ?>
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
        // Set base_url from PHP
        const base_url = '<?= base_url() ?>';

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all toggle switches
            const toggleSwitches = document.querySelectorAll('.status-toggle');
            
            toggleSwitches.forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const bannerId = this.dataset.id;
                    const status = this.checked ? 'active' : 'inactive';
                    const url = `${base_url}/admin/banner/toggle-status/${bannerId}/${status}`;

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
                            // If update fails, revert the toggle state
                            this.checked = !this.checked;
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // If there's an error, revert the toggle state
                        this.checked = !this.checked;
                        alert('Failed to update status. Please try again.');
                    });
                });
            });

            // Handle edit button click
            const editButtons = document.querySelectorAll('.edit-banner');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bannerId = this.dataset.id;
                    const url = `${base_url}/admin/banner/edit/${bannerId}`;

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Populate the form with banner data
                            document.getElementById('bannerId').value = data.banner.id;
                            document.getElementById('bannerTitle').value = data.banner.title;
                            document.getElementById('bannerSubtitle').value = data.banner.subtitle;
                            document.getElementById('bannerButtonText').value = data.banner.button_text;
                            document.getElementById('bannerButtonLink').value = data.banner.button_link;
                            
                            // Set the image preview if exists
                            const imagePreview = document.getElementById('bannerImagePreview');
                            if (data.banner.image) {
                                imagePreview.innerHTML = `<img src="${data.banner.image}" alt="Banner Preview" style="max-width: 100%; max-height: 200px; object-fit: contain;">`;
                            } else {
                                imagePreview.innerHTML = '';
                            }
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to load banner data. Please try again.');
                    });
                });
            });

            // Handle form submission
            const saveBannerButton = document.getElementById('saveBanner');
            const bannerForm = document.getElementById('bannerForm');
            const bannerImage = document.getElementById('bannerImage');

            if (saveBannerButton) {
                saveBannerButton.addEventListener('click', function() {
                    const formData = new FormData(bannerForm);
                    const action = document.getElementById('bannerId').value ? 'update' : 'create';
                    const url = `${base_url}/admin/banner/${action}`;

                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to save banner. Please try again.');
                    });
                });
            }

            // Handle image preview
            if (bannerImage) {
                bannerImage.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imagePreview = document.getElementById('bannerImagePreview');
                            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Banner Preview" style="max-width: 100%; max-height: 200px; object-fit: contain;">`;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>

    <!-- Include the banner modal -->
    <?php include(APPPATH . 'Views/admin/modals/banner-create.php'); ?>
</body>
</html>
