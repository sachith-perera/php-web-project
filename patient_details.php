<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e70056d8f4.js" crossorigin="anonymous"></script>
    <script src="js/savepatient.js"></script>
    <script src="js/patientdetails.js"></script>
    <script src="js/deletepatient.js"></script>
    <script src ="js/logout.js"></script>
    <title>Patients</title>
    </script>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class='container mt-3'>

        <div class="col-12">
            <p class="text-center fs-2 text">Patient Details</p>
        </div>
        <div class="row">
                <div class="col text-start">
                    <a class="btn btn-primary d-none" href="patient.php" role="button" id="back_link">Back</a>
                    <button type="button" class="btn btn-primary d-none" id="back_btn"
                        onclick="desableFormFields()">Back</button>
                </div>
                <div class="col text-end">
                    <button type="button" class="btn btn-primary d-none" id="edit"
                        onclick="enableFormFields()">Edit</button>
                    <button type="submit" class="btn btn-primary d-none" id="save" onclick="saveData()">Save</button>
                    <button type="button" class="btn btn-danger  d-none" id="delete"
                        onclick="deletePatient()">Delete</button>
                </div>
            </div>

        <form class="row g-3 mt-2" id="patient_data" method="POST">
            
            <div class="col-md-6">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control needs-validation" id="firstName" disabled required>
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control needs-validation" id="lastName" disabled required>
            </div>
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select needs-validation" aria-label="Disabled select example" disabled id="gender" required>
                    <option selected>Select Gender</option>
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                    <option value="O">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="dateOfBirth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control needs-validation" id="dateOfBirth" disabled required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control needs-validation" id="email" disabled required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control needs-validation" id="phone" disabled required>
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control needs-validation" id="address1" disabled required>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="address2" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control needs-validation" id="city" disabled required>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select class="form-select needs-validation" aria-label="Disabled select example" disabled id="state" required>
                    <option selected>Select State</option>
                    <option value="AB">Alberta</option>
                    <option value="BC">British Columbia</option>
                    <option value="MB">Manitoba</option>
                    <option value="NB">New Brunswick</option>
                    <option value="NL">Newfoundland and Labrador</option>
                    <option value="NS">Nova Scotia</option>
                    <option value="NT">Northwest Territories</option>
                    <option value="NU">Nunavut</option>
                    <option value="ON">Ontario</option>
                    <option value="PE">Prince Edward Island</option>
                    <option value="QC">Quebec</option>
                    <option value="SK">Saskatchewan</option>
                    <option value="YT">Yukon</option>F
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputPostalCode" class="form-label needs-validation">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" disabled required>
            </div>
        </form>

        </>

        <div class="container mt-3">
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
                data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
                <table class="table table-hover" id="records-table">
                    <thead>
                        <p class="text-center fs-2 text">Records</p>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Allergies</th>
                            <th scope="col">Records</th>
                            <th scope="col">Referrals</th>
                            <th scope="col" class="text-end"><button class="btn btn-primary btn-sm text-end"
                                    onclick="addRow()"id="addrec"><i class="fa-solid fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="dataGrid">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="validToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto text-danger">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-danger">
            </div>
        </div>
    </div>

    <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 11">
    <div id="deleteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
      <div class="toast-header">
        <strong class="me-auto">Confirmation Needed</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">        
      Do you want to proceed?
      <div class="mt-3">
          <button name="proceed" class="btn btn-primary btn-sm" id ="confirmButton">Yes, Proceed</button>
          <button name="proceed" class="btn btn-primary btn-sm" id="cancelButton">No</button>
       </div>   
      </div>
    </div>
</div>