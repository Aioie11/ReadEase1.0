<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkimVett | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #e3f2fd;
        }

        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        header {
            align-items: center;
            padding: 15px 30px;
            background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);
        }

        .title h1 {
            font-size: 24px;
        }

        .title p {
            font-size: 14px;
        }

        .login-btn {
            background-color: #004aad;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-left: 600px;
            margin-top: -200px;
        }

        .hero {
            background: url('pic/bg.jpg') no-repeat center center/cover;
            height: 350px;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        
         /*footer*/

.vision {
    padding: 15px;
    color: white;
    font-size: 14px;
    text-align: justify;
    background-color: #0032A0;
}
.footerA{

    color: white;
    background-color:  #0032A0;
}

.footerSL{
    align-items: center;
}

footer{
    text-align: center;
    background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);
    color: black;
    padding: 10px 0;
}

.btnsearch{
    margin-top: 30px;
    border: none;
    padding: 5.8px 10px;
    border-radius: 10px;
    width: 70%;
}

.foot p {
    font-size: 12px;
    color:rgb(255, 255, 255);
    margin: 0;
    padding: 5px 0;
}

        .right-panel {
            width: 35%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
        }

        .login-card {
            background: #bbb7b7;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 350px;
        }

        .login-card h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #003366;
            text-align: center;
        }

        .login-card input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .forgot {
            font-size: 12px;
            text-align: right;
            color: #007bff;
            cursor: pointer;
        }

        .login-card button {
            width: 100%;
            padding: 10px;
            background: #29a8ff;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div class="left-panel">
    <header class="d-flex justify-content-between align-items-center px-4 py-2"
        style="background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);">
    
    <!-- Logo and Text -->
    <div class="d-flex align-items-center">
        <img src="{{ asset('pic/logo .png') }}" height="80" width="80" alt="SkimVett Logo" class="me-3">
        <div class="lh-sm">
            <h1 class="fs-4 fw-bold mb-1">SkimVett</h1>
            <p class="fs-6 mb-0">Smarter Reading assessments for Better teaching!</p>
        </div>
    </div>

    <!-- Login Button -->
    <a href="{{ url('/login') }}">
        <button class="btn px-4 py-2 rounded-pill text-white fw-semibold" 
                style="background-color: #004aad; border: none;">
            LOG IN
        </button>
    </a>
</header>


        <section class="hero">
            <h1>Read More to Influence future!</h1>
            <p>Efficient reading will be taught throughout Philippines to make young individuals learn through reading and its comprehensiveness</p>
        </section>

        <div class="footerA row m-0">
            <div class="col-md-4 vision">
                <h2>VISION</h2>
                <p class="pjust">The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.
                   The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.</p>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('pic/slogo.png') }}" height="140" width="140" alt="ReadEase Logo">
                <p class="mt-2">Calingcaguing National Highschool</p>
            </div>

            <div class="col-md-4 foot">
                <form>
                    <input class ="btnsearch" type="text" placeholder="Search.." aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </form><br>
            
                <p><img src="{{ asset('pic/location.png') }}" height="20px" weight = "15px"> Calingcaguing, Banug, Philippines, 6519<p>
                <p><img src="{{ asset('pic/mail.png ') }}" height="20px" weight = "15px"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}" height="20px" weight = "15px"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer>
    </div>

    <div class="right-panel">
        <form class="login-card" onsubmit="return handleLogin(event)">
            <h2>Log In to your Teacher's Account</h2>
            <input type="email" id="email" placeholder="Email" required />
            <input type="password" id="password" placeholder="Password" required />
            <div class="forgot">Forgot Password?</div>
            <button type="submit">Log In</button>
        </form>
    </div>

    <script>
        function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            if (email === "teacher@example.com" && password === "password123") {
                alert("Login successful! Redirecting to dashboard...");
                // Add your redirect logic here
            } else {
                alert("Invalid email or password. Please try again.");
            }
        }
    </script>
</body>

</html>
