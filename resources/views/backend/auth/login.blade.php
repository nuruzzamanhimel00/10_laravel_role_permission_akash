@extends("backend.auth.partials.auth_master")

@section('auth_title')
login - Admin Panel
@endsection
@section('auth-content')
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="login-form-head">
                    <h4>Sign In</h4>

                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" id="exampleInputEmail1" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" id="exampleInputPassword1" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                            </div>

                        </div>
                        <div class="col-6 text-right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>

                    </div>
                    {{-- <div class="form-footer text-center mt-5">
                        <p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p>
                    </div> --}}
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
