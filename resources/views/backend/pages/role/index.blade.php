@extends("backend.layouts.master")

@push('css')

      <!-- Start datatable css -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

      <link rel="stylesheet" href="{{ asset('backend/assets/css/typography.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/assets/css/default-css.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/assets/css/responsive.css') }}">
@endpush
@section('title')
Roles | Role Permission Laravel
@endsection

@section('content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li><span>Roles</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include("backend.layouts.partials.logout")
        </div>
    </div>
</div>
<!-- page title area end -->
@inject('AdminModal','App\Admin' )
@php
    $user = $AdminModal::adminGuard()->user();
@endphp

<div class="main-content-inner">
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        @include("backend.layouts.partials.notify")
                        <div class="data-tables">
                            <table id="dataTable">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th width="30%">Permissions</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $role )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @forelse ($role->permissions as $permission)
                                                    <span class="badge badge-success" style="font-size: 14px;">
                                                        {{ $permission->name }}
                                                    </span>
                                                @empty
                                                @endforelse
                                            </td>
                                            <td>
                                                @if ($user->can( 'role.edit'))
                                                 <a href="{{ route('roles.edit',['role'=>$role->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                                @endif
                                                @if ($user->can('role.delete'))
                                                    <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('role_logout_form_{{ $role->id }}').submit();
                                                    " >Delete</a>
                                                    <form action="{{ route('roles.destroy',['role'=>$role->id]) }}" id="role_logout_form_{{ $role->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif

                                            </td>

                                        </tr>
                                    @empty
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dark table end -->
        </div>
    </div>
</div>
@endsection

@push('js')

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> --}}
    <!-- others plugins -->
<script>
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: true
        });
    }
</script>

@endpush
