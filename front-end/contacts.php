<?php

// If the user is not logged in, redirect to login page
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
} else {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
  <html lang="en">
    <head>
      <!-- Meta tags -->
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <title>Contact Manager</title>

      <!-- Frameworks -->
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

      <!-- Google fonts-->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet" />

      <!-- CSS stylesheets-->
      <link rel="stylesheet" href="Styles/general.css" />
      <link rel="stylesheet" href="Styles/header.css" />
      <link rel="stylesheet" href="Styles/body.css" />
    </head>
    <body>
      <div class="header">
        <div class="d-flex align-items-center px-2 px-sm-4 px-md-5">
          Welcome
          <?php echo $username; ?>
        </div>
        <div class="title">Contact Manager</div>
        <div class="logout-container">
          <div class="logout-button-container">
            <button
              id="logoutButton"
              class="logout-button"
              onclick="handleLogOut()">
              Log out
            </button>
          </div>
        </div>
      </div>
      <div class="contact-body">
        <div class="contact-box-container">
          <div class="search-bar-container">
            <input
              class="search-bar"
              type="text"
              placeholder="Search"
              id="search-bar" />
            <button class="search-button">
              <img
                class="search-button-icon"
                src="icons/search-icon.svg"
                alt="search button" />
            </button>
            <button
              class="new-contact-button"
              data-bs-toggle="modal"
              data-bs-target="#modal">
              <img
                class="new-contact-icon"
                src="icons/plus-icon.svg"
                alt="add new contact button" />
            </button>
          </div>
          <div class="contact-box">
            <div class="contact-list" id="contact-list"></div>
          </div>
        </div>
      </div>
      <!-- update contact modal -->
      <div
        class="modal fade"
        id="modalUpdate"
        tabindex="-1"
        aria-labelledby="modalLabel"
        aria-hidden="true"
        style="color: black">
        <div class="modal-dialog">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <div
                class="modal-title fw-bold ps-1"
                id="modalLabel"
                style="color: white; font-size: 2rem">
                Update this contact
              </div>
              <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- update contact form-->
              <form
                id="new-contact-form"
                class="updateForm"
                method="POST"
                novalidate>
                <div class="mb-2">
                  <div class="input-group">
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="updateFirstName"
                        placeholder="First Name"
                        name="firstName"
                        required />
                      <label for="updateFirstName">First Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="updateLastName"
                        placeholder="Last Name"
                        name="lastName"
                        required />
                      <label for="updateLastName">Last Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-floating p-1">
                    <input
                      type="email"
                      class="form-control"
                      id="updateEmail"
                      placeholder="Email"
                      name="email"
                      required />
                    <label for="updateEmail">Email</label>
                    <div class="invalid-feedback">
                      Please enter a valid email.
                    </div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-floating p-1">
                    <input
                      type="tel"
                      class="form-control"
                      id="updatePhone"
                      placeholder="Phone Number"
                      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                      name="phone"
                      required />
                    <label for="updatePhone">Phone Number (123-456-7890)</label>
                    <div class="invalid-feedback">Format: (123-456-7890)</div>
                  </div>
                </div>
                <button
                  id="updateContactButton"
                  type="submit"
                  class="btn btn-primary mt-2 d-inline-flex w-100 justify-content-center"
                  onclick="handleUpdateContact()">
                  Save
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- create contact modal -->
      <div
        class="modal fade"
        id="modal"
        tabindex="-1"
        aria-labelledby="modalLabel"
        aria-hidden="true"
        style="color: black">
        <div class="modal-dialog">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <div
                class="modal-title fw-bold ps-1"
                id="modalLabel"
                style="color: white; font-size: 2rem">
                Create a New Contact
              </div>
              <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- create contact form-->
              <form
                id="new-contact-form"
                class="createForm"
                method="POST"
                novalidate>
                <div class="mb-2">
                  <div class="input-group">
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="createFirstName"
                        placeholder="First Name"
                        name="firstName"
                        required />
                      <label for="createFirstName">First Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="createLastName"
                        placeholder="Last Name"
                        name="lastName"
                        required />
                      <label for="createLastName">Last Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-floating p-1">
                    <input
                      type="email"
                      class="form-control"
                      id="createEmail"
                      placeholder="Email"
                      name="email"
                      required />
                    <label for="createEmail">Email</label>
                    <div class="invalid-feedback">
                      Please enter a valid email.
                    </div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-floating p-1">
                    <input
                      type="tel"
                      class="form-control"
                      id="createPhone"
                      placeholder="Phone Number"
                      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                      name="phone"
                      required />
                    <label for="createPhone">Phone Number (123-456-7890)</label>
                    <div class="invalid-feedback">Format: (123-456-7890)</div>
                  </div>
                </div>
                <!--<input type="date" id="date" name="dateCreated" hidden>-->
                <button
                  id="createContactButton"
                  type="submit"
                  class="btn btn-primary mt-2 d-inline-flex w-100 justify-content-center"
                  onclick="handleCreateContact()">
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- delete contact modal-->
      <div
        class="modal fade"
        id="modalDelete"
        tabindex="-1"
        aria-labelledby="modalLabel"
        aria-hidden="true"
        style="top: 30%; right: 50%">
        <div class="modal-dialog">
          <div class="modal-content text-bg-dark">
            <div class="modal-header d-flex align-items-start">
              <div
                class="modal-title fw-bold ps-1"
                id="modalLabel"
                style="font-size: 2rem">
                Are you sure you want to <u>DELETE</u>?
              </div>
              <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group">
                <button
                  class="btn btn-danger form-control"
                  data-bs-dismiss="modal"
                  aria-label="No button">
                  No
                </button>
                <button
                  class="btn btn-success form-control"
                  id="deleteContactButton"
                  aria-label="Yes button"
                  onclick="handleDeleteContact();">
                  Yes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="crudScripts.js" defer></script>
      <script src="userScripts.js" defer></script>
    </body>
  </html>
</html>
