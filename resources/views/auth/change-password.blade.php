<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReadEase | Change Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/readease-colors.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .change-password-container {
            width: 100%;
            max-width: 1000px;
            height: 650px;
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .brand-section {
            flex: 1;
            background: linear-gradient(135deg, #00B8A9 0%, #4DD0E1 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            padding: 3rem;
        }

        .brand-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 70%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .brand-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            font-weight: 400;
            max-width: 300px;
        }

        .form-section {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            overflow-y: auto;
        }

        .change-password-form {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
        }

        .form-header {
            margin-bottom: 1.5rem;
        }

        .form-title {
            font-size: 1.8rem;
            color: #00B8A9;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-subtitle {
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.5;
            font-size: 0.85rem;
        }

        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 0.8rem 0.8rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            color: #1e293b;
        }

        .form-control:focus {
            border-color: #00B8A9;
            box-shadow: 0 0 0 4px rgba(0, 184, 169, 0.1);
            outline: none;
            background: white;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-icon {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
            z-index: 1;
        }

        .password-toggle {
            position: absolute;
            right: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            cursor: pointer;
            font-size: 1rem;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #00B8A9;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: #00B8A9;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: #009688;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 184, 169, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.2);
            color: #dc2626;
        }

        .alert-success {
            background: rgba(0, 184, 169, 0.05);
            border-color: rgba(0, 184, 169, 0.2);
            color: #00B8A9;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        .alert li:last-child {
            margin-bottom: 0;
        }

        .password-requirements {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 0.8rem;
        }

        .password-requirements h6 {
            color: #00B8A9;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 1rem;
        }

        .password-requirements li {
            color: #475569;
            margin-bottom: 0.3rem;
            line-height: 1.3;
        }

        .password-requirements li:last-child {
            margin-bottom: 0;
        }

        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #3b82f6; width: 75%; }
        .strength-strong { background: #00B8A9; width: 100%; }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .change-password-container {
                flex-direction: column;
                height: auto;
                min-height: 550px;
            }

            .brand-section {
                min-height: 180px;
                padding: 1.5rem;
            }

            .brand-title {
                font-size: 2rem;
            }

            .brand-subtitle {
                font-size: 0.9rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .brand-section,
            .form-section {
                padding: 1rem;
            }

            .brand-title {
                font-size: 1.8rem;
            }

            .form-title {
                font-size: 1.4rem;
            }

            .change-password-container {
                min-height: 500px;
            }
        }
    </style>
</head>

<body>
    <div class="change-password-container">
        <div class="brand-section">
            <div class="brand-content">
                <div class="logo-container">
                    <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo">
                </div>
                <h1 class="brand-title">ReadEase</h1>
                <p class="brand-subtitle">Secure Your Account with a Strong Password</p>
            </div>
        </div>

        <div class="form-section">
            <form method="POST" action="{{ route('password.change.post') }}" class="change-password-form" id="changePasswordForm">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token-input">

                <div class="form-header">
                    <h2 class="form-title">Change Password</h2>
                    <p class="form-subtitle">
                        For security reasons, you must change your password before accessing the system.
                    </p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="password-requirements">
                    <h6>
                        <i class="fas fa-shield-alt"></i>
                        Password Requirements:
                    </h6>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Contains at least one uppercase letter (A-Z)</li>
                        <li>Contains at least one lowercase letter (a-z)</li>
                        <li>Contains at least one number (0-9)</li>
                    </ul>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password"
                           name="current_password"
                           id="current_password"
                           class="form-control"
                           placeholder="Current Password"
                           required
                           autocomplete="current-password">
                    <i class="fas fa-eye password-toggle" id="currentPasswordToggle"></i>
                </div>

                <div class="form-group">
                    <i class="fas fa-key form-icon"></i>
                    <input type="password"
                           name="new_password"
                           id="new_password"
                           class="form-control"
                           placeholder="New Password"
                           required
                           autocomplete="new-password">
                    <i class="fas fa-eye password-toggle" id="newPasswordToggle"></i>
                    <div class="password-strength" id="passwordStrength">
                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                    </div>
                </div>

                <div class="form-group">
                    <i class="fas fa-check-circle form-icon"></i>
                    <input type="password"
                           name="new_password_confirmation"
                           id="new_password_confirmation"
                           class="form-control"
                           placeholder="Confirm New Password"
                           required
                           autocomplete="new-password">
                    <i class="fas fa-eye password-toggle" id="confirmPasswordToggle"></i>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span>Change Password</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Handle CSRF token and form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('changePasswordForm');
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfTokenInput = document.getElementById('csrf-token-input');
            const newPasswordInput = document.getElementById('new_password');
            const confirmPasswordInput = document.getElementById('new_password_confirmation');
            const strengthBar = document.getElementById('passwordStrengthBar');
            const submitBtn = document.getElementById('submitBtn');

            // Ensure CSRF token is present and up to date
            if (csrfTokenMeta && csrfTokenInput) {
                csrfTokenInput.value = csrfTokenMeta.getAttribute('content');
            }

            // Auto-focus on current password field
            document.getElementById('current_password').focus();

            // Password toggle functionality
            function setupPasswordToggle(toggleId, inputId) {
                const toggle = document.getElementById(toggleId);
                const input = document.getElementById(inputId);

                if (toggle && input) {
                    toggle.addEventListener('click', function() {
                        if (input.type === 'password') {
                            input.type = 'text';
                            toggle.classList.remove('fa-eye');
                            toggle.classList.add('fa-eye-slash');
                        } else {
                            input.type = 'password';
                            toggle.classList.remove('fa-eye-slash');
                            toggle.classList.add('fa-eye');
                        }
                    });
                }
            }

            // Setup password toggles
            setupPasswordToggle('currentPasswordToggle', 'current_password');
            setupPasswordToggle('newPasswordToggle', 'new_password');
            setupPasswordToggle('confirmPasswordToggle', 'new_password_confirmation');

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;

                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/\d/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                return strength;
            }

            // Update password strength indicator
            newPasswordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);

                strengthBar.className = 'password-strength-bar';

                if (password.length === 0) {
                    strengthBar.style.width = '0%';
                } else if (strength <= 2) {
                    strengthBar.classList.add('strength-weak');
                } else if (strength === 3) {
                    strengthBar.classList.add('strength-fair');
                } else if (strength === 4) {
                    strengthBar.classList.add('strength-good');
                } else {
                    strengthBar.classList.add('strength-strong');
                }
            });

            // Real-time password confirmation validation
            function validatePasswordMatch() {
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword && newPassword !== confirmPassword) {
                    confirmPasswordInput.setCustomValidity('Passwords do not match');
                } else {
                    confirmPasswordInput.setCustomValidity('');
                }
            }

            newPasswordInput.addEventListener('input', validatePasswordMatch);
            confirmPasswordInput.addEventListener('input', validatePasswordMatch);

            // Add form validation and submission handling
            form.addEventListener('submit', function(e) {
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                // Basic validation
                if (!currentPassword.trim()) {
                    e.preventDefault();
                    alert('Please enter your current password.');
                    document.getElementById('current_password').focus();
                    return false;
                }

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('New password and confirmation do not match.');
                    confirmPasswordInput.focus();
                    return false;
                }

                // Check password requirements
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
                if (!passwordRegex.test(newPassword)) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.');
                    newPasswordInput.focus();
                    return false;
                }

                // Refresh CSRF token one more time before submission
                if (csrfTokenMeta && csrfTokenInput) {
                    csrfTokenInput.value = csrfTokenMeta.getAttribute('content');
                }

                // Show loading state
                if (submitBtn) {
                    submitBtn.disabled = true;
                    const span = submitBtn.querySelector('span');
                    if (span) {
                        span.textContent = 'Changing Password...';
                    }
                }
            });

            // Handle form errors (419 specifically)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('error') === '419') {
                alert('Your session has expired. Please try again.');
                // Refresh the page to get a new CSRF token
                window.location.href = window.location.pathname;
            }

            // Re-enable button after timeout in case of network issues
            setTimeout(() => {
                if (submitBtn && submitBtn.disabled) {
                    submitBtn.disabled = false;
                    const span = submitBtn.querySelector('span');
                    if (span) {
                        span.textContent = 'Change Password';
                    }
                }
            }, 10000);
        });
    </script>
</body>

</html>
