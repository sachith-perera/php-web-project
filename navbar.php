
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/logo.svg"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mental Health
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Finding Help</a></li>
                        <li><a class="dropdown-item" href="#">Brochures</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="patient.php">Patient Details</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu dropdown-submenu">
                        <li>
                            <a class="dropdown-item" href="#">Psychiatry</a>
                            <ul class="dropdown-menu dropdown-submenu">
                                <li>
                                    <a class="dropdown-item" href="appointments.html">Book Appointments</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        News
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Press Releases</a></li>
                        <li><a class="dropdown-item" href="#">FAQ</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">About Us</a></li>
                        <li><a class="dropdown-item" href="#">Our Team</a></li>
                        <li><a class="dropdown-item" href="#">Contact Us</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <form class="d-flex">
            <div class="p-2">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"
                    checked>
                <label class="form-check-label text-secondary-emphasis" for="inlineRadio1">En</label>
            </div>

            <div class="p-2">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="option2">
                <label class="form-check-label text-secondary-emphasis" for="inlineRadio2">Fr</label>
            </div>

        </form>
        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            ?>
            <form class="d-flex" action="logout.php">
                <button class="btn btn-primary" type="submit">Welcome <?php echo $_SESSION['user']?></button>
            </form>
        <?php } else { ?>
            <form class="d-flex" action="login.php">
                <button class="btn btn-primary" type="submit">Login</button>
                <form>
                <?php } ?>
    </div>
</nav>