@extends("backend.layouts.master")

@push('css')


@endpush
@section('title')
User Create | Role Permission Laravel
@endsection

@section('content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li><span>User Create</span></li>
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
                    <div class="card-title">User Create</div>
                    <div class="card-body">
                        @include("backend.layouts.partials.notify")
                        <div class="data-tables">
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">

                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                                </div>

                                <div class="form-group">
                                    <label for="sltRole">Roles</label>
                                    <select multiple class="form-control" id="sltRole" name="roles[]" value="{{ old('roles') }}">
                                        @forelse ($roles as $role )
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                  </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
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
