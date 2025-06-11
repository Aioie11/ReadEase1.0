<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReadEase | Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #e3f2fd 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .change-password-container {
            width: 100%;
            max-width: 1200px;
            margin: 2rem;
            display: flex;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .brand-section {
            flex: 1;
            padding: 3rem;
            background: linear-gradient(135deg, #004aad 0%, #38B6FF 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .brand-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 2rem;
            filter: brightness(0) invert(1);
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .brand-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .form-section {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .change-password-form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .form-title {
            font-size: 2rem;
            color: #004aad;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .form-subtitle {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid #e3e3e3;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #004aad;
            box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: #004aad;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #003d8f;
            transform: translateY(-2px);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .password-requirements {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .password-requirements h6 {
            color: #004aad;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .password-requirements li {
            color: #666;
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .change-password-container {
                flex-direction: column;
                margin: 1rem;
            }

            .brand-section {
                padding: 2rem;
            }

            .form-section {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="change-password-container">
        <div class="brand-section">
            <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo" height="100px" width="100px"><br>
            <h1 class="brand-title">ReadEase</h1>
            <p class="brand-subtitle">Secure your account with a new password</p>
        </div>
        
        <div class="form-section">
            <form method="POST" action="{{ route('password.change.post') }}" class="change-password-form" id="changePasswordForm">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token-input">
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
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
                
                <h2 class="form-title">Change Password</h2>
                <p class="form-subtitle">
                    For security reasons, you must change your password before accessing the system.
                </p>

                <div class="password-requirements">
                    <h6>Password Requirements:</h6>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Contains at least one uppercase letter</li>
                        <li>Contains at least one lowercase letter</li>
                        <li>Contains at least one number</li>
                    </ul>
                </div>
                
                <div class="form-group">
                    <input type="password" 
                           name="current_password" 
                           id="current_password" 
                           class="form-control" 
                           placeholder="Current Password" 
                           required>
                </div>
                
                <div class="form-group">
                    <input type="password" 
                           name="new_password" 
                           id="new_password" 
                           class="form-control" 
                           placeholder="New Password" 
                           required>
                </div>
                
                <div class="form-group">
                    <input type="password" 
                           name="new_password_confirmation" 
                           id="new_password_confirmation" 
                           class="form-control" 
                           placeholder="Confirm New Password" 
                           required>
                </div>
                
                <button type="submit" class="submit-btn">Change Password</button>
            </form>
        </div>
    </div>

    <script>
        // Handle CSRF token and form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('changePasswordForm');
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfTokenInput = document.getElementById('csrf-token-input');

            // Ensure CSRF token is present and up to date
            if (csrfTokenMeta && csrfTokenInput) {
                csrfTokenInput.value = csrfTokenMeta.getAttribute('content');
            }

            // Add form validation and submission handling
            form.addEventListener('submit', function(e) {
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('new_password_confirmation').value;

                // Basic validation
                if (!currentPassword.trim()) {
                    e.preventDefault();
                    alert('Please enter your current password.');
                    return false;
                }

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('New password and confirmation do not match.');
                    return false;
                }

                // Check password requirements
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
                if (!passwordRegex.test(newPassword)) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long and contain uppercase, lowercase, and number.');
                    return false;
                }

                // Refresh CSRF token one more time before submission
                if (csrfTokenMeta && csrfTokenInput) {
                    csrfTokenInput.value = csrfTokenMeta.getAttribute('content');
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Changing Password...';
                }
            });

            // Handle form errors (419 specifically)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('error') === '419') {
                alert('Your session has expired. Please try again.');
                // Refresh the page to get a new CSRF token
                window.location.href = window.location.pathname;
            }
        });
    </script>
</body>

</html>
