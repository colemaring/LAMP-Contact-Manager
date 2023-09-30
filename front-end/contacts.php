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
        <!-- div needed for layout spacing -->
        <div class="d-flex align-items-center px-5">
          Welcome
          <?php echo $username; ?>
        </div>
        <div class="title">Contact Manager</div>
        <div class="logout-container">
          <div class="logout-button-container">
            <button class="logout-button" onclick="handleLogOut();">
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
              <!-- create contact form-->
              <form id="new-contact-form" class="form" method="POST" novalidate>
                <div class="mb-2">
                  <div class="input-group">
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="firstName"
                        placeholder="First Name"
                        name="firstName"
                        required />
                      <label for="firstName">First Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="lastName"
                        placeholder="Last Name"
                        name="lastName"
                        required />
                      <label for="lastName">Last Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-floating p-1">
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      placeholder="Email"
                      name="email"
                      required />
                    <label for="email">Email</label>
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
                      id="phoneNumber"
                      placeholder="Phone Number"
                      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                      name="phone"
                      required />
                    <label for="phoneNumber">Phone Number (123-456-7890)</label>
                    <div class="invalid-feedback">Format: (123-456-7890)</div>
                  </div>
                </div>
                <!--<input type="date" id="date" name="dateCreated" hidden>-->
                <button
                  type="submit"
                  class="btn btn-primary mt-2 d-inline-flex w-100 justify-content-center">
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
              <form id="new-contact-form" class="form" method="POST" novalidate>
                <div class="mb-2">
                  <div class="input-group">
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="firstname"
                        placeholder="First Name"
                        name="firstName"
                        required />
                      <label for="firstName">First Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                    <div class="form-floating p-1">
                      <input
                        type="text"
                        class="form-control"
                        id="lastname"
                        placeholder="Last Name"
                        name="lastName"
                        required />
                      <label for="lastName">Last Name</label>
                      <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                  </div>
                </div>
                <div class="mb-2">
                  <div class="form-floating p-1">
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      placeholder="Email"
                      name="email"
                      required />
                    <label for="email">Email</label>
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
                      id="phone"
                      placeholder="Phone Number"
                      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                      name="phone"
                      required />
                    <label for="phoneNumber">Phone Number (123-456-7890)</label>
                    <div class="invalid-feedback">Format: (123-456-7890)</div>
                  </div>
                </div>
                <!--<input type="date" id="date" name="dateCreated" hidden>-->
                <button
                  onclick="handleCreateContact();"
                  type="submit"
                  class="btn btn-primary mt-2 d-inline-flex w-100 justify-content-center">
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
                  id="confirmDelete"
                  aria-label="Yes button">
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
      <script src="main.js"></script>
      <script src="handlers.js" defer></script>
    </body>
  </html>
</html>
