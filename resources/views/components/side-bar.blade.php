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
                <i class="menu-icon mdi mdi-format-list-bulleted"></i>
                <span class="menu-title">Catagory</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sub-category.index') }}">
                <i class="menu-icon mdi mdi-format-list-bulleted-type"></i>
                <span class="menu-title">Sub Catagory</span>
            </a>
        </li>
        <li class="nav-item nav-category">Posts</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('post.index') }}">
                <i class="menu-icon mdi mdi-glassdoor"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>
        <li class="nav-item nav-category">Image</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('slider.index') }}">
                <i class="menu-icon mdi mdi-image-filter"></i>
                <span class="menu-title">Slider Images</span>
            </a>
        </li>
    </ul>
</nav>
