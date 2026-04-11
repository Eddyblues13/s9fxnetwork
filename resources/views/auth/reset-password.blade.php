<!DOCTYPE html>
<html lang="en">

<head>
    <title>S9fx Network | Reset Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Reset your S9fx Network account password. Secure access to your binary options and forex investments.">
    <meta name="author" content="S9fx Network">
    <meta name="keywords" content="Password Reset, S9fx Network, Binary Options, Forex Trading">
    <meta name="theme-color" content="#0f172a" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('auth/img/favicon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('auth/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            line-height: 1.6;
        }

        .auth-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left panel */
        .auth-panel-left {
            display: none;
            width: 55%;
            position: relative;
            overflow: hidden;
        }

        .auth-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.85) 0%, rgba(99, 102, 241, 0.85) 50%, rgba(139, 92, 246, 0.85) 100%);
            z-index: 1;
        }

        .auth-panel-left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .auth-panel-left-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            text-align: center;
        }

        .auth-panel-left-content .deco-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .auth-panel-left-content .deco-icon svg {
            width: 40px;
            height: 40px;
            stroke: #fff;
        }

        .auth-panel-left-content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
        }

        .auth-panel-left-content p {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 380px;
        }

        /* Right panel */
        .auth-panel-right {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            background: #0f172a;
        }

        .auth-form-container {
            width: 100%;
            max-width: 420px;
        }

        .auth-logo {
            display: block;
            margin-bottom: 2.5rem;
        }

        .auth-logo img {
            height: 48px;
            width: auto;
        }

        .auth-heading {
            font-size: 1.75rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.5rem;
        }

        .auth-subheading {
            font-size: 0.95rem;
            color: #94a3b8;
            margin-bottom: 2rem;
        }

        .auth-subheading a {
            color: #818cf8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .auth-subheading a:hover {
            color: #a5b4fc;
        }

        /* Alert messages */
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.25);
            color: #4ade80;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #f87171;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            pointer-events: none;
        }

        .input-wrapper .input-icon svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
        }

        .form-input {
            width: 100%;
            padding: 0.8125rem 0.875rem 0.8125rem 2.75rem;
            background: #1e293b;
            border: 1.5px solid #334155;
            border-radius: 10px;
            color: #e2e8f0;
            font-size: 0.9375rem;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-input::placeholder {
            color: #64748b;
        }

        .form-input:focus {
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.15);
        }

        .form-input.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            color: #f87171;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
        }

        .btn-primary {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #6366f1, #818cf8);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.9375rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s, opacity 0.2s;
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #1e293b;
            overflow: hidden;
            margin-bottom: 0.25rem;
        }

        .strength-bar-fill {
            height: 100%;
            border-radius: 2px;
            width: 0%;
            transition: width 0.3s, background 0.3s;
        }

        .strength-text {
            font-size: 0.75rem;
            color: #64748b;
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #64748b;
        }

        .form-footer a {
            color: #818cf8;
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            color: #a5b4fc;
        }

        /* Toggle password visibility */
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #475569;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .toggle-password:hover {
            color: #818cf8;
        }

        .toggle-password svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
        }

        /* Responsive */
        @media (min-width: 768px) {
            .auth-panel-left {
                display: block;
            }

            .auth-panel-right {
                width: 45%;
                padding: 3rem;
            }
        }

        @media (min-width: 1024px) {
            .auth-panel-right {
                padding: 4rem;
            }

            .auth-form-container {
                max-width: 440px;
            }
        }

        @media (max-width: 480px) {
            .auth-heading {
                font-size: 1.5rem;
            }

            .auth-panel-right {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <!-- Left decorative panel -->
        <div class="auth-panel-left">
            <img src="{{ asset('auth/img/in-signin-image.jpg') }}" alt="">
            <div class="auth-panel-left-content">
                <div class="deco-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <h2>Create a new password</h2>
                <p>Choose a strong password to keep your account secure and protected.</p>
            </div>
        </div>

        <!-- Right form panel -->
        <div class="auth-panel-right">
            <div class="auth-form-container">
                <a class="auth-logo" href="/">
                    <img src="{{ asset('image/logo.png') }}" alt="S9fx Network">
                </a>

                <h1 class="auth-heading">Reset Your Password</h1>
                <p class="auth-subheading">Remember your password? <a href="{{ route('login') }}">Sign in</a></p>

                <div id="form-messages">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                    @endif
                </div>

                <form id="password-reset-form" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </span>
                            <input class="form-input" name="email" id="email" type="email" placeholder="you@example.com"
                                required autocomplete="email" value="{{ $email ?? old('email') }}">
                        </div>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">New Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input class="form-input" id="password" type="password" placeholder="Enter new password"
                                name="password" required autocomplete="new-password" style="padding-right: 2.75rem;">
                            <button type="button" class="toggle-password" data-target="password"
                                aria-label="Toggle password visibility">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="eye-open">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="eye-closed"
                                    style="display:none">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-bar-fill" id="strengthFill"></div>
                            </div>
                            <span class="strength-text" id="strengthText"></span>
                        </div>
                        <div class="invalid-feedback" id="password-error"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password-confirm">Confirm Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input class="form-input" id="password-confirm" type="password"
                                placeholder="Confirm new password" name="password_confirmation" required
                                autocomplete="new-password" style="padding-right: 2.75rem;">
                            <button type="button" class="toggle-password" data-target="password-confirm"
                                aria-label="Toggle password visibility">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="eye-open">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="eye-closed"
                                    style="display:none">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="password_confirmation-error"></div>
                    </div>

                    <button class="btn-primary" type="submit" id="reset-button">Reset Password</button>
                </form>

                <div class="form-footer">
                    Don't have an account? <a href="{{ route('register') }}">Create one</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var target = document.getElementById(this.dataset.target);
                var isPassword = target.type === 'password';
                target.type = isPassword ? 'text' : 'password';
                this.querySelector('.eye-open').style.display = isPassword ? 'none' : 'block';
                this.querySelector('.eye-closed').style.display = isPassword ? 'block' : 'none';
            });
        });

        // Password strength meter
        document.getElementById('password').addEventListener('input', function() {
            var val = this.value;
            var strength = 0;
            if (val.length >= 8) strength++;
            if (/[a-z]/.test(val) && /[A-Z]/.test(val)) strength++;
            if (/\d/.test(val)) strength++;
            if (/[^a-zA-Z0-9]/.test(val)) strength++;

            var fill = document.getElementById('strengthFill');
            var text = document.getElementById('strengthText');
            var colors = ['#ef4444', '#f59e0b', '#eab308', '#22c55e'];
            var labels = ['Weak', 'Fair', 'Good', 'Strong'];
            var widths = ['25%', '50%', '75%', '100%'];

            if (val.length === 0) {
                fill.style.width = '0%';
                text.textContent = '';
            } else {
                var idx = Math.max(0, strength - 1);
                fill.style.width = widths[idx];
                fill.style.background = colors[idx];
                text.textContent = labels[idx];
                text.style.color = colors[idx];
            }
        });
    </script>
</body>

</html>