document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get("id");
  // Select all disabled input fields
  const disabledFields = document.querySelectorAll(
    "input:disabled, select:disabled, textarea:disabled"
  );

  // Enable each field

  if (id == null) {
    disabledFields.forEach((field) => {
      field.disabled = false;

      const saveButton = document.getElementById("save");
      const backLink = document.getElementById("back_link");
      saveButton.classList.remove("d-none");
      backLink.classList.remove("d-none");
    });
  } else {
    sessionStorage.setItem("patientID", id);
  }
});

async function saveData() {
  let patient_id = sessionStorage.getItem("patientID");
  sessionStorage.removeItem("patientID");

  //data validation

  if (inputValidation()) {
    //Update Data
    if (patient_id) {
      const inputMapping = {
        first_name: "firstName",
        last_name: "lastName",
        gender: "gender",
        dob: "dateOfBirth",
        email: "email",
        phone: "phone",
        address1: "address1",
        address2: "address2",
        city: "city",
        state: "state",
        postal_code: "postalCode",
      };

      // Function to fetch data from the form elements

      const formData = {};

      // Fetch data from elements based on inputMapping
      for (const [property, inputId] of Object.entries(inputMapping)) {
        const inputElement = document.getElementById(inputId);
        if (inputElement) {
          formData[property] = inputElement.value;
        }
      }

      formData["id"] = patient_id;

      const table = document.getElementById("records-table");
      const rows = Array.from(table.rows);
      data = [];

      //for new rows
      rows.forEach((row) => {
        const allergy = row.cells[1].querySelector("input,td")?.value.trim();
        const record = row.cells[2].querySelector("input,td")?.value.trim();
        const referral = row.cells[3].querySelector("input,td")?.value.trim();

        // Push each row's data as an object into the array
        if (allergy || record || referral)
          data.push({ Allergy: allergy, Record: record, Referral: referral });
      });

      data.forEach((record) => {
        record.patient_id = patient_id; // Add new field with a value
      });

      recordsData = JSON.stringify(data, null, 2);

      try {
        // Call the API to save data
        const response = await fetch(
          "http://localhost/Assignment3/api/update_patient.php",
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(formData),
          }
        );

        if (response.ok) {
          const response2 = await fetch(
            "http://localhost/Assignment3/api/create_record.php",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: recordsData,
            }
          );
          if (response2.ok) {
            sessionStorage.setItem(
              "successMessage",
              "Patient Successfully Updated! "
            );
            sessionStorage.setItem("patientID", patient_id);
            window.location.href = "patient.php";
          }
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }
    // Save Data
    else {
      const inputMapping = {
        first_name: "firstName",
        last_name: "lastName",
        gender: "gender",
        dob: "dateOfBirth",
        email: "email",
        phone: "phone",
      };

      const inputMappingAddress = {
        address1: "address1",
        address2: "address2",
        city: "city",
        state: "state",
        postal_code: "postalCode",
      };

      // Function to fetch data from the form elements

      const formData = {};
      const addressData = {};

      // Fetch data from elements based on inputMapping
      for (const [property, inputId] of Object.entries(inputMapping)) {
        const inputElement = document.getElementById(inputId);
        if (inputElement) {
          formData[property] = inputElement.value;
        }
      }

      // Fetch data from address elements based on inputMappingAddress
      for (const [property, inputId] of Object.entries(inputMappingAddress)) {
        const inputElement = document.getElementById(inputId);
        if (inputElement) {
          addressData[property] = inputElement.value;
        }
      }

      const table = document.getElementById("records-table");
      const rows = Array.from(table.rows);
      data = [];

      rows.forEach((row) => {
        // const id = row.cells[0].textContent.trim();
        const allergy = row.cells[1].querySelector("input")?.value.trim();
        const record = row.cells[2].querySelector("input")?.value.trim();
        const referral = row.cells[3].querySelector("input")?.value.trim();

        // Push each row's data as an object into the array
        if (allergy || record || referral)
          data.push({ Allergy: allergy, Record: record, Referral: referral });
      });

      // Function to create and download JSON file

      try {
        // Call the API to save data
        const response = await fetch(
          "http://localhost/Assignment3/api/create_patient.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(formData),
          }
        );

        // Check for successful response
        if (response.ok) {
          const result = await response.json();
          patient_id = result["patient_id"];
          addressData["patient_id"] = patient_id;

          data.forEach((record) => {
            record.patient_id = patient_id; // Add new field with a value
          });

          recordsData = JSON.stringify(data, null, 2);

          const response2 = await fetch(
            "http://localhost/Assignment3/api/create_address.php",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(addressData),
            }
          );

          const response3 = await fetch(
            "http://localhost/Assignment3/api/create_record.php",
            {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: recordsData,
            }
          );

          if (response2.ok && response3.ok) {
            sessionStorage.setItem(
              "successMessage",
              "Patient Successfully Saved! "
            );
            sessionStorage.setItem("patientID", patient_id);
            window.location.href = "patient.php";
          } else {
            console.error("Failed to save data:", response2);
          }
        } else {
          console.error("Failed to save data:", response.statusText);
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }
  }
}

function inputValidation() {
  elements = document.querySelectorAll(".needs-validation");
  let isValid = true;
  var BreakException = {};

  try{

  elements.forEach((element) => {

    switch (element.type) {
      case "date":
      case "text":
        if (element.value == null || element.value == "") {
          showToast(element.id + " cannot be empty");
          isValid = false;
          throw BreakException;
          break;
        }
      case "select-one":
        if (
          element.value == "Select Gender" ||
          element.value == "Select State"
        ) {
          showToast(element.value);
          isValid = false;
          throw BreakException;          
          break;
        }
      // case "email":
      //   if (element.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
      //     showToast("Invalid Email Address");
      //     isValid = false;
      //     throw BreakException;
      //     break;
      //   }
      
    }
    
  });
  return isValid;
}catch{

  return isValid;
}

 

}

function showToast(message) {
  // Select the toast element
  const toastElement = document.getElementById("validToast");
  const toastBody = toastElement.querySelector(".toast-body");

  // Set the new message
  toastBody.textContent = message;

  // Initialize the toast
  const toast = new bootstrap.Toast(toastElement);

  // Show the toast
  toast.show();
}
