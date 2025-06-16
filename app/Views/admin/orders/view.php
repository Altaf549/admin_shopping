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
        .order-details {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }
        .product-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .product-item:last-child {
            border-bottom: none;
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
                    <h2>Order #<?php echo $order['id']; ?></h2>
                    <div class="d-flex gap-2">
                        <a href="/admin/orders" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Back to Orders
                        </a>
                        <a href="/admin/dashboard" class="btn btn-secondary">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </div>
                </div>

                <div class="order-details">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Order Information</h4>
                            <div class="mb-3">
                                <strong>Status:</strong>
                                <span class="status-badge <?php echo $this->getStatusBadgeClass($order['status']); ?>">
                                    <?php echo $order['status']; ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Order Date:</strong>
                                <?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?>
                            </div>
                            <div class="mb-3">
                                <strong>Payment Method:</strong>
                                <?php echo $order['payment_method']; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Shipping Information</h4>
                            <pre class="bg-light p-3 rounded">
<?php echo htmlspecialchars($order['shipping_address']); ?>
                            </pre>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4>Order Items</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Order items will be populated by JavaScript -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>$<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
