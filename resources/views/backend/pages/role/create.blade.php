@extends("backend.layouts.master")

@push('css')


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
                    <li><span>Roles Create</span></li>
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
                    <div class="card-title">Role Create</div>
                    <div class="card-body">
                        @include("backend.layouts.partials.notify")
                        <div class="data-tables">
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">

                                </div>
                                <div class="form-group">
                                  <label for="name">Permissions</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="permissionAll" value="">
                                        <label class="form-check-label" for="permissionAll">All</label>
                                    </div>

                                    <hr>
                                    @forelse ($permission_groups as $permission_group )
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input perGrpName" data-gname="{{ $permission_group->name }}_checkbox" id="permission_{{ $permission_group->name }}" >
                                                    <label class="form-check-label" for="permission_{{ $permission_group->name }}">{{ $permission_group->name }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                {{-- @php
                                                    dd($permissions->where('group_name',$permission_group->name))
                                                @endphp --}}
                                                @forelse ($permissions->where('group_name',$permission_group->name) as $permission )
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input singPerName {{ $permission_group->name.'_checkbox' }}"
                                                    {{-- data-gname="{{ $permission_group->name }}_checkbox"  --}}
                                                    data-gname="{{ $permission_group->name }}_checkbox"
                                                    data-pargnameid="permission_{{ $permission_group->name }}"

                                                    name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}">
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

<script>
    $(document).on('change','#permissionAll',function(e){
        e.preventDefault();
        if($(this).prop('checked')){
            //is checked
            $('input[type=checkbox]').prop('checked',true);
            // console.log('checked');
        }else{
            //uncheck
            $('input[type=checkbox]').prop('checked',false);
            // console.log('uncheck');
        }

        // console.log('change');
    });

    //single group wise  permission check
    $(document).on('change','.perGrpName',function(e){
        e.preventDefault();
        let target = $(this);
        let perGrpName = target.data('gname');
        var grpAllParTar = $("."+perGrpName);
        if(target.prop('checked')){

            grpAllParTar.prop('checked',true);
        }else{
            grpAllParTar.prop('checked',false);
        }
        // console.log(perGrpName);
    });
    // single permision change
    $(document).on('change','.singPerName',function(e){
        e.preventDefault();
        var target = $(this);
        let gname = target.data('gname');
        let pargnameid = target.data('pargnameid');
        var parCheckAry = [];
        $('.'+gname).each(function(){
            if(!$(this).prop('checked')){
                // $("#"+pargnameid).prop('checked',false);
                parCheckAry.push(0);
            }else{
                // $("#"+pargnameid).prop('checked',true);
                parCheckAry.push(1);
            }
            console.log(gname);
        });

        if($.inArray(0,parCheckAry) != -1){
            $("#"+pargnameid).prop('checked',false);
        }else{
            $("#"+pargnameid).prop('checked',true);
        }

        // console.log(parCheckAry);

    });
</script>

@endpush
