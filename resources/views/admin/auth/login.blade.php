<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exbhix Admin Login</title>
</head>

<body>

    <div class="auth-wrap">

        <!-- Brand panel -->
        <div class="auth-brand">

            <svg class="arcs" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="480" cy="60" r="120" />
                <circle cx="480" cy="60" r="200" />
                <circle cx="480" cy="60" r="280" />
                <circle cx="480" cy="60" r="360" />
            </svg>

            <div class="auth-brand-inner">
                {{-- <div class="mark">&#10022;</div> --}}

                <h1>Exbhex Admin</h1>
                <p>Oversee companies, listings, and enquiries across the marketplace from a single console.</p>
            </div>

            <div class="auth-brand-foot">&copy; {{ date('Y') }} Exbhex. Admin access only.</div>
        </div>

        <!-- Form panel -->
        <div class="auth-form-panel">

            <div class="auth-form-inner">

                <div class="form-brand">Exbhex</div>

                <h2>Welcome back!</h2>
                <p class="auth-sub">Sign in to access the admin console.</p>

                @if ($errors->any())
                    <div class="auth-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
                    @csrf

                    <div class="field">
                        <input type="email" id="email" name="email" placeholder="Email address"
                            value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="field">
                        <div class="password-row">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <button type="button" class="toggle-pass" id="togglePass" aria-label="Show password"
                                tabindex="-1">
                                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Login now</button>

                    <div class="field-row">
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        {{-- <span class="forgot">Forgot password? <a href="#">Click here</a></span> --}}
                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        (function() {
            const toggle = document.getElementById('togglePass');
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            const eyeOpen = '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/>';
            const eyeClosed =
                '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a18.6 18.6 0 0 1 5.06-5.94M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 7 11 7a18.6 18.6 0 0 1-2.16 3.19M14.12 14.12a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';

            toggle.addEventListener('click', function() {
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                icon.innerHTML = isHidden ? eyeClosed : eyeOpen;
                toggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        })();
    </script>

</body>

<style>
    :root {
        --deep-blue: #0D3B7A;
        --deep-blue-dark: #092b5c;
        --orange: #F7941E;
        --orange-dark: #dd8112;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Inter, Roboto, sans-serif;
        color: #111827;
    }

    .auth-wrap {
        display: flex;
        min-height: 100vh;
    }

    /* ---------- Brand panel ---------- */

    .auth-brand {
        width: 46%;
        min-width: 380px;
        background: var(--deep-blue);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 48px 56px;
        position: relative;
        overflow: hidden;
    }

    .arcs {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .arcs circle {
        fill: none;
        stroke: rgba(255, 255, 255, 0.10);
        stroke-width: 1.5;
    }

    .auth-brand-inner {
        position: relative;
        z-index: 1;
        margin-top: 40px;
    }

    .mark {
        font-size: 34px;
        color: var(--orange);
        margin-bottom: 28px;
        line-height: 1;
    }

    .auth-brand-inner h1 {
        font-size: 40px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin: 0 0 18px;
    }

    .wave {
        display: inline-block;
        margin-left: 6px;
    }

    .auth-brand-inner p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 15px;
        line-height: 1.6;
        max-width: 340px;
        margin: 0;
    }

    .auth-brand-foot {
        position: relative;
        z-index: 1;
        font-size: 12.5px;
        color: rgba(255, 255, 255, 0.5);
    }

    /* ---------- Form panel ---------- */

    .auth-form-panel {
        flex: 1;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .auth-form-inner {
        width: 100%;
        max-width: 360px;
    }

    .form-brand {
        font-size: 15px;
        font-weight: 700;
        color: var(--deep-blue);
        margin-bottom: 36px;
        letter-spacing: -0.01em;
    }

    .auth-form-inner h2 {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.01em;
        margin: 0 0 6px;
    }

    .auth-sub {
        color: #6b7280;
        font-size: 14.5px;
        margin: 0 0 30px;
    }

    .auth-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: 13.5px;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .field {
        margin-bottom: 18px;
    }

    .field input[type="email"],
    .field input[type="password"] {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14.5px;
        background: transparent;
        outline: none;
        transition: border-color .2s;
    }

    .field input::placeholder {
        color: #9ca3af;
    }

    .field input:focus {
        border-color: var(--deep-blue);
    }

    .password-row {
        display: flex;
        align-items: center;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        transition: border-color .2s;
    }

    .password-row:focus-within {
        border-color: var(--deep-blue);
    }

    .password-row input {
        border: none !important;
        flex: 1;
    }

    .toggle-pass {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 4px 12px;
        display: flex;
    }

    .toggle-pass:hover {
        color: #4b5563;
    }

    .submit-btn {
        width: 100%;
        background: var(--orange);
        color: white;
        border: none;
        padding: 13px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        margin: 10px 0 20px;
    }

    .submit-btn:hover {
        background: var(--orange-dark);
    }

    .field-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #4b5563;
        cursor: pointer;
        user-select: none;
    }

    .remember input {
        accent-color: var(--deep-blue);
    }

    .forgot {
        font-size: 13px;
        color: #6b7280;
    }

    .forgot a {
        color: var(--orange);
        font-weight: 600;
        text-decoration: none;
    }

    .forgot a:hover {
        text-decoration: underline;
    }

    @media (max-width: 860px) {
        .auth-brand {
            display: none;
        }

        .auth-form-panel {
            width: 100%;
        }
    }
</style>

</html>
