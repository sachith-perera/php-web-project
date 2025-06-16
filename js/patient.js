
document.addEventListener("DOMContentLoaded", () => {
  fetchAndDisplayData();
  const message = sessionStorage.getItem('successMessage');
  const patient_id = sessionStorage.getItem('patientID');
  const userName = sessionStorage.getItem("username");

  
  if(message){
  const tostMessage = message.concat("Patient ID:",patient_id);
  showToast(tostMessage);
  sessionStorage.removeItem('successMessage');
  sessionStorage.removeItem('patientID');
  }
  
  if(userName){
    const loginMessage = 'Welcome to MH Care '+userName;
    showLoginToast(loginMessage);
    sessionStorage.removeItem('username');
  }
  
  

});



async function fetchAndDisplayData() {
  const tableBody = document.getElementById("data-table").getElementsByTagName("tbody")[0];

  try {
    // Fetch data from the API
    const response = await fetch("http://localhost/Assignment3/api/get_patients.php");
    const jsonData = await response.json();

    const data = jsonData.data;

    // Loop through each item in the data array and create table rows
    data.forEach(item => {
      // Create a new row
      const row = tableBody.insertRow();
      row.onclick = () => {
        window.location.href = `patient_details.php?id=${item.id}`;
      };

      // Insert cells in the row for each data field
      const idCell = row.insertCell(0);
      const nameCell = row.insertCell(1);
      const phoneCell = row.insertCell(2);
      const emailCell = row.insertCell(3);

      // Set cell text content
      idCell.textContent = item.id;
      nameCell.textContent = item.first_name+' '+item.last_name;
      phoneCell.textContent = item.phone;
      emailCell.textContent = item.email;

      row.style.cursor = 'pointer';
    });
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}


function showToast(message) {
  // Select the toast element
  const toastElement = document.getElementById('liveToast');
  const toastBody = toastElement.querySelector('.toast-body');

  // Set the new message
  toastBody.textContent = message;

  // Initialize the toast
  const toast = new bootstrap.Toast(toastElement);

  // Show the toast
  toast.show();
}

function showLoginToast(message) {
  // Select the toast element
  const toastElement = document.getElementById('loginToast');
  const toastBody = toastElement.querySelector('.toast-body');

  // Set the new message
  toastBody.textContent = message;

  // Initialize the toast
  const toast = new bootstrap.Toast(toastElement);

  // Show the toast
  toast.show();
}