<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ReadEase | Login</title>
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

        .login-container {
            width: 100%;
            max-width: 1000px;
            height: 600px;
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

        .login-section {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
        }

        .login-form {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 1.8rem;
            color: #00B8A9;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.2rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 0.8rem 0.8rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
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

        .login-btn {
            width: 100%;
            padding: 0.8rem;
            background: #00B8A9;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .login-btn:hover {
            background: #009688;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 184, 169, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.2rem;
        }

        .forgot-password a {
            color: #00B8A9;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .forgot-password a:hover {
            color: #4DD0E1;
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

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .login-container {
                flex-direction: column;
                height: auto;
                min-height: 500px;
            }

            .brand-section {
                min-height: 200px;
                padding: 1.5rem;
            }

            .brand-title {
                font-size: 2rem;
            }

            .brand-subtitle {
                font-size: 0.9rem;
            }

            .login-section {
                padding: 1.5rem;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .brand-section,
            .login-section {
                padding: 1rem;
            }

            .brand-title {
                font-size: 1.8rem;
            }

            .login-title {
                font-size: 1.4rem;
            }

            .login-container {
                min-height: 450px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="brand-section">
            <div class="brand-content">
                <div class="logo-container">
                    <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo">
                </div>
                <h1 class="brand-title">ReadEase</h1>
                <p class="brand-subtitle">Smarter Reading Assessments for Better Teaching</p>
            </div>
        </div>

        <div class="login-section">
            <form method="POST" action="{{ route('login.post') }}" class="login-form">
                @csrf

                <div class="login-header">
                    <h2 class="login-title">Welcome Back to ReadEase</h2>
                    <p class="login-subtitle">Let's continue empowering smarter readers.</p>
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

                <div class="form-group">
                    <i class="fas fa-user form-icon"></i>
                    <input type="text"
                           name="userId"
                           id="userId"
                           class="form-control"
                           placeholder="User ID"
                           value="{{ old('userId') }}"
                           required
                           autocomplete="username">
                </div>

                <div class="form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Password"
                           required
                           autocomplete="current-password">
                    <i class="fas fa-eye password-toggle" id="passwordToggle"></i>
                </div>

                <button type="submit" class="login-btn">
                    <span>Sign In</span>
                </button>

                <div class="forgot-password">
                    <a href="#" onclick="alert('Please contact your administrator for password assistance.')">
                        Forgot your password?
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus on User ID field
            document.getElementById('userId').focus();

            // Password toggle functionality
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');

            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.remove('fa-eye');
                    passwordToggle.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.remove('fa-eye-slash');
                    passwordToggle.classList.add('fa-eye');
                }
            });

            // Add loading state to login button
            document.querySelector('.login-form').addEventListener('submit', function(e) {
                const button = this.querySelector('.login-btn');
                const span = button.querySelector('span');

                button.disabled = true;
                span.textContent = 'Signing in...';

                // Re-enable button after 5 seconds in case of network issues
                setTimeout(() => {
                    button.disabled = false;
                    span.textContent = 'Sign In';
                }, 5000);
            });
        });
    </script>
</body>

</html>
