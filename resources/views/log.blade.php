<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #e3f2fd;
            color: #333;
        }

        .hero {
            position: relative;
            background: url('pic/bg.jpg') no-repeat center center/cover;
            height: 400px;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 18px;
            max-width: 700px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons i {
            margin: 0 10px;
            font-size: 18px;
        }

 /*footer*/
 .footerA{
    padding: 40px 20px;
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
    border: none;
    padding: 5.8px 15px;
    border-radius: 10px;
    width: 70%;
}
    </style>
</head>

<body>
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
        <p>Efficient reading will be taught throughout Philippines to make young individuals learn through reading and
            its comprehensiveness</p>
        <div class="social-icons">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
        </div>
    </section>

    <div class="footerA row m-0">
            <div class="col-md-4">
                <h2>VISION</h2>
                <p class="pjust">The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.
                   The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.</p>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('pic/slogo.png') }}" height="148" width="150" alt="ReadEase Logo">
                <p class="mt-2">Calingcaguing National Highschool</p>
            </div>

            <div class="col-md-4 foot">
                <form>
                    <input class ="btnsearch" type="text" placeholder="Search.." aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </form><br>
            
                <p><img src="{{ asset('pic/location.png') }}" height="25px" weight = "25px"> Calingcaguing, Banug, Philippines, 6519<p>
                <p><img src="{{ asset('pic/mail.png ') }}" height="25px" weight = "25px"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}" height="25px" weight = "25px"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer>
</body>
</html>
