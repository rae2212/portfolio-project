<?php
session_start();
require 'includes/conn.php';
require 'includes/functions.php';
require 'includes/User.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $enteredFirstName = cleanInputText($_POST['fname'] ?? '');
  $enteredLastName  = cleanInputText($_POST['lname'] ?? '');
  $enteredUsername  = cleanInputText($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm  = $_POST['confirm_password'] ?? '';

  if ($enteredFirstName === "" || $enteredLastName === "" || $enteredUsername === "" || $password === "") {
    $error = "Please fill in all fields.";
  } elseif ($password !== $confirm) {
    $error = "Passwords do not match.";
  } elseif (strlen($password) < 6) {
    $error = "Password must be at least 6 characters.";
  } else {
    $user = new User($conn, $enteredFirstName, $enteredLastName, $enteredUsername, $password);

    if ($user->usernameExists()) {
      $error = "That username is already taken.";
    } elseif ($user->register()) {
      header("Location: login.php?registered=1");
      exit;
    } else {
      $error = "Something went wrong. Please try again.";
    }
  }
}

$pageTitle = "Register";
$extraCss = "css/auth.css";
include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="auth-page">
  <div class="auth-card">
    <h1>Create an Account</h1>
    <p class="subtitle">Register to access the portfolio system.</p>

    <?php if ($error): ?>
      <div class="msg error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <div class="field">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($_POST['fname'] ?? '') ?>" required>
      </div>

      <div class="field">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($_POST['lname'] ?? '') ?>" required>
      </div>

      <div class="field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="field">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
      </div>

      <button type="submit" class="btn-primary">Register</button>
    </form>

    <p class="auth-switch">
      Already have an account? <a href="login.php">Log in</a>
    </p>
  </div>
</main>

<?php include 'includes/footer.php'; ?>