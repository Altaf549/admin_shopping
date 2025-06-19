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
            ?>" data-bs-toggle="collapse" href="#settingsMenu" role="button" aria-expanded="<?php echo in_array($page, $settingsPages) ? 'true' : 'false'; ?>" aria-controls="settingsMenu">
                <div class="d-flex align-items-center w-100">
                    <i class="bi bi-gear me-2"></i>
                    <span class="flex-grow-1">Settings</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
            </a>
            <div class="collapse <?php echo in_array($page, ['banner', 'about-us', 'terms_condition', 'privacy_policy']) ? 'show' : ''; ?>" id="settingsMenu">
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

<!-- Add custom JavaScript to handle settings menu behavior -->
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const settingsToggle = document.querySelector('.nav-item .nav-link[data-bs-toggle="collapse"]');
    const settingsMenu = document.getElementById('settingsMenu');

    if (settingsToggle) {
        // Update chevron state when menu is toggled
        settingsToggle.addEventListener('click', function() {
            const chevron = this.querySelector('.bi-chevron-down');
            if (chevron) {
                // Toggle chevron class
                chevron.classList.toggle('bi-chevron-up');
                // Update aria-expanded
                this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
                // Update menu state
                if (settingsMenu) {
                    settingsMenu.classList.toggle('show');
                }
            }
        });

        // Handle page load state
        const isSettingsActive = settingsToggle.classList.contains('active');
        const isMenuExpanded = settingsMenu.classList.contains('show');
        const chevron = settingsToggle.querySelector('.bi-chevron-down');

        if (chevron) {
            // Set initial chevron state
            chevron.classList.toggle('bi-chevron-up', isSettingsActive || isMenuExpanded);
        }

        // Update chevron state when clicking child links
        document.querySelectorAll('.nav-item .nav-link:not([data-bs-toggle])').forEach(link => {
            link.addEventListener('click', function() {
                if (settingsMenu) {
                    settingsMenu.classList.add('show');
                    settingsToggle.setAttribute('aria-expanded', 'true');
                    if (chevron) {
                        chevron.classList.add('bi-chevron-up');
                    }
                }
            });
        });
    }
});
</script>
