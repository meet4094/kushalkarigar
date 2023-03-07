<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class=" sidemenu-logo">
        <a class="main-logo" href="index.html">
            <img src="" class="header-brand-img desktop-logo">
            <img src="" class="header-brand-img icon-logo">
            <img src="" class="header-brand-img desktop-logo theme-logo">
            <img src="" class="header-brand-img icon-logo theme-logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Dashboard</li>
            <li class="nav-item {{ @$title == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i><span class="sidemenu-label">Home</span></a>
            </li>
            <li class="nav-label">Master</li>
            <li class="nav-item {{ @$title == 'employer_list' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/employer_list') }}"><i class="fa fa-user"></i><span class="sidemenu-label">Employer</span></a>
            </li>
            <li class="nav-item {{ @$title == 'employee_list' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/employee_list') }}"><i class="fa fa-users"></i><span class="sidemenu-label">Employee</span></a>
            </li>
            <li class="nav-label">Dropdown Menu</li>
            <li class="nav-item {{ @$title == 'job_type' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/job_type') }}"><i class="fa fa-tasks"></i><span class="sidemenu-label">Job Type</span></a>
            </li>
            <li class="nav-item {{ @$title == 'skill_set' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/skill_set') }}"><i class="fa fa-book"></i><span class="sidemenu-label">Skill Set</span></a>
            </li>
            <li class="nav-item {{ @$title == 'work_experience' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/work_experience') }}"><i class="fa fa-history"></i><span class="sidemenu-label">Work Experience</span></a>
            </li>
        </ul>
    </div>
</div>