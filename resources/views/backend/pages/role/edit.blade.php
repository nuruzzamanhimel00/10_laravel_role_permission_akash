@extends("backend.layouts.master")

@push('css')


@endpush
@section('title')
Roles Edit | Role Permission Laravel
@endsection

@section('content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li><span>Roles Edit</span></li>
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
                    <div class="card-title">Role Edit</div>
                    <div class="card-body">
                        @include("backend.layouts.partials.notify")
                        <div class="data-tables">
                            <form action="{{ route('roles.update',['role'=>$role->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">

                                </div>
                                <div class="form-group">
                                  <label for="name">Permissions</label>
                                  @php
                                      $allPermissionArray = $permissions->pluck('id')->toArray();
                                      $roleWiseAllParm = \App\User::roleWiseAllParm($role->id);

                                  @endphp
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="permissionAll" value="" {{ array_diff($allPermissionArray, $roleWiseAllParm->pluck('permission_id')->toArray()) != false ? '' : 'checked' }}>
                                        <label class="form-check-label" for="permissionAll">All</label>
                                    </div>

                                    <hr>

                                    @forelse ($permission_groups as $permission_group )
                                        @php

                                            $grupNameWiseAllParm = $permissions->where('group_name',$permission_group->name)->pluck('id')->toArray();

                                            $hasRoleWiseGrupParm = $roleWiseAllParm->whereIn('permission_id',$grupNameWiseAllParm)->pluck('permission_id')->toArray();

                                        @endphp
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input perGrpName" data-gname="{{ $permission_group->name }}_checkbox" id="permission_{{ $permission_group->name }}" {{ array_diff($grupNameWiseAllParm,$hasRoleWiseGrupParm) != false ? '' : 'checked' }}  >

                                                    <label class="form-check-label" for="permission_{{ $permission_group->name }}">{{ $permission_group->name }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">

                                                @forelse ($permissions->where('group_name',$permission_group->name) as $permission )
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input singPerName {{ $permission_group->name.'_checkbox' }}"

                                                    data-gname="{{ $permission_group->name }}_checkbox"
                                                    data-pargnameid="permission_{{ $permission_group->name }}"

                                                    name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}"

                                                    {{ in_array($permission->id,$hasRoleWiseGrupParm) ? 'checked' : '' }}

                                                    >
                                                    <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                              @empty
                                              @endforelse
                                            </div>
                                        </div>
                                        <hr>
                                    @empty
                                    @endforelse

                                  {{-- @forelse ($permissions as $permission )
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                  @empty
                                  <h2 class="text-danger">Permission Create FIrst</h2>
                                  @endforelse --}}

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
