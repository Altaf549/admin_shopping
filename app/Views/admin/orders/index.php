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
        .table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
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
                        <a href="/admin/dashboard" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
                        </a>
                    </div>
                </div>

                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success"><?php echo session('success'); ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['username']; ?></td>
                                    <td><?php echo $order['email']; ?></td>
                                    <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $this->getStatusBadgeClass($order['status']); ?>">
                                            <?php echo $order['status']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/admin/orders/view/<?php echo $order['id']; ?>" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="/admin/orders/updateStatus/<?php echo $order['id']; ?>" method="POST" class="d-inline">
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                    <?php foreach ($statusOptions as $key => $value): ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $order['status'] == $key ? 'selected' : ''; ?>>
                                                            <?php echo $value; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function getStatusBadgeClass(status) {
            const statusColors = {
                'pending': 'bg-warning',
                'processing': 'bg-info',
                'shipped': 'bg-primary',
                'delivered': 'bg-success',
                'cancelled': 'bg-danger'
            };
            return statusColors[status] || 'bg-secondary';
        }
    </script>
</body>
</html>
