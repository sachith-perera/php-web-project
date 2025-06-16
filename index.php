<!DOCTYPE html>
<?php session_start(); ?>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/e70056d8f4.js" crossorigin="anonymous"></script>
  <title>St.Joseph's Healthcare</title>
</head>

<body>
  <!-- insert NavBar from php -->
  <?php include 'navbar.php'; ?>



  <div class="container-fluid mt-1">
    <div class="clearfix">
      <img src="images/carasoul1.png" class="col-md-6 float-md-end mb-3 ms-md-3" alt="...">

      <h2 class="text-center">St. Joseph's Health Care London</h2>
      <p class="text-center">
        St. Joseph's Health Care London is one of the most complex health care organizations in Ontario. We partner with
        London's academic health sciences community to advance health care, education and research. We provide care
        through a leading teaching hospital and a unique mix of clinical settings across our community.
      </p>

    </div>

  </div>


  <div class="container mt-3 mb-2">
    <div class="row">
      <div class="card col-3 me-auto">
        <img src="images/doctalks.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-center">DocTalks</h5>
          <p class="card-text">Find out what is new and relevant in the world of medicine with our community health
            lectures and podcast series featuring leading physicians and researchers at St. Joseph's Health Care London.
          </p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>

      <div class="card col-3 me-auto">
        <img src="images/mystjoes.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-center">My St. Joseph's</h5>
          <p class="card-text">Our magazine shares stories of innovation, discovery and compassionate care that make a
            lasting difference in helping our patients live their best lives.</p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>

      <div class="card col-3 col-auto">
        <img src="images/carasoul2.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-center">8th Annual Canadian Peripheral Nerve Symposium</h5>
          <p class="card-text">In its 8th year, this meeting will once again bring together leading surgeons,
            therapists, physiatrists and neurologists from across Canad.</p>
          <a href="#" class="btn btn-primary">Register</a>
        </div>
      </div>

    </div>
  </div>


  <!--Footer -->
  <div class="container-fluid bg-body-tertiary" data-bs-theme="dark">
    <div class="row">
      <div class="col-5 mt-2">
        <p class="text-start text-secondary-emphasis">Copyright &copy; 2024 St. Joseph's Health Care London. All Rights
          Reserved</p>
      </div>

      <div class="col-3">

      </div>

      <div class="col-4 text-end mt-2">
        <a class="mx-2" href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook fa-xl"></i></a>
        <a class="mx-2" href="https://www.instagram.com/" target="_blank"><i
            class="fa-brands fa-instagram fa-xl"></i></a>
        <a class="mx-2" href="https://www.x.com" target="_blank"><i class="fa-brands fa-twitter fa-xl"></i></i></a>
      </div>

    </div>
  </div>

  </div>

 

  



</body>