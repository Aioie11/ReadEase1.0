<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ReadEase | Login</title>
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

        .login-container {
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

        .login-section {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .login-title {
            font-size: 2rem;
            color: #004aad;
            margin-bottom: 2rem;
            font-weight: 600;
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

        .login-btn {
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

        .login-btn:hover {
            background: #003d8f;
            transform: translateY(-2px);
        }

        .forgot-password {
            text-align: right;
            margin-top: 1rem;
        }

        .forgot-password a {
            color: #004aad;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: #003d8f;
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

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 1rem;
            }

            .brand-section {
                padding: 2rem;
            }

            .login-section {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="brand-section">
            <img src="{{ asset('pic/logo .png') }}" alt="ReadEase Logo" height="100px" width="100px"><br>
            <h1 class="brand-title">ReadEase</h1>
            <p class="brand-subtitle">Smarter Reading assessments for Better teaching!</p>
        </div>
        
        <div class="login-section">
            <form method="POST" action="{{ route('login.post') }}" class="login-form">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <h2 class="login-title">Welcome!</h2>
                
                <div class="form-group">
                    <input type="text" 
                           name="userId" 
                           id="userId" 
                           class="form-control" 
                           placeholder="User ID" 
                           required>
                </div>
                
                <div class="form-group">
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control" 
                           placeholder="Password" 
                           required>
                </div>
                
                <button type="submit" class="login-btn">Log In</button>
                
                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
