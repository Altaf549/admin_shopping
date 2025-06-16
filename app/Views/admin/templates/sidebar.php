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
        <a class="nav-link" href="<?= site_url('logout') ?>">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </nav>
</div>
