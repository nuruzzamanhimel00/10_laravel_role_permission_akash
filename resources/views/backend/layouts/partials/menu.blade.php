@inject('AdminModal','App\Admin' )
@php
    $user = $AdminModal::adminGuard()->user();
@endphp
<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                @if ($user->can('dashboard.view'))
                    <li class="{{ \Route::is('admin.dashboard')  ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse {{ \Route::is('admin.dashboard')  ? 'in' : '' }}">
                            <li class="{{ \Route::is('admin.dashboard')  ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">My dashboard</a></li>
                        </ul>
                    </li>
                @endif


                <li class="{{ \Route::is('roles.index') || \Route::is('roles.create') || \Route::is('roles.edit') || \Route::is('roles.destroy') ? 'active' : '' }}">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Roles</span></a>
                    <ul class="collapse {{ \Route::is('roles.index') || \Route::is('roles.create') || \Route::is('roles.edit') ? 'in' : '' }} ">
                        @if ($user->can('role.view'))
                        <li class="{{ \Route::is('roles.index') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">Roles List</a></li>
                        @endif
                        @if ($user->can('role.approve'))
                        <li class="{{ \Route::is('roles.create') ? 'active' : '' }}"><a href="{{ route('roles.create') }}">Role Create</a></li>
                        @endif



                    </ul>
                </li>

                <li class="{{ \Route::is('roles.index') || \Route::is('roles.create') || \Route::is('roles.edit') || \Route::is('roles.destroy') ? 'active' : '' }}">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Admins</span></a>
                    <ul class="collapse {{ \Route::is('roles.index') || \Route::is('roles.create') || \Route::is('roles.edit') ? 'in' : '' }} ">
                        @if ($user->can('admin.view'))
                        <li class="{{ \Route::is('admins.index') ? 'active' : '' }}"><a href="{{ route('admins.index') }}">Admins List</a></li>
                        @endif
                        @if ($user->can('admin.approve'))
                        <li class="{{ \Route::is('admins.create') ? 'active' : '' }}"><a href="{{ route('admins.create') }}">Admin Create</a></li>
                        @endif



                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
