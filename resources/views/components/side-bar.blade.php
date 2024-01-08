<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Categories</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="menu-icon mdi mdi-database"></i>
                <span class="menu-title">Catagory</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sub-category.index') }}">
                <i class="menu-icon mdi mdi-database"></i>
                <span class="menu-title">Sub Catagory</span>
            </a>
        </li>
    </ul>
</nav>
