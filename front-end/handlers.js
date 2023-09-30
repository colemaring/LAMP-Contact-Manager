async function handleSignUp() {
  let username = document.getElementById("floatingUsername").value;
  let password = document.getElementById("floatingPassword").value;

  if (username == "" || password == "") {
    alert("Please fill in all fields.");
    return;
  }

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
      username: username,
      password: password,
    }),
  });

  if (data.status == 200) {
    // Redirect to login page
    window.location.href = "http://localhost:8080/front-end/index.php";
    console.log("Signed up successfully");
  } else {
    // Display error message
    alert("Username already exists.");
  }
}

async function handleLogin() {
  let username = document.getElementById("floatingUsername").value;
  let password = document.getElementById("floatingPassword").value;

  if (username == "" || password == "") {
    alert("Please fill in all fields.");
    return;
  }

  // Send request to login
  let data = await fetch("http://localhost:8080/back-end/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "POST",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    },
    body: JSON.stringify({
      username: username,
      password: password,
    }),
  });

  if (data.status == 200) {
    // Redirect to contacts page
    window.location.href = "http://localhost:8080/front-end/contacts.php";
    console.log("Logged in successfully");
  } else {
    // Display error message
    alert("Incorrect username or password.");
  }
}

async function handleLogOut() {
  // Send request to logout
  let data = await fetch(
    "http://localhost:8080/back-end/logout.php?logout=true"
  );

  if (data.status == 200) {
    // Redirect to login page
    window.location.href = "http://localhost:8080/front-end/index.php";
    console.log("Logged out successfully");
  } else {
    // Display error message
    alert("Error logging out.");
  }
}

async function handleCreateContact() {
  let firstname = document.getElementById("firstname").value;
  let lastname = document.getElementById("lastname").value;
  let email = document.getElementById("email").value;
  let phone = document.getElementById("phone").value;

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
    alert("Added contact successfully");
  } else {
    // Display error message
    alert(data["message"]);
  }
}
