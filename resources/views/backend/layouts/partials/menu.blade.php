<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li class="active">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    <ul class="collapse">
                        <li class="active"><a href="index.html">ICO dashboard</a></li>
                        <li><a href="index2.html">Ecommerce dashboard</a></li>
                        <li><a href="index3.html">SEO dashboard</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Roles</span></a>
                    <ul class="collapse">
                        <li><a href="{{ route('roles.index') }}l">Roles List</a></li>
                        <li><a href="{{ route('roles.create') }}">Role Create</a></li>
                        {{-- <li><a href="login3.html">Login 3</a></li> --}}
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
