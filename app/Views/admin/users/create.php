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
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
                    <a class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>" href="/admin/dashboard">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a class="nav-link <?php echo $page === 'users' ? 'active' : ''; ?>" href="/admin/users">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                    <a class="nav-link <?php echo $page === 'products' ? 'active' : ''; ?>" href="/admin/products">
                        <i class="bi bi-box me-2"></i> Products
                    </a>
                    <a class="nav-link <?php echo $page === 'orders' ? 'active' : ''; ?>" href="/admin/orders">
                        <i class="bi bi-cart me-2"></i> Orders
                    </a>
                    <a class="nav-link" href="/logout">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><?php echo $title; ?></h2>
                    <div class="d-flex gap-2">
                        <a href="/admin/users" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Back to Users
                        </a>
                        <a href="/admin/dashboard" class="btn btn-secondary">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </div>
                </div>

                <div class="form-container">
                    <form action="/admin/users/store" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_admin" id="adminRole" value="1">
                                <label class="form-check-label" for="adminRole">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_admin" id="userRole" value="0" checked>
                                <label class="form-check-label" for="userRole">
                                    User
                                </label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-2"></i> Add User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
