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
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal" data-action="create">
                                <i class="bi bi-plus-circle"></i> Create Event
                            </button>
                            <form id="searchForm" method="get" action="" class="search-container">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search Events..." value="<?= esc(service('request')->getGet('search') ?? '') ?>">
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($events as $event): ?>
                                <tr id="event-row-<?= $event['id'] ?>">
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
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info edit-event" 
                                                data-id="<?= $event['id'] ?>" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#eventModal">
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
        // Set base_url from PHP
        const base_url = '<?= base_url() ?>';

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all toggle switches
            const toggleSwitches = document.querySelectorAll('.status-toggle');
            
            toggleSwitches.forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const eventId = this.dataset.id;
                    const status = this.checked ? 'active' : 'inactive';
                    const url = `${base_url}/admin/event/toggle-status/${eventId}/${status}`;

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

            // Event modal handling
            const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
            const eventForm = document.getElementById('eventForm');
            const saveEventButton = document.getElementById('saveEvent');
            const eventName = document.getElementById('eventName');
            const eventDescription = document.getElementById('eventDescription');
            const eventType = document.getElementById('eventType');
            const eventImage = document.getElementById('eventImage');
            const eventImagePreview = document.getElementById('eventImagePreview');

            // Handle modal show event
            document.getElementById('eventModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const action = button.getAttribute('data-action');
                const eventId = button.getAttribute('data-id');

                // Reset form
                eventForm.reset();
                eventImagePreview.innerHTML = '';

                if (action === 'edit' && eventId) {
                    // Fetch event data for editing
                    fetch(`${base_url}/admin/event/edit/${eventId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('eventId').value = data.event.id;
                                eventName.value = data.event.name;
                                eventDescription.value = data.event.description;
                                eventType.value = data.event.type;
                                
                                // Show image preview if exists
                                if (data.event.image) {
                                    eventImagePreview.innerHTML = `
                                        <img src="${base_url + data.event.image}" 
                                             class="img-thumbnail" 
                                             style="max-width: 200px;">
                                    `;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching event:', error);
                        });
                }

                // Update modal title
                document.getElementById('eventModalLabel').textContent = action === 'create' ? 'Create Event' : 'Edit Event';
            });

            // Handle form submission
            saveEventButton.addEventListener('click', function() {
                const formData = new FormData(eventForm);
                const action = document.getElementById('eventId').value ? 'update' : 'create';
                const url = `${base_url}/admin/event/${action}`;

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the table row if editing
                        if (action === 'update') {
                            const row = document.getElementById(`event-row-${data.event.id}`);
                            if (row) {
                                row.querySelector('td:nth-child(2)').textContent = data.event.name;
                                row.querySelector('td:nth-child(3)').textContent = data.event.description;
                                row.querySelector('td:nth-child(4)').textContent = data.event.type;
                                
                                // Update image if changed
                                if (data.event.image) {
                                    const imageCell = row.querySelector('td:nth-child(5)');
                                    const imageContainer = imageCell.querySelector('.image-container');
                                    if (imageContainer) {
                                        imageContainer.innerHTML = `
                                            <img src="${base_url + data.event.image}" 
                                                 alt="${data.event.name}"
                                                 class="img-thumbnail">
                                        `;
                                    }
                                }
                            }
                        } else {
                            // Add new row if creating
                            const tbody = document.querySelector('tbody');
                            const newRow = document.createElement('tr');
                            newRow.id = `event-row-${data.event.id}`;
                            newRow.innerHTML = `
                                <td>${data.event.id}</td>
                                <td class="image-container">
                                    ${data.event.image ? `
                                        <img src="${data.event.image}" 
                                             alt="${data.event.name}"
                                             class="img-thumbnail">
                                    ` : ''}
                                </td>
                                <td>${data.event.name}</td>
                                <td>${data.event.description}</td>
                                <td>${data.event.type}</td>
                                <td>
                                    <div class="toggle-container">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" 
                                                   id="status${data.event.id}" 
                                                   data-id="${data.event.id}" 
                                                   ${data.event.status === 'active' ? 'checked' : ''}>
                                            <label class="form-check-label" for="status${data.event.id}">
                                                <span class="switch-text-active">Active</span>
                                                <span class="switch-text-inactive">Inactive</span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info edit-event" 
                                            data-id="${data.event.id}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#eventModal">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                </td>
                            `;
                            tbody.insertBefore(newRow, tbody.firstChild);
                        }

                        // Show success message
                        alert(data.message);
                        eventModal.hide();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving the event');
                });
            });

            // Handle image preview
            eventImage.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        eventImagePreview.innerHTML = `
                            <img src="${e.target.result}" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <!-- Include the event modal -->
    <?php include(APPPATH . 'Views/admin/modals/event-create.php'); ?>

    </body>
</html>
