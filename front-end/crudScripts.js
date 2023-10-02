let contactId = 0;
let numOfDisplayedContacts = 0;
displayContactList();

// Update form validation
const updateForm = document.querySelector(".updateForm");
updateForm.addEventListener("submit", (e) => {
  // Stops form from submitting on incorrect input
  if (!updateForm.checkValidity()) {
    e.preventDefault();
  }
  // Toggles form modal
  else {
    $("#modalUpdate").modal("toggle");
  }

  updateForm.classList.add("was-validated");
});

// Create form validation
const createForm = document.querySelector(".createForm");
createForm.addEventListener("submit", (e) => {
  // Stops form from submitting on incorrect input
  if (!createForm.checkValidity()) {
    e.preventDefault();
  }
  // Toggles form modal
  else {
    $("#modalCreate").modal("toggle");
  }

  createForm.classList.add("was-validated");
});

async function displayContactList() {
  // Get contacts
  let contacts = await handleGetContact();

  // No new contacts to display
  if (contacts == null) return;

  if (contacts.length == numOfDisplayedContacts) return;

  // Create html components for contacts and set with corrensponding data
  for (let i = numOfDisplayedContacts; i < contacts.length; i++) {
    // Appends a new contact with a bootstrap dropdown menu to the contact list.
    // Each update and delete button is given an id that that corresponds to its
    // function and its associated contacts array index. Ex. "update0" or
    // "delete0" and contact data is found at contacts[0]
    $("#contact-list").append(
      '<div class="contact-item"> <div class="contact-info"> <div style="word-wrap: break-word;">' +
        "<div><b>Name:</b><span> " +
        contacts[i]["firstname"] +
        " " +
        contacts[i]["lastname"] +
        "</span></div> <div><b>Email:</b> <span>" +
        contacts[i]["email"] +
        "</span></div>" +
        "<div><b>Phone Number:</b> <span>" +
        contacts[i]["phone"] +
        "</span></div>" +
        '</div><div class="dropdown"><button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Modify</button>' +
        '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"><li><button class="dropdown-item" type="button" id="update' +
        i +
        '" >Update</button></li>' +
        '<li><button class="dropdown-item" id="delete' +
        i +
        '">Delete</button></li></ul></div></div></div>'
    );

    // Sets the functionality of the delete button on a contact item
    let deleteButton = document.getElementById("delete" + i);

    deleteButton.onclick = function () {
      // Display confirmation dialog
      $("#modalDelete").modal("toggle");

      // Update contact to delete
      contactId = this.id;
    };

    let updateButton = document.getElementById("update" + i);

    updateButton.onclick = function () {
      // Display update dialog
      $("#modalUpdate").modal("toggle");

      // Update contact to update
      contactId = this.id;
    };
  }

  // Update number of contacts displayed
  numOfDisplayedContacts = contacts.length;
}

async function handleCreateContact() {
  let firstname = document.getElementById("createFirstName").value;
  let lastname = document.getElementById("createLastName").value;
  let email = document.getElementById("createEmail").value;
  let phone = document.getElementById("createPhone").value;

  // Send request to add contact
  let response = await fetch("http://localhost:8080/back-end/contacts.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "POST",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    },
    body: JSON.stringify({
      firstname: firstname,
      lastname: lastname,
      email: email,
      phone: phone,
      datecreated: new Date().toISOString().slice(0, 10),
    }),
  });

  let data = await response.json();

  if (data.status == 201) {
    // Redirect to contacts page
    window.location.href = "http://localhost:8080/front-end/contacts.php";
    alert(data["message"]);
  } else {
    // Display error message
    alert(data["message"]);
  }
}

async function handleGetContact() {
  let response = await fetch("http://localhost:8080/back-end/contacts.php");

  let data = await response.json();

  if (response.status == 200) {
    // Returns as [{id: ""}, {id: ""}, {id: ""}]
    return data;
  } else {
    return null;
  }
}

async function handleDeleteContact() {
  // Get contacts
  let contacts = await handleGetContact();

  // Get contact from last char of id
  let contact_id = contacts[contactId.slice(-1)]["contact_id"];

  // Send delete contact request
  let response = await fetch(
    "http://localhost:8080/back-end/contacts.php?contact_id=" + contact_id,
    {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "DELETE",
        "Access-Control-Allow-Headers": "Content-Type, Authorization",
      },
    }
  );

  if (response.status == 200) {
    // Redirect to contacts page
    window.location.href = "http://localhost:8080/front-end/contacts.php";
    console.log("Contact deleted successfully");
  } else {
    // Display error message
    alert("Error deleting contact.");
  }
}

async function handleUpdateContact() {
  // Get contacts
  let contacts = await handleGetContact();

  // Get contact from last char of id
  let contact_id = contacts[contactId.slice(-1)]["contact_id"];

  let firstname = document.getElementById("updateFirstName").value;
  let lastname = document.getElementById("updateLastName").value;
  let email = document.getElementById("updateEmail").value;
  let phone = document.getElementById("updatePhone").value;

  // Send update contact request
  let response = await fetch(
    "http://localhost:8080/back-end/contacts.php?contact_id=" + contact_id,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "PUT",
        "Access-Control-Allow-Headers": "Content-Type, Authorization",
      },
      body: JSON.stringify({
        firstname: firstname,
        lastname: lastname,
        email: email,
        phone: phone,
      }),
    }
  );

  if (response.status == 200) {
    // Redirect to contacts page
    window.location.href = "http://localhost:8080/front-end/contacts.php";
    console.log("Contact updated successfully");
  } else {
    // Display error message
    alert("Error updating contact.");
  }
}