<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@if(backpack_user()->hasRole('admin|vti|public|provider'))
    <li>
        <a href="{{ backpack_url('dashboard') }}">
            <i class="fa fa-dashboard"></i>
            <span>{{ trans('backpack::base.dashboard') }}</span>
        </a>
    </li>
@endif

@if(backpack_user()->hasRole('vti'))
    <!-- Service Providers -->
    <li class="treeview">
        <a href="#"><i class="fa fa-graduation-cap"></i> <span>Service Providers</span> <i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('bioprofile/create') }}"><i class="fa fa-user-plus"></i>
                    <span>Add Service Provider</span></a></li>
            <li><a href="{{ backpack_url('bioprofile') }}"><i class="fa fa-users"></i>
                    <span>Service Providers</span></a>
            </li>
            <li><a href="{{ backpack_url('user/create') }}"><i class="fa fa-user-times"></i>
                    <span>Add User Information</span></a></li>
            <li><a href="{{ backpack_url('user') }}"><i class="fa fa-group"></i> <span>Users Information</span></a></li>
            <li><a href="{{ route('import.create') }}"><i class="fa fa-file-excel-o"></i>
                    <span>Import Service Providers</span></a></li>
        </ul>
    </li>

    <!-- Courses -->
    <li class="treeview">
        <a href="#"><i class="fa fa-pencil-square"></i> <span>Courses</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('course') }}"><i class="fa fa-pencil-square"></i> <span>Courses</span></a></li>
            @if(backpack_user()->hasRole('vti'))
                <li><a href="{{ route('course.create') }}"><i class="fa fa-file-excel-o"></i>
                        <span>Import Courses</span>
                    </a>
                </li>
            @endif
        </ul>
    </li>

    <li>
        <a href="{{ backpack_url('vti') }}"><i class="fa fa-university"></i> <span>Vocational Training Institutes</span></a>
    </li>
@endif

@if(backpack_user()->hasRole('admin'))

    <!-- Statistical Analysis -->
    <li class="treeview">
        <a href="#"><i class="fa fa-file-pdf-o"></i> <span>Reports</span> <i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('generateproviderreport') }}"><i class="fa fa-group"></i> <span>Service Provider Report</span></a>
            </li>
            <li><a href="{{ backpack_url('generatejobsreport') }}"><i class="fa fa-scissors"></i> <span>Jobs Report</span></a>
            </li>
        </ul>
    </li>

    <!-- Users, Roles Permissions -->
    <li class="treeview">
        <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
            <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
            <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
        </ul>
    </li>

    <!-- Advanced Features -->
    <li class="treeview">
        <a href="#"><i class="fa fa-cogs"></i> <span>Advanced</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a>
            </li>
            <li><a href="{{ backpack_url('backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
            <li><a href="{{route("log-viewer::logs.list")}}"><i class="fa fa-history"></i> <span>Logs</span></a></li>
            <li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
        </ul>
    </li>
@endif

<li>
    <a href="{{ route('backpack.account.info') }}">
        <i class="fa fa-user-circle-o"></i>
        <span>{{ trans('backpack::base.my_account') }}</span>
    </a>
</li>
<li>
    <a href="{{ backpack_url('logout') }}">
        <i class="fa fa-sign-out"></i>
        <span>{{ trans('backpack::base.logout') }}</span>
    </a>
</li>
