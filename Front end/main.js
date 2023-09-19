// Test array
let contacts = [
        {
           "firstName": "John",
           "lastName": "Doe",
           "email": "jdoe@gmail.com",
           "phone": "3333333333",
           "dateCreated": "09-5-23"
        },
    
        {
        "firstName": "Johnadc",
        "lastName": "Doewe",
        "email": "jdoewe@gmail.com",
        "phone": "3333333333",
        "dateCreated": "09-5-23"
        },
    
        {
        "firstName": "Johnadc",
        "lastName": "Doewe",
        "email": "jdoewe@gmail.com",
        "phone": "3333333333",
        "dateCreated": "09-5-23"
        },
    
        {
        "firstName": "Johnadc",
        "lastName": "Doewe",
        "email": "jdoewe@gmail.com",
        "phone": "3333333333",
        "dateCreated": "09-5-23"
        },
    
        {
        "firstName": "Johnadc",
        "lastName": "Doewe",
        "email": "jdoewe@gmail.com",
        "phone": "3333333333",
        "dateCreated": "09-5-23"
        }
    ];

let contactList = document.getElementsByClassName("contact-list");
createContactList(contacts);

// Creates a list of contacts from an array of contacts in JSON format
function createContactList(contacts)
{
    // No contacts from user, so display that there is no info
    if (contacts.length == 0)
    {
        contactList[0].innerHTML = "<h2 style=\"display:flex; flex: 1; justify-content: center;\">Contact does not exist.</h2>";
        return;
    }
    
    // Create html components for contacts and set with corrensponding data
    for (let i = 0; i < contacts.length; i++)
    {
        // Create contact structure
        let contactItem = document.createElement("div");
        contactItem.classList.add("contact-item")

        let contactName = document.createElement("p");
        let contactEmail = document.createElement("p");
        let contactPhone = document.createElement("p");
        let contactDate = document.createElement("p");

        let contactButton = document.createElement("button");
        contactButton.classList.add("contact-button");
        
        // Add contact data
        contactName.innerText = "Name: " + contacts[i].firstName + " " + contacts[i].lastName;
        contactEmail.innerText = "Email: " + contacts[i].email;
        contactPhone.innerText = "Phone Number: " + contacts[i].phone;
        contactDate.innerText = "Date created: " + contacts[i].dateCreated;
        contactButton.innerHTML = "&#183;&#183;&#183;"; // Text is HTML symbol for 3 dots
        
        // Append contact-item children elements
        contactItem.append(contactName, contactEmail, contactPhone, contactDate, contactButton);
        
        // Append contact-item to the contact list element
        contactList[0].append(contactItem);
    }
}
