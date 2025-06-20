<!-- Sidebar -->
<div class="col-md-3 col-lg-2 sidebar">
    <h4 class="mb-4">Admin Panel</h4>
    <nav class="nav flex-column">
        <!-- Main Navigation -->
        <a class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>" href="<?= site_url('admin/dashboard') ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        
        <a class="nav-link <?php echo $page === 'brahman' ? 'active' : ''; ?>" href="<?= site_url('admin/brahman') ?>">
            <i class="bi bi-people me-2"></i> Admin Details
        </a>
        
        <a class="nav-link <?php echo $page === 'event' ? 'active' : ''; ?>" href="<?= site_url('admin/event') ?>">
            <i class="bi bi-calendar-event me-2"></i> Events
        </a>
        
        <a class="nav-link <?php echo $page === 'users' ? 'active' : ''; ?>" href="<?= site_url('admin/user') ?>">
            <i class="bi bi-person me-2"></i> Users
        </a>

        <!-- Settings Section -->
        <div class="nav-item mb-3">
            <a class="nav-link <?php 
                $settingsPages = ['banner', 'about-us', 'terms_condition', 'privacy_policy'];
                echo in_array($page, $settingsPages) ? 'active' : ''; 
            ?>" id="settings-toggle" href="#" role="button" aria-expanded="<?php echo in_array($page, $settingsPages) ? 'true' : 'false'; ?>" aria-controls="settingsMenu">
                <div class="d-flex align-items-center w-100">
                    <i class="bi bi-gear me-2"></i>
                    <span class="flex-grow-1">Settings</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
            </a>
            <div class="<?php echo in_array($page, ['banner', 'about-us', 'terms_condition', 'privacy_policy']) ? 'is-open' : ''; ?>" id="settingsMenu">
                <div class="nav flex-column ms-3">
                    <a class="nav-link <?php echo $page === 'banner' ? 'active' : ''; ?>" href="<?= site_url('admin/banner') ?>">
                        <i class="bi bi-display me-2"></i> Banners
                    </a>
                    <a class="nav-link <?php echo $page === 'about-us' ? 'active' : ''; ?>" href="<?= site_url('admin/about-us') ?>">
                        <i class="bi bi-info-circle me-2"></i> About Us
                    </a>
                    <a class="nav-link <?php echo $page === 'terms_condition' ? 'active' : ''; ?>" href="<?= site_url('admin/terms-condition') ?>">
                        <i class="bi bi-file-text me-2"></i> Terms & Conditions
                    </a>
                    <a class="nav-link <?php echo $page === 'privacy_policy' ? 'active' : ''; ?>" href="<?= site_url('admin/privacy-policy') ?>">
                        <i class="bi bi-shield-lock me-2"></i> Privacy Policy
                    </a>
                </div>
            </div>
        </div>

        <!-- Logout -->
        <a class="nav-link" href="<?= site_url('admin/logout') ?>">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </nav>
</div>

<!-- Add custom CSS for sidebar styling -->
<style>
.nav-item .nav-link {
    position: relative;
    transition: all 0.3s ease;
}

.nav-item .nav-link .bi-chevron-down {
    transition: transform 0.3s ease;
}

.nav-item .nav-link.active .bi-chevron-down,
.nav-item .nav-link[aria-expanded="true"] .bi-chevron-down {
    transform: rotate(180deg);
}

.nav-item .nav-link .d-flex {
    width: 100%;
    align-items: center;
}

.nav-item .nav-link .flex-grow-1 {
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

#settingsMenu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease-out;
}

#settingsMenu.is-open {
    max-height: 500px;
}
</style>

<!-- Add custom JavaScript for settings menu -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('settings-toggle');
    const menu = document.getElementById('settingsMenu');

    if (toggleButton && menu) {
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle the is-open class
            menu.classList.toggle('is-open');
            
            // Toggle the aria-expanded attribute
            toggleButton.setAttribute('aria-expanded', 
                toggleButton.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
        });
    }
});
</script>


