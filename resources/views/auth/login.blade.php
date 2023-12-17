<x-app-layout>
    <!-- Login Begin -->
    <div class="signup-section-login" data-page="login">
        <div class="signup-login-close"><i class="fa fa-close"></i></div>
        <div class="signup-text">
            <div class="container">
                @if (session('login_error'))
                    <div id="failedLoginMessage" class="alert alert-danger">
                        {{ session('login_error') }}
                    </div>
                @elseif (session('not_user'))
                    <div id="failedLoginMessage" class="alert alert-danger">
                        {{ session('not_user') }}
                    </div>
                @elseif (session('not_admin'))
                    <div id="failedLoginMessage" class="alert alert-danger">
                        {{ session('not_admin') }}
                    </div>
                @endif
                <div class="signup-title">
                    <h2>Login</h2>
                </div>
                <form method="POST" action="{{ route('login') }}" autocomplete="off" class="login-form">
                    @csrf
                    <div class="sf-input-list">
                        <input id="userEmail" type="email" class="input-value" name="email" required autofocus placeholder="Email Address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>

                        <input id="userPassword" type="password" class="input-value" name="password" required data-eye placeholder="Password" value="{{ old('password') }}">
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-check mb-4">
                        <input name="remember" type="checkbox" class="form-check-input" id="remember">
                        <label for="remember" class="form-check-label text-white">Remember Me</label>
                    </div>
                    <button id="loginBtn" type="submit"><span>Login Now</span></button>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Section End -->
</x-app-layout>
