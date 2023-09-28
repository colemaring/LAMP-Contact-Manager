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
    window.location.href = "http://localhost:8080/front-end/index.html";
    console.log("Signed up successfully");
  } else {
    // Display error message
    alert("Username already exists.");
  }
}
