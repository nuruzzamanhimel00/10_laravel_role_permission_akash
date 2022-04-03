
@if ($errors->any())
<div class="alert alert-danger">
    <div>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
</div>
@endif

@if(\Session::has('success'))
<div class="alert alert-success">
    <div>
       {{ \Session::get('success') }}
    </div>
</div>
@endif

@if(\Session::has('error'))
<div class="alert alert-success">
    <div>
       {{ \Session::get('error') }}
    </div>
</div>
@endif
