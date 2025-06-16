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
        .product-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
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
                        <a href="/admin/products/create" class="btn btn-primary">
                            <i class="bi bi-plus me-2"></i> Add Product
                        </a>
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
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td>
                                        <?php if ($product['image']): ?>
                                            <img src="<?php echo base_url($product['image']); ?>" class="product-image" alt="<?php echo $product['name']; ?>">
                                        <?php else: ?>
                                            <div class="product-image bg-light text-center p-3">No Image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $product['name']; ?></td>
                                    <td>
                                        <?php 
                                        $category = array_filter($categories, function($cat) use ($product) {
                                            return $cat['id'] == $product['category_id'];
                                        });
                                        echo reset($category)['name'] ?? 'N/A';
                                        ?>
                                    </td>
                                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                                    <td><?php echo $product['stock']; ?></td>
                                    <td>
                                        <a href="/admin/products/edit/<?php echo $product['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/admin/products/delete/<?php echo $product['id']; ?>" method="POST" class="d-inline">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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
</body>
</html>
