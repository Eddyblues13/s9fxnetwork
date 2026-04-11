@include('home.header')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .verify-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        min-height: 60vh;
        padding: 4rem 0;
        display: flex;
        align-items: center;
    }

    .verify-card {
        max-width: 480px;
        margin: 0 auto;
        background: #1e293b;
        border: 1px solid #334155;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .verify-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .verify-icon svg {
        width: 32px;
        height: 32px;
        stroke: #818cf8;
    }

    .verify-title {
        font-family: 'Inter', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #f1f5f9;
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .verify-description {
        font-family: 'Inter', sans-serif;
        font-size: 0.9375rem;
        color: #94a3b8;
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .verify-form .form-group {
        margin-bottom: 1.25rem;
    }

    .verify-form .form-label {
        display: block;
        font-family: 'Inter', sans-serif;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #cbd5e1;
        margin-bottom: 0.5rem;
    }

    .verify-form .input-wrapper {
        position: relative;
    }

    .verify-form .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #475569;
        pointer-events: none;
    }

    .verify-form .input-icon svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
    }

    .verify-form .form-input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 2.75rem;
        background: #0f172a;
        border: 1.5px solid #334155;
        border-radius: 10px;
        color: #e2e8f0;
        font-size: 1.125rem;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.2em;
        text-align: center;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }

    .verify-form .form-input::placeholder {
        color: #475569;
        letter-spacing: 0.15em;
    }

    .verify-form .form-input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.15);
    }

    .verify-form .btn-verify {
        width: 100%;
        padding: 0.875rem;
        background: linear-gradient(135deg, #6366f1, #818cf8);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 0.9375rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.2s;
        margin-top: 0.5rem;
    }

    .verify-form .btn-verify:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
    }

    .verify-form .btn-verify:active {
        transform: translateY(0);
    }

    .verify-resend {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #334155;
        font-family: 'Inter', sans-serif;
        font-size: 0.875rem;
        color: #64748b;
    }

    .verify-resend a {
        color: #818cf8;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .verify-resend a:hover {
        color: #a5b4fc;
    }

    .verify-form .invalid-feedback {
        color: #f87171;
        font-size: 0.8125rem;
        margin-top: 0.375rem;
        text-align: center;
    }

    .verify-form .form-input.is-invalid {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* Page title banner */
    .verify-banner {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 3rem 0 1rem;
        text-align: center;
    }

    .verify-banner h2 {
        font-family: 'Inter', sans-serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: #f1f5f9;
        margin-bottom: 0.75rem;
    }

    .verify-banner .breadcrumb {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
        font-family: 'Inter', sans-serif;
        font-size: 0.875rem;
    }

    .verify-banner .breadcrumb a {
        color: #818cf8;
        text-decoration: none;
    }

    .verify-banner .breadcrumb .active {
        color: #94a3b8;
    }

    @media (max-width: 576px) {
        .verify-card {
            margin: 0 1rem;
            padding: 2rem 1.25rem;
        }

        .verify-title {
            font-size: 1.25rem;
        }

        .verify-form .form-input {
            font-size: 1rem;
        }
    }
</style>

<!-- Start Page Title Area -->
<div class="verify-banner">
    <div class="container">
        <h2>Email Verification</h2>
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>/</li>
            <li class="active">Verify Email</li>
        </ul>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Verification Area -->
<section class="verify-section">
    <div class="container">
        <div class="verify-card">
            <div class="verify-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <h2 class="verify-title">Verify your email address</h2>
            <p class="verify-description">We've sent a verification code to your email. Enter it below to verify your
                account.</p>

            <div class="verify-form">
                <form method="POST" action="{{ route('verify.code') }}" accept-charset="utf-8">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="verification_code">Verification Code</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                </svg>
                            </span>
                            <input class="form-input @error('verification_code') is-invalid @enderror" type="text"
                                name="verification_code" id="verification_code" placeholder="Enter code" required
                                maxlength="6" autocomplete="one-time-code" inputmode="numeric">
                        </div>
                        @error('verification_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-verify">Verify Email</button>
                </form>

                <div class="verify-resend">
                    Didn't receive the code? <a href="{{ route('resend.verification.code') }}">Resend Code</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Verification Area -->

@include('home.footer')