<!DOCTYPE html>
<html>
<head>
    <title>About Us - Shopping Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('css/admin.css') ?>" rel="stylesheet">
    <style>
        .main-content {
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Responsive sidebar width */
        .sidebar {
            width: 250px;
            min-width: 250px;
            max-width: 250px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-width: 100%;
                max-width: 100%;
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        .stats-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .card-title {
            margin: 0;
            font-size: 1.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
            width: 100%;
            max-width: 100%;
        }

        .btn-primary {
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }

        .alert {
            margin-bottom: 1.5rem;
            border-radius: 0.375rem;
        }

        /* Editor container width */
        .ck-editor__editable {
            min-width: 100% !important;
            max-width: 100% !important;
        }

        /* Form container width */
        .form-container {
            width: 80%;
            max-width: 100%;
        }

        /* Card width */
        .card {
            width: 100%;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar">
                <?= view('admin/templates/sidebar') ?>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">About Us</h3>
                            </div>
                            <div class="card-body">
                                <?php if (session()->has('success')): ?>
                                    <div class="alert alert-success"><?php echo session('success'); ?></div>
                                <?php endif; ?>
                                
                                <?php if (session()->has('errors')): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach (session('errors') as $error): ?>
                                            <p><?php echo $error; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?php echo base_url('admin/about-us/save'); ?>" method="post" class="form-container">
                                    <?php csrf_field(); ?>
                                    
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="10"><?php echo $aboutUs['description'] ?? ''; ?></textarea>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>
