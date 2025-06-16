<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?> - Shopping Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #007bff;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .stats-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h4 class="mb-4">Admin Panel</h4>
                <nav class="nav flex-column">
                    <a class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>" href="<?= site_url('admin/dashboard') ?>">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a class="nav-link <?php echo $page === 'users' ? 'active' : ''; ?>" href="<?= site_url('admin/users') ?>">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                    <a class="nav-link <?php echo $page === 'products' ? 'active' : ''; ?>" href="<?= site_url('admin/products') ?>">
                        <i class="bi bi-box-seam me-2"></i> Products
                    </a>
                    <a class="nav-link <?php echo $page === 'orders' ? 'active' : ''; ?>" href="<?= site_url('admin/orders') ?>">
                        <i class="bi bi-cart me-2"></i> Orders
                    </a>
                    <a class="nav-link" href="<?= site_url('admin/logout') ?>">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><?php echo $title; ?></h2>
                    <div class="d-flex gap-2">
                        <a href="/admin/users" class="btn btn-primary">
                            <i class="bi bi-people me-2"></i> Manage Users
                        </a>
                        <a href="/admin/products" class="btn btn-primary">
                            <i class="bi bi-box me-2"></i> Manage Products
                        </a>
                        <a href="/admin/orders" class="btn btn-primary">
                            <i class="bi bi-cart me-2"></i> Manage Orders
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h3>123</h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h3>456</h3>
                            <p>Total Products</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h3>789</h3>
                            <p>Total Orders</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h3>$10,000</h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
