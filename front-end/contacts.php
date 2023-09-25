<!DOCTYPE html>
<html>
  <html lang="en">
    <head>
      <!-- Meta tags -->
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <title>Contact Manager</title>

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
        <div></div>
        <div class="title">Contact Manager</div>
        <div class="logout-container">
          <div class="logout-button-container">
            <a class="link" href="index.html">
              <button class="logout-button">Log out</button>
            </a>
          </div>
        </div>
      </div>
      <div class="contact-body">
        <div class="contact-box-container">
          <div class="search-bar-container">
            <input class="search-bar" type="text" placeholder="Search" />
            <button class="search-button">
              <img
                class="search-button-icon"
                src="icons/search-icon.svg"
                alt="search button" />
            </button>
            <button class="new-contact-button">
              <img
                class="new-contact-icon"
                src="icons/plus-icon.svg"
                alt="add new contact button" />
            </button>
            <div class="contact-box">
              <div class="contact-list"></div>
              <div class="side-bar">
                <a class="nav-link" href="#A">A</a>
                <a class="nav-link" href="">B</a>
                <a class="nav-link" href="">C</a>
                <a class="nav-link" href="">D</a>
                <a class="nav-link" href="">E</a>
                <a class="nav-link" href="">F</a>
                <a class="nav-link" href="">G</a>
                <a class="nav-link" href="">H</a>
                <a class="nav-link" href="">I</a>
                <a class="nav-link" href="">J</a>
                <a class="nav-link" href="">K</a>
                <a class="nav-link" href="">L</a>
                <a class="nav-link" href="">M</a>
                <a class="nav-link" href="">N</a>
                <a class="nav-link" href="">O</a>
                <a class="nav-link" href="">P</a>
                <a class="nav-link" href="">Q</a>
                <a class="nav-link" href="">R</a>
                <a class="nav-link" href="">S</a>
                <a class="nav-link" href="">T</a>
                <a class="nav-link" href="">U</a>
                <a class="nav-link" href="">V</a>
                <a class="nav-link" href="">W</a>
                <a class="nav-link" href="">X</a>
                <a class="nav-link" href="">Y</a>
                <a class="nav-link" href="">Z</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="main.js"></script>
    </body>
  </html>
</html>
