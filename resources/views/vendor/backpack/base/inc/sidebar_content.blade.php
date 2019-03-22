<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>



<li><a href="{{ backpack_url('bioprofile') }}"><i class="fa fa-graduation-cap"></i> <span>Service Providers</span></a></li>
<li><a href="{{ backpack_url('course') }}"><i class="fa fa-pencil-square"></i> <span>Courses</span></a></li>
<li><a href="{{ backpack_url('vti') }}"><i class="fa fa-university"></i> <span>Vocational Training Institutes</span></a></li>
<li><a href="{{ backpack_url('business') }}"><i class="fa fa-building"></i> <span>Businesses</span></a></li>

<!-- Users, Roles Permissions -->
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
        <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
        <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-file-pdf-o"></i> <span>Statistical Analysis</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-file-o"></i> <span>Reports</span></a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-chrome"></i> <span>CMS</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
        <li><a href="{{ backpack_url('menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li>
    </ul>
</li>



<li class="treeview">
    <a href="#"><i class="fa fa-cogs"></i> <span>Advanced</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
        <li><a href="{{ backpack_url('backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
        <li><a href="{{route("log-viewer::logs.list")}}"><i class="fa fa-history"></i> <span>Logs</span></a></li>
        <li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
    </ul>
</li>