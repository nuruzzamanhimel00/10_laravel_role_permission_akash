@extends("backend.layouts.master")

@push('css')


@endpush
@section('title')
Admin Edit | Role Permission Laravel
@endsection

@section('content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li><span>Admin Edit</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include("backend.layouts.partials.logout")
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-title">Admin Edit</div>
                    <div class="card-body">
                        @include("backend.layouts.partials.notify")
                        <div class="data-tables">
                            <form action="{{ route('admins.update',['admin'=>$admin->id]) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" placeholder="Enter name">

                                </div>
                                <div class="form-group">
                                  <label for="username">User Name</label>
                                  <input type="text" class="form-control" id="username" name="username" value="{{ $admin->username }}" placeholder="Enter username">

                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$admin->email }}" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                </div>


                                <div class="form-group">
                                    <label for="sltRole">Roles</label>
                                    <select multiple class="form-control" id="sltRole" name="roles[]" value="{{ old('roles') }}">
                                        @forelse ($roles as $role )
                                            <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }} >{{ $role->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                  </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                              </form>
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
@include("backend.pages.partials.roles-script")

@endpush
