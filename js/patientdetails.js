document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get("id");

  if (id != null) {
    fetchAndDisplayData(id);
  }
});

async function fetchAndDisplayData(id) {
  const tableBody = document
    .getElementById("records-table")
    .getElementsByTagName("tbody")[0];

  try {
    // const urlParams = new URLSearchParams(window.location.search);
    // const id = urlParams.get("id");

    const saveButton = document.getElementById("save");
    const editButton = document.getElementById("edit");
    const delButton = document.getElementById("delete");
    const backLink = document.getElementById("back_link");
    const addrecs = document.getElementById("addrec");

    saveButton.classList.add("d-none");
    editButton.classList.remove("d-none");
    delButton.classList.remove("d-none");
    backLink.classList.remove("d-none");
    addrecs.classList.add("d-none");

    var number = 0;
    // Fetch data from the API
    const response = await fetch(
      `http://localhost/Assignment3/api//get_patient_by_id.php?id=${id}`
    );
    const response_address = await fetch(
      `http://localhost/Assignment3/api//get_address.php?id=${id}`
    );
    const response_record = await fetch(
      `http://localhost/Assignment3/api//get_records.php?id=${id}`
    );

    const jsonData = await response.json();
    const jsonAddress = await response_address.json();
    const jsonRecords = await response_record.json();

    const data = jsonRecords.data;

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

    for (const [property, inputId] of Object.entries(inputMapping)) {
      const inputElement = document.getElementById(inputId);
      if (inputElement && jsonData[property] !== undefined) {
        inputElement.value = jsonData[property];
      }
    }

    for (const [property, inputId] of Object.entries(inputMappingAddress)) {
      const inputElement = document.getElementById(inputId);
      if (inputElement && jsonAddress[property] !== undefined) {
        inputElement.value = jsonAddress[property];
      }
    }

    data.forEach((item) => {
      number += 1;
      // Create a new row
      const row = tableBody.insertRow();

      // Insert cells in the row for each data field
      const idCell = row.insertCell(0);
      const allergyCell = row.insertCell(1);
      const recordCell = row.insertCell(2);
      const referralCell = row.insertCell(3);
      const buttonCell = row.insertCell(4);

      // Set cell text content
      idCell.textContent = number;
      allergyCell.textContent = item.allergies;
      recordCell.textContent = item.records;
      referralCell.textContent = item.refererrals;
      buttonCell.innerHTML = `<button class="btn btn-primary btn-sm text-end d-none" onclick="editRow(this)"id =edit${number}><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger btn-sm text-end d-none" onclick="deleteRow(this)"id =delete${number}><i class="fa-solid fa-trash"></i></button>`;
      buttonCell.classList.add("text-end");
    });
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

function enableFormFields() {
  const form = document.getElementById("patient_data");
  const elements = form.querySelectorAll("[Disabled]");

  const saveButton = document.getElementById("save");
  const editButton = document.getElementById("edit");
  const delButton = document.getElementById("delete");
  const backButton = document.getElementById("back_btn");
  const backLink = document.getElementById("back_link");
  const addrecs = document.getElementById("addrec");

  saveButton.classList.remove("d-none");
  editButton.classList.add("d-none");
  delButton.classList.add("d-none");
  backButton.classList.remove("d-none");
  backLink.classList.add("d-none");
  addrecs.classList.remove("d-none");

  const table = document.getElementById("records-table");
  const rows = Array.from(table.rows);

  number = 0;
  elements.forEach((element) => {
    element.disabled = false;
  });
  rows.forEach((row) => {
    if (row.getElementsByTagName("td").length!==0) {
      number += 1;
      const btn1 = document.getElementById("edit" + number);
      const btn2 = document.getElementById("delete" + number);
      btn1.classList.remove("d-none");
      btn2.classList.remove("d-none");
    }
  });
}

function addRow() {
  const table = document
    .getElementById("records-table")
    .getElementsByTagName("tbody")[0];
  const row = table.insertRow();
  const idCell = row.insertCell(0);
  const allergyCell = row.insertCell(1);
  const recordCell = row.insertCell(2);
  const referralCell = row.insertCell(3);
  const buttonCell = row.insertCell(4);

  allergyCell.innerHTML = `<input type="text" placeholder="Allergies">`;
  recordCell.innerHTML = `<input type="text" placeholder="Records">`;
  referralCell.innerHTML = `<input type="text" placeholder="Referral">`;
  buttonCell.innerHTML = `<button class="btn btn-danger btn-sm text-end" onclick="deleteRow(this)"><i class="fa-solid fa-trash"></i></button>`;
  buttonCell.classList.add("text-end");
}

function deleteRow(button) {
  const row = button.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

function editRow(button) {
  const row = button.parentNode.parentNode;
  const cells = row.getElementsByTagName("td");

  // Switch to input fields for editing
  for (let i = 1; i < cells.length - 1; i++) {
    // Exclude last two cells with buttons
    const cell = cells[i];
    const text = cell.innerText;
    cell.innerHTML = `<input type="text" value="${text}">`;
  }
}

function desableFormFields() {
  const form = document.getElementById("patient_data");
  const elements = form.querySelectorAll("*");

  const saveButton = document.getElementById("save");
  const editButton = document.getElementById("edit");
  const delButton = document.getElementById("delete");
  const backButton = document.getElementById("back_btn");
  const backLink = document.getElementById("back_link");
  const addrecs = document.getElementById("addrec");
  saveButton.classList.add("d-none");
  editButton.classList.remove("d-none");
  delButton.classList.remove("d-none");
  backButton.classList.add("d-none");
  backLink.classList.remove("d-none");
  addrecs.classList.add("d-none");

  const table = document.getElementById("records-table");
  const rows = Array.from(table.rows);

  number = 0;
  elements.forEach((element) => {
    element.disabled = false;
  });
  rows.forEach((row) => {
    if (row.getElementsByTagName("td").length!==0) {
      number += 1;
      const btn1 = document.getElementById("edit" + number);
      const btn2 = document.getElementById("delete" + number);
      btn1.classList.add("d-none");
      btn2.classList.add("d-none");
    }
  });

  elements.forEach((element) => {
    element.disabled = true;
  });
}
