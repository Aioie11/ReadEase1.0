<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadEase - Smarter Reading assessments for Better teaching!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-size: cover;
            background-position: center;
            min-height: 500px;
            position: relative;
        }
        .hero-overlay {
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .navbar-brand img {
            height: 40px;
        }
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 24px;
        }
        .vision-section {
            background-color: #0d47a1;
            color: white;
            padding: 2rem 0;
        }
        .footer-section {
            background-color: #0d47a1;
            color: white;
            padding: 2rem 0;
        }
        .search-box {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="ReadEase Logo" class="me-2">
                <span>ReadEase</span>
            </a>
            <div class="ms-auto">
                <a href="{{ url('/logIn') }}" class="btn btn-primary">LOG IN</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('{{ asset('images/library.jpg') }}');">
        <div class="hero-overlay"></div>
        <div class="container position-relative h-100">
            <div class="row h-100 align-items-center text-center text-white">
                <div class="col-12">
                    <h1 class="display-4 mb-4">Read More to Influence future!</h1>
                    <p class="lead">
                        Efficient reading will be taught through out Philippines to make<br>
                        young individuals learn through reading and its comprehensiveness
                    </p>
                    <div class="social-links mt-4">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>VISION</h2>
                    <p>Efficient reading will be taught through out Philippines to make young individuals learn through reading and its comprehensiveness</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images/school-logo.png') }}" alt="School Logo" class="img-fluid" style="max-width: 150px;">
                    <p class="mt-2">Calingcaguing<br>National High School</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p><i class="fas fa-map-marker-alt"></i> Calingcaguing, Barugo, Philippines, 6519</p>
                    <p><i class="fas fa-envelope"></i> calingcaguingnationalhighschool@gmail.com</p>
                    <p><i class="fas fa-phone"></i> (053)-545-0025</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="search-box ms-auto">
                        <input type="search" class="form-control" placeholder="Search">
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p>&copy; 2025 SkimVett | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html>
