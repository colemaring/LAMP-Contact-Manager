// Global variables
let contactId = 0;
let urlParams = new URLSearchParams(window.location.search);
let page = urlParams.get("page");
let search = urlParams.get("name");

displayContactList();

// Ensures you will always see a list of contacts
if (!urlParams.has("page") || !urlParams.has("name")) {
  window.location.href =
    "http://localhost:8080/front-end/contacts.php?page=1&name=";
}

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
  // Get contacts from search
  let contacts = await handleGetContact();

  // No new contacts to display
  if (contacts == null) return;

  // Create html components for contacts and set with corrensponding data
  for (let i = 0; i < contacts.length; i++) {
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

    // Sets the functionality of the update button on a contact item
    let updateButton = document.getElementById("update" + i);
    updateButton.onclick = function () {
      // Display update dialog
      $("#modalUpdate").modal("toggle");
      $("#modalUpdate").on("shown.bs.modal", function () {
        $("#updateFirstName").val(contacts[i]["firstname"]);
        $("#updateLastName").val(contacts[i]["lastname"]);
        $("#updateEmail").val(contacts[i]["email"]);
        $("#updatePhone").val(contacts[i]["phone"]);
      });

      // Update contact to update
      contactId = this.id;
    };
  }
}

let updateCloseButton = document.getElementById("updateCloseButton");
updateCloseButton.onclick = function () {
  $("#updateFirstName").val("");
  $("#updateLastName").val("");
  $("#updateEmail").val("");
  $("#updatePhone").val("");
};

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

  // Get number of contacts
  let countResponse = await fetch("http://localhost:8080/back-end/count.php");
  let count = await countResponse.json();

  let lastPage = Math.ceil(parseInt(count["count"]) / 5);

  if (response.status == 201) {
    // Redirect to page with new contact
    window.location.href =
      "http://localhost:8080/front-end/contacts.php?page=" +
      lastPage +
      "&name=" +
      search;
    console.log("Contact created successfully");
  } else {
    // Display error message
    alert(data["message"]);
  }
}

async function handleGetContact() {
  let response = await fetch(
    "http://localhost:8080/back-end/contacts.php?page=" +
      page +
      "&name=" +
      search
  );

  let data = await response.json();

  if (response.status == 200) {
    // Returns as [{id: ""}, {id: ""}, {id: ""}]
    return data;
  } else {
    return null;
  }
}

async function handleDeleteContact() {
  // Get contacts from search
  let contacts = await handleGetContact();

  if (contacts == null) return;

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

    if (contacts.length == 1 && page > 1) {
      window.location.href =
        "http://localhost:8080/front-end/contacts.php?page=" +
        (parseInt(page) - 1) +
        "&name=" +
        search;
    } else {
      window.location.href =
        "http://localhost:8080/front-end/contacts.php?page=" +
        page +
        "&name=" +
        search;
    }
    console.log("Contact deleted successfully");
  } else {
    // Display error message
    alert("Error deleting contact.");
  }
}

async function handleUpdateContact() {
  // Get contacts from search
  let contacts = await handleGetContact();

  if (contacts == null) return;

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
    window.location.href =
      "http://localhost:8080/front-end/contacts.php?page=" + page;
    console.log("Contact updated successfully");
  } else {
    // Display error message
    alert("Error updating contact.");
  }
}

document.getElementById("search-form").onsubmit = async function (e) {
  e.preventDefault();

  // Get search bar value
  let name = document.getElementById("search-bar").value;

  // Redirect to page with search results
  window.location.href =
    "http://localhost:8080/front-end/contacts.php?page=1&name=" + name;

  // Display search results
  displayContactList();
};
