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
