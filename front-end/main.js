// Test array
let contacts = [
  {
    firstName: "John",
    lastName: "Doe",
    email: "jdoe@gmail.com",
    phone: "3333333333",
    dateCreated: "09-5-23",
  },

  {
    firstName: "Johnadc",
    lastName: "Doewewew",
    email: "jdoewe@gmail.com",
    phone: "3333333333",
    dateCreated: "09-5-23",
  },

  {
    firstName: "Johnadc",
    lastName: "Doewe",
    email: "jdoewe@gmail.com",
    phone: "3333333333",
    dateCreated: "09-5-23",
  },

  {
    firstName: "Johnadc",
    lastName: "Doewe",
    email: "jdoewe@gmail.com",
    phone: "3333333333",
    dateCreated: "09-5-23",
  },

  {
    firstName: "Johnadc",
    lastName: "Doewe",
    email: "jdoewe@gmail.com",
    phone: "3333333333",
    dateCreated: "09-5-23",
  },
];

// Form validation
const form = document.querySelector("form");
form.addEventListener("submit", (e) => {
  // Stops form from submitting on incorrect input
  if (!form.checkValidity()) {
    e.preventDefault();
  }
  // Toggles form modal
  else {
    $("#modal").modal("toggle");
  }

  form.classList.add("was-validated");
});

// Displays a new contact list when a new character is entered
let searchBar = document.getElementById("search-bar");
searchBar.addEventListener("keyup", (e) => {
  displaySearchedContacts();
});
let numOfDisplayedContacts = 0;

// Displays searched contacts
function displaySearchedContacts() {
  // Get new contacts
  contacts = fetchContacts();

  // Reset number of displayed contacts
  numOfDisplayedContacts = 0;

  // Reset HTML content
  contactList.innerHTML = "";

  // No contacts from user, so display that there is no info
  if (contacts.length == numOfDisplayedContacts) {
    contactList.innerHTML =
      '<h2 style="display:flex; flex: 1; justify-content: center;">Contact does not exist.</h2>';
    return;
  }

  // Create HTML for contacts and append it to the contact list
  displayContactList(numOfDisplayedContacts);
}

// Appends new contacts when page is scrolled far enough
function lazyLoadContacts() {
  // Append new contacts
  contacts = contacts.concat(fetchContacts());

  // Display new contacts
  displayContactList(numOfDisplayedContacts);
}

// Returns a list of contacts that meet search criteria
function fetchContacts() {
  let searchName = document.getElementById("search-bar").value;

  // Send a request for all contacts when there is no input
  if (searchName == "") {
  }
  // Send a request for contacts that contain the searched name
  else {
  }

  return contacts;
}

// Load contacts on start
let contactList = document.getElementById("contact-list");
let contactId = null;
displayContactList(numOfDisplayedContacts);

// Displays a list of contacts
function displayContactList() {
  // No new contacts to display
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
        contacts[i].firstName +
        " " +
        contacts[i].lastName +
        "</span></div> <div><b>Email:</b> <span>" +
        contacts[i].email +
        "</span></div>" +
        "<div><b>Phone Number:</b> <span>" +
        contacts[i].phone +
        "</span></div>" +
        '</div><div class="dropdown"><button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Modify</button>' +
        '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"><li><button class="dropdown-item" type="button" id="update' +
        i +
        '" >Update</button></li>' +
        '<li><button class="dropdown-item" id="delete' +
        i +
        '">Delete</button></li></ul></div></div></div>'
    );

    // Sets the functionality of the update button on a contact item
    document.getElementById("update" + i).onclick = function () {
      // Display update modal

      // Update contact to update
      contactId = this.id;
    };

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

// Deletes contact on user confirmation
document.getElementById("confirmDelete").onclick = function () {
  // Close dialog
  $("#modalDelete").modal("toggle");

  deleteContact();
};

// Send a request to delete contact
function deleteContact() {
  // Get contact from last char of id and turn it into JSON
  let contactToDelete = JSON.stringify(contacts[contactId.slice(-1)]);

  // Send delete contact request

  // Reset contact to be deleted
  contactId = null;
}

// Send a request to update contact
function updateContact(contact) {}

// Displays a form where user can update contact info.
// Returns true when contact was changed successfully. Returns false when contact update was cancelled.
function updateContactForm(contact) {
  // Display form to update contacts

  // Update contact attributes

  return true;
}

async function handleSignUp() {
  let firstName = document.getElementById("firstName").value;
  let lastName = document.getElementById("lastName").value;

  // Send request to create new user
  let data = await fetch("http://localhost:8080/back-end/signup.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "POST",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    },
    body: JSON.stringify({
      firstName: firstName,
      lastName: lastName,
    }),
  });

  if (data.status == 200) {
    // Redirect to login page
    window.location.href = "http://localhost:8080/front-end/index.html";
  } else {
    // Display error message
    alert("Error signing up. Please try again.");
  }
}
