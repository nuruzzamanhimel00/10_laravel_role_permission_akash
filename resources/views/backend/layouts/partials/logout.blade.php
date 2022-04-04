<div class="user-profile pull-right">
    <img class="avatar user-thumb" src="{{ asset('backend/assets/images/author/avatar.png') }}" alt="avatar">
    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->guard('admin')->user()->name }} <i class="fa fa-angle-down"></i></h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Message</a>
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="r{{ route('admin.logout.submit') }}"
        onclick="event.preventDefault();
        document.getElementById('admin_logout').submit();
        "
        >Log Out</a>
        <form action="{{ route('admin.logout.submit') }}" method="POST" id="admin_logout">
            @csrf
        </form>
    </div>
</div>
