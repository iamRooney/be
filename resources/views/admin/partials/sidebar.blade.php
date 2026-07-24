@php
    $route = Route::currentRouteName();

    // Falls back to '#' if the route isn't defined yet, so the sidebar never breaks
// while you're still wiring up controllers.
    function navLink($name)
    {
        return Route::has($name) ? route($name) : '#';
    }
@endphp

<div class="sidebar" id="adminSidebar">

    <div class="sidebar-top">
        <div class="brand">
            <div class="brand-icon">
                <img src="{{ asset('/uploads/logo/head.png') }}" alt="Exbhex logo">
            </div>
            <div class="brand-text">
                <h4>Exbhex</h4>
                <small>Superadmin Panel</small>
            </div>
        </div>

        <button class="sidebar-toggle" id="sidebarToggle" title="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="menu-title">MAIN</div>

    <a href="{{ navLink('admin.dashboard') }}" title="Dashboard"
        class="menu-item {{ $route == 'admin.dashboard' ? 'active' : '' }}">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>

    <div class="menu-title">MANAGEMENT</div>

    <a href="{{ navLink('admin.companies.index') }}" title="Companies"
        class="menu-item {{ str_contains($route, 'companies') ? 'active' : '' }}">
        <i class="bi bi-building"></i>
        <span>Companies</span>
    </a>

    <a href="{{ navLink('admin.users.index') }}" title="Users"
        class="menu-item {{ str_contains($route, 'users') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i>
        <span>Users</span>
    </a>

    <a href="{{ navLink('admin.enquiries.index') }}" title="Enquiries"
        class="menu-item {{ str_contains($route, 'enquiries') ? 'active' : '' }}">
        <i class="bi bi-envelope-fill"></i>
        <span>Enquiries</span>
    </a>

    <div class="menu-title">LISTINGS</div>

    <a href="{{ navLink('admin.listings.products.index') }}" title="Products"
        class="menu-item {{ str_contains($route, 'products') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i>
        <span>Products</span>
    </a>

    <a href="{{ navLink('admin.listings.services.index') }}" title="Services"
        class="menu-item {{ str_contains($route, 'services') ? 'active' : '' }}">
        <i class="bi bi-tools"></i>
        <span>Services</span>
    </a>

    <a href="{{ navLink('admin.categories.index') }}" title="Categories"
        class="menu-item {{ str_contains($route, 'categories') ? 'active' : '' }}">
        <i class="bi bi-grid"></i>
        <span>Categories</span>
    </a>

    <div class="menu-title">SYSTEM</div>

    {{-- <a href="{{ navLink('admin.settings') }}" title="Settings"
        class="menu-item {{ str_contains($route, 'settings') ? 'active' : '' }}">
        <i class="bi bi-gear-fill"></i>
        <span>Settings</span>
    </a> --}}

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="menu-item logout-btn" title="Logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>
    </form>

</div>

<style>
    .sidebar {
        width: 270px;
        height: 100vh;
        background: #0D3B7A;
        display: flex;
        flex-direction: column;
        padding: 25px 18px;
        position: fixed;
        top: 0;
        left: 0;
        overflow-y: auto;
        overflow-x: hidden;
        flex-shrink: 0;
        z-index: 1000;
        transition: width .25s ease;
    }

    .sidebar-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 35px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
    }

    .brand-icon {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .brand-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 6px;
    }

    .brand-text {
        white-space: nowrap;
        overflow: hidden;
    }

    .brand h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: white;
    }

    .brand small {
        color: #94a3b8;
    }

    .sidebar-toggle {
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 20px;
        cursor: pointer;
        padding: 6px 8px;
        border-radius: 8px;
        flex-shrink: 0;
        transition: .2s;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
    }

    .menu-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #64748b;
        margin: 18px 0 10px;
        white-space: nowrap;
        overflow: hidden;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 12px;
        color: #cbd5e1;
        text-decoration: none;
        margin-bottom: 6px;
        transition: .25s;
        border: none;
        width: 100%;
        background: none;
        text-align: left;
        font-size: inherit;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
    }

    .menu-item span {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .menu-item:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
    }

    .menu-item.active {
        background: #F7941E;
        color: white;
    }

    .menu-item i:not(.chevron) {
        font-size: 18px;
        flex-shrink: 0;
    }

    .menu-parent .chevron {
        margin-left: auto;
        font-size: 12px;
        transition: transform .2s;
        flex-shrink: 0;
    }

    .menu-parent[aria-expanded="true"] .chevron {
        transform: rotate(180deg);
    }

    .submenu {
        display: flex;
        flex-direction: column;
        padding-left: 20px;
        margin-bottom: 6px;
    }

    .submenu-item {
        padding: 9px 16px;
        border-radius: 10px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 13.5px;
        margin-bottom: 2px;
        border-left: 2px solid rgba(255, 255, 255, 0.08);
        white-space: nowrap;
    }

    .submenu-item:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
    }

    .submenu-item.active {
        color: white;
        border-left: 2px solid #2563eb;
        background: rgba(255, 255, 255, 0.08);
        font-weight: 600;
    }

    .logout-btn {
        margin-top: 15px;
        cursor: pointer;
    }

    /* ---------- Collapsed (icon-only) state ---------- */

    .sidebar.collapsed {
        width: 84px;
        padding: 25px 14px;
    }

    .sidebar.collapsed .sidebar-top {
        flex-direction: column;
        gap: 14px;
    }

    .sidebar.collapsed .brand-text,
    .sidebar.collapsed .menu-title,
    .sidebar.collapsed .menu-item span,
    .sidebar.collapsed .chevron {
        display: none;
    }

    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding: 12px;
    }

    .sidebar.collapsed .submenu {
        display: none !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const mainContent = document.querySelector('.main-wrapper');

        if (!sidebar || !toggleBtn) return;

        // Restore saved state on load
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
            mainContent?.classList.add('sidebar-collapsed');
        }

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent?.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    });
</script>
