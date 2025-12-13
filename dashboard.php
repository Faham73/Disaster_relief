<?php include 'header.php'; ?>
<style>
    .hero-slide {
        position: relative;
        display: flex;
        align-items: center;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        color: #fff;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.55);
        z-index: 5;
    }

    .stat-card {
        border-left: 6px solid #c82333;
        transition: 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-6px);
    }

    .section-title {
        border-left: 6px solid #c82333;
        padding-left: 12px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .donate-box {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
    }

    .donate-btn {
        background: #c82333;
        color: #fff;
        padding: 12px 18px;
        border-radius: 50px;
        font-weight: bold;
        border: none;
    }

    .donate-btn:hover {
        background: #a71d2a;
    }
</style>

<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="hero-slide" style="
                background: url('./assets/images/hero_1.jpg') center/cover no-repeat;
                height: 65vh;
                position: relative;">

                <div class="overlay"></div>

                <div class="container hero-content">
                    <h1 class="display-4 fw-bold">Disaster Relief Resource Distribution</h1>
                    <p class="lead mt-3">
                        Fast, effective, and humane response for every emergency.
                    </p>
                    <a href="add_disaster.php" class="btn btn-danger btn-lg mt-3">Report a Disaster</a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="hero-slide" style="
                background: url('./assets/images/hero.webp') center/cover no-repeat;
                height: 65vh;
                position: relative;">

                <div class="overlay"></div>

                <div class="container hero-content">
                    <h1 class="display-4 fw-bold">We Respond Every 8 Minutes</h1>
                    <p class="lead mt-3">
                        Providing clean water, safe shelter, food & emergency supplies.
                    </p>
                    <a href="view_distribution.php" class="btn btn-danger btn-lg mt-3">View Relief Operations</a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="hero-slide" style="
                background: url('./assets/images/hero_2.jpg') center/cover no-repeat;
                height: 65vh;
                position: relative;">

                <div class="overlay"></div>

                <div class="container hero-content">
                    <h1 class="display-4 fw-bold">95% of Our Workforce Are Volunteers</h1>
                    <p class="lead mt-3">
                        Together, we save lives and restore hope.
                    </p>
                    <a href="volenteer_assign.php" class="btn btn-danger btn-lg mt-3">Assign Volunteers</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
</div>


<div class="container my-5">

    <section class="py-5 bg-light">
        <div class="container text-center">

            <h2 class="fw-bold mb-3">Need Help Now?</h2>

            <p class="lead text-muted mb-4">
                If you are in immediate need of help, please contact your local disaster relief center
                or find an open emergency shelter near you.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="#" class="btn btn-danger btn-lg px-4 py-2 fw-semibold">
                    Contact Local Relief Center »
                </a>

                <a href="#" class="btn btn-outline-danger btn-lg px-4 py-2 fw-semibold">
                    Find an Open Shelter »
                </a>
            </div>

        </div>
    </section>


    <!-- Quick Stats -->
    <h3 class="section-title">We Respond. We Recover. We Help.</h3>
    <div class="row g-4">

        <div class="col-md-4">
            <div class="p-4 bg-white shadow stat-card rounded">
                <h2 class="text-danger">8 Minutes</h2>
                <p>Frequency of emergencies we respond to.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 bg-white shadow stat-card rounded">
                <h2 class="text-danger">95%</h2>
                want volunteers
                <p>Of our workforce are dedicated volunteers.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 bg-white shadow stat-card rounded">
                <h2 class="text-danger">65,000+</h2>
                <p>Annual disaster responses nationwide.</p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <h3 class="section-title mt-5">System Management</h3>
    <div class="row g-4">

        <div class="col-md-3">
            <a href="add_resource.php" class="btn btn-outline-danger w-100 p-3">
                Add Resources
            </a>
        </div>

        <div class="col-md-3">
            <a href="add_victim.php" class="btn btn-outline-danger w-100 p-3">
                Register Victim
            </a>
        </div>

        <div class="col-md-3">
            <a href="volenteer_assign.php" class="btn btn-outline-danger w-100 p-3">
                Assign Volunteers
            </a>
        </div>

        <div class="col-md-3">
            <a href="distribute.php" class="btn btn-outline-danger w-100 p-3">
                Distribute Resources
            </a>
        </div>

        <div class="col-md-3 mt-3">
            <a href="view_distribution.php" class="btn btn-danger w-100 p-3">
                View Distribution Records
            </a>
        </div>

    </div>

    <!-- About Section -->
    <h3 class="section-title mt-5">About Disaster Response</h3>
    <p class="lead">
        Our mission is simple: bring urgent relief to individuals, families, and communities
        affected by disasters — big or small. We provide safe shelter, clean water, hot meals,
        emergency supplies, medical aid, and emotional support.
    </p>

    <!-- Donate Box -->
    <div class="donate-box mt-5 shadow-sm">
        <h3>Support Disaster Relief Efforts</h3>
        <p class="text-muted">Your support helps deliver care and comfort to those in need.</p>

        <div class="d-flex justify-content-center gap-3 mt-3">
            <button class="donate-btn">$50</button>
            <button class="donate-btn">$100</button>
            <button class="donate-btn">$250</button>
            <button class="donate-btn">$500</button>
        </div>

        <button class="donate-btn mt-3 px-5">Donate Now</button>
    </div>

</div>

<?php include 'footer.php'; ?>