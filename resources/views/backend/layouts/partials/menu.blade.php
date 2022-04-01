<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li class="{{ \Route::is('admin.dashboard')  ? 'active' : '' }}">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    <ul class="collapse {{ \Route::is('admin.dashboard')  ? 'in' : '' }}">
                        <li class="{{ \Route::is('admin.dashboard')  ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">My dashboard</a></li>
                    </ul>
                </li>

                <li class="{{ \Route::is('roles.index') || \Route::is('roles.create') || \Route::is('roles.edit') || \Route::is('roles.destroy') ? 'active' : '' }}">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Roles</span></a>
                    <ul class="collapse {{ \Route::is('roles.index') || \Route::is('roles.create') || \Route::is('roles.edit') ? 'in' : '' }} ">

                        <li class="{{ \Route::is('roles.index') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">Roles List</a></li>
                        <li class="{{ \Route::is('roles.create') ? 'active' : '' }}"><a href="{{ route('roles.create') }}">Role Create</a></li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
