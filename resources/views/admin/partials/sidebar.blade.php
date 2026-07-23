@php
    $route = Route::currentRouteName();

    // Falls back to '#' if the route isn't defined yet, so the sidebar never breaks
// while you're still wiring up controllers.
    function navLink($name)
    {
        return Route::has($name) ? route($name) : '#';
    }
@endphp

<div class="sidebar">

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-boxes"></i>
        </div>
        <div>
            <h4>Exbhex</h4>
            <small>Superadmin Panel</small>
        </div>
    </div>

    <div class="menu-title">MAIN</div>

    <a href="{{ navLink('admin.dashboard') }}" class="menu-item {{ $route == 'admin.dashboard' ? 'active' : '' }}">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>

    <div class="menu-title">MANAGEMENT</div>

    {{-- COMPANIES --}}
    <button class="menu-item menu-parent {{ str_contains($route, 'companies') ? 'active' : '' }}"
        data-bs-toggle="collapse" data-bs-target="#menuCompanies"
        aria-expanded="{{ str_contains($route, 'companies') ? 'true' : 'false' }}">
        <i class="bi bi-building"></i>
        <span>Companies</span>
        <i class="bi bi-chevron-down chevron"></i>
    </button>
    <div class="collapse submenu {{ str_contains($route, 'companies') ? 'show' : '' }}" id="menuCompanies">
        <a href="{{ navLink('admin.companies.index') }}"
            class="submenu-item {{ $route == 'admin.companies.index' ? 'active' : '' }}">All companies</a>
        <a href="{{ navLink('admin.companies.pending') }}"
            class="submenu-item {{ $route == 'admin.companies.pending' ? 'active' : '' }}">Pending verification</a>
        <a href="{{ navLink('admin.companies.verified') }}"
            class="submenu-item {{ $route == 'admin.companies.verified' ? 'active' : '' }}">Verified companies</a>
        <a href="{{ navLink('admin.companies.rejected') }}"
            class="submenu-item {{ $route == 'admin.companies.rejected' ? 'active' : '' }}">Rejected companies</a>
    </div>

    {{-- USERS --}}
    <button class="menu-item menu-parent {{ str_contains($route, 'users') ? 'active' : '' }}" data-bs-toggle="collapse"
        data-bs-target="#menuUsers" aria-expanded="{{ str_contains($route, 'users') ? 'true' : 'false' }}">
        <i class="bi bi-people-fill"></i>
        <span>Users</span>
        <i class="bi bi-chevron-down chevron"></i>
    </button>
    <div class="collapse submenu {{ str_contains($route, 'users') ? 'show' : '' }}" id="menuUsers">
        <a href="{{ navLink('admin.users.index') }}"
            class="submenu-item {{ $route == 'admin.users.index' ? 'active' : '' }}">All users</a>
        <a href="{{ navLink('admin.users.buyers') }}"
            class="submenu-item {{ $route == 'admin.users.buyers' ? 'active' : '' }}">Buyers</a>
        <a href="{{ navLink('admin.users.sellers') }}"
            class="submenu-item {{ $route == 'admin.users.sellers' ? 'active' : '' }}">Sellers</a>
        <a href="{{ navLink('admin.users.active') }}"
            class="submenu-item {{ $route == 'admin.users.active' ? 'active' : '' }}">Active users</a>
        <a href="{{ navLink('admin.users.suspended') }}"
            class="submenu-item {{ $route == 'admin.users.suspended' ? 'active' : '' }}">Suspended users</a>
    </div>

    {{-- ENQUIRIES --}}
    <button class="menu-item menu-parent {{ str_contains($route, 'enquiries') ? 'active' : '' }}"
        data-bs-toggle="collapse" data-bs-target="#menuEnquiries"
        aria-expanded="{{ str_contains($route, 'enquiries') ? 'true' : 'false' }}">
        <i class="bi bi-envelope-fill"></i>
        <span>Enquiries</span>
        <i class="bi bi-chevron-down chevron"></i>
    </button>
    <div class="collapse submenu {{ str_contains($route, 'enquiries') ? 'show' : '' }}" id="menuEnquiries">
        <a href="{{ navLink('admin.enquiries.index') }}"
            class="submenu-item {{ $route == 'admin.enquiries.index' ? 'active' : '' }}">All enquiries</a>
        <a href="{{ navLink('admin.enquiries.products') }}"
            class="submenu-item {{ $route == 'admin.enquiries.products' ? 'active' : '' }}">Product enquiries</a>
        <a href="{{ navLink('admin.enquiries.services') }}"
            class="submenu-item {{ $route == 'admin.enquiries.services' ? 'active' : '' }}">Service enquiries</a>
        <a href="{{ navLink('admin.enquiries.open') }}"
            class="submenu-item {{ $route == 'admin.enquiries.open' ? 'active' : '' }}">Open</a>
        <a href="{{ navLink('admin.enquiries.closed') }}"
            class="submenu-item {{ $route == 'admin.enquiries.closed' ? 'active' : '' }}">Closed</a>
    </div>

    <div class="menu-title">LISTINGS</div>

    {{-- PRODUCTS --}}
    <button class="menu-item menu-parent {{ str_contains($route, 'products') ? 'active' : '' }}"
        data-bs-toggle="collapse" data-bs-target="#menuProducts"
        aria-expanded="{{ str_contains($route, 'products') ? 'true' : 'false' }}">
        <i class="bi bi-box-seam"></i>
        <span>Products</span>
        <i class="bi bi-chevron-down chevron"></i>
    </button>
    <div class="collapse submenu {{ str_contains($route, 'products') ? 'show' : '' }}" id="menuProducts">
        <a href="{{ navLink('admin.products.pending') }}"
            class="submenu-item {{ $route == 'admin.products.pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ navLink('admin.products.approved') }}"
            class="submenu-item {{ $route == 'admin.products.approved' ? 'active' : '' }}">Approved</a>
        <a href="{{ navLink('admin.products.rejected') }}"
            class="submenu-item {{ $route == 'admin.products.rejected' ? 'active' : '' }}">Rejected</a>
    </div>

    {{-- SERVICES --}}
    <button class="menu-item menu-parent {{ str_contains($route, 'services') ? 'active' : '' }}"
        data-bs-toggle="collapse" data-bs-target="#menuServices"
        aria-expanded="{{ str_contains($route, 'services') ? 'true' : 'false' }}">
        <i class="bi bi-tools"></i>
        <span>Services</span>
        <i class="bi bi-chevron-down chevron"></i>
    </button>
    <div class="collapse submenu {{ str_contains($route, 'services') ? 'show' : '' }}" id="menuServices">
        <a href="{{ navLink('admin.services.pending') }}"
            class="submenu-item {{ $route == 'admin.services.pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ navLink('admin.services.approved') }}"
            class="submenu-item {{ $route == 'admin.services.approved' ? 'active' : '' }}">Approved</a>
        <a href="{{ navLink('admin.services.rejected') }}"
            class="submenu-item {{ $route == 'admin.services.rejected' ? 'active' : '' }}">Rejected</a>
    </div>

    {{-- CATEGORIES --}}
    <button class="menu-item menu-parent {{ str_contains($route, 'categories') ? 'active' : '' }}"
        data-bs-toggle="collapse" data-bs-target="#menuCategories"
        aria-expanded="{{ str_contains($route, 'categories') ? 'true' : 'false' }}">
        <i class="bi bi-grid"></i>
        <span>Categories</span>
        <i class="bi bi-chevron-down chevron"></i>
    </button>
    <div class="collapse submenu {{ str_contains($route, 'categories') ? 'show' : '' }}" id="menuCategories">
        <a href="{{ navLink('admin.categories.index') }}"
            class="submenu-item {{ $route == 'admin.categories.index' ? 'active' : '' }}">All categories</a>
        <a href="{{ navLink('admin.categories.active') }}"
            class="submenu-item {{ $route == 'admin.categories.active' ? 'active' : '' }}">Active</a>
        <a href="{{ navLink('admin.categories.inactive') }}"
            class="submenu-item {{ $route == 'admin.categories.inactive' ? 'active' : '' }}">Inactive</a>
        <a href="{{ navLink('admin.categories.create') }}"
            class="submenu-item {{ $route == 'admin.categories.create' ? 'active' : '' }}">+ Add category</a>
    </div>

    <div class="menu-title">SYSTEM</div>

    <a href="{{ navLink('admin.settings') }}"
        class="menu-item {{ str_contains($route, 'settings') ? 'active' : '' }}">
        <i class="bi bi-gear-fill"></i>
        <span>Settings</span>
    </a>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="menu-item logout-btn">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>
    </form>

</div>

<style>
    .sidebar {
        width: 270px;
        min-height: 100vh;
        background: #0f172a;
        display: flex;
        flex-direction: column;
        padding: 25px 18px;
        position: sticky;
        top: 0;
        overflow-y: auto;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 35px;
    }

    .brand-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: white;
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

    .menu-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #64748b;
        margin: 18px 0 10px;
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
    }

    .menu-item:hover {
        background: #1e293b;
        color: white;
    }

    .menu-item.active {
        background: #2563eb;
        color: white;
    }

    .menu-item i {
        font-size: 18px;
    }

    .menu-parent .chevron {
        margin-left: auto;
        font-size: 12px;
        transition: transform .2s;
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
        border-left: 2px solid #1e293b;
    }

    .submenu-item:hover {
        background: #1e293b;
        color: white;
    }

    .submenu-item.active {
        color: white;
        border-left: 2px solid #2563eb;
        background: #1e293b;
        font-weight: 600;
    }

    .logout-btn {
        margin-top: 15px;
        cursor: pointer;
    }
</style>
