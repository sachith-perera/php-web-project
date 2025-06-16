async function deletePatient() {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get("id");

  const formData = {};

  formData["id"] = id;

 
    try {
      // Call the API to save data
      const response = await fetch(
        "http://localhost/Assignment3/api/delete_patient.php",
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        }
      );

      if (response.ok) {
        sessionStorage.setItem("patientID", id);
        sessionStorage.setItem(
          "successMessage",
          "Patient Successfully Deleted! "
        );
        window.location.href = "patient.php";
      }
    } catch (error) {
      console.error("Error:", error);
    }
  
}

