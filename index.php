<?php
session_start();
include 'db.php';

// Check if the user is already logged in and prevent redirect loop
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header("Location: dashboard.php");
  exit();
}

//inlcude db.php

// Initialize error message
$error_message = "";

// Check if request method is POST to handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $admin_email = $_POST['useremail'];
  $admin_password = $_POST['userpassword'];

  // Use prepared statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT * FROM userdata WHERE email = ? AND password = ?");
  $stmt->bind_param("ss", $admin_email, $admin_password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Fetch the username and set session variables
    $row = $result->fetch_assoc();
    $username = $row['username'];

    // Set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    // Redirect to the dashboard
    header("Location: dashboard.php");
    exit();
  } else {
    // Set error message if login fails (no output before header)
    $error_message = "Invalid email or password.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Home Page</title>
</head>

<body>
  <section
    class="vh-100 d-flex justify-content-center align-items-center bg-light">
    <form
      class="container py-3 px-4 rounded-4 h-auto w-25 mx-auto"
      style="background-color: #eeeeee"
      action="index.php"
      method="post">
      <h2 class="text-center">Login</h2>
      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="useremail">Email address</label>
        <input
          type="email"
          id="useremail"
          name="useremail"
          class="form-control" />
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="userpassword">Password</label>
        <input
          type="password"
          id="userpassword"
          class="form-control"
          name="userpassword" />
      </div>
      <!-- Submit button -->
      <div class="d-flex justify-content-center align-items-center">
        <button
          type="submit"
          data-mdb-button-init
          data-mdb-ripple-init
          class="btn btn-dark btn-block mb-2 d-flex justify-content-center">
          Sign in
        </button>
      </div>
    </form>
  </section>
</body>

</html>