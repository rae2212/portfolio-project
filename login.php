<?php
session_start();
require 'includes/conn.php';
require 'includes/functions.php';
require 'includes/User.php';

$loginError = "";
$justRegistered = isset($_GET['registered']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enteredUsername = cleanInputText($_POST['username'] ?? '');
    $enteredPassword = $_POST['password'] ?? '';

    if ($enteredUsername === "" || $enteredPassword === "") {
        $loginError = "Please enter your username and password.";
    } else {
        $currentUser = new User($conn, '', '', $enteredUsername);

        if ($currentUser->login($enteredPassword)) {
            $_SESSION['student_id']         = $currentUser->getStudentId();
            $_SESSION['student_first_name'] = $currentUser->getFirstName();
            $_SESSION['student_last_name']  = $currentUser->getLastName();
            $_SESSION['username']           = $currentUser->getUsername();

            header("Location: landing.php");
            exit;
        } else {
            $loginError = "Incorrect username or password.";
        }
    }
}

$pageTitle = "Login";
$extraCss = "css/auth.css";
include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="auth-page">
  <div class="auth-card">
    <h1>Welcome Back</h1>
    <p class="subtitle">Log in to continue.</p>

    <?php if ($justRegistered && !$loginError): ?>
      <div class="msg success">Account created. You can log in now.</div>
    <?php endif; ?>

    <?php if ($loginError): ?>
      <div class="msg error"><?= htmlspecialchars($loginError) ?></div>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <div class="field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit" class="btn-primary">Log In</button>
    </form>

    <p class="auth-switch">
      Don't have an account? <a href="register.php">Register</a>
    </p>
  </div>
</main>

<?php include 'includes/footer.php'; ?>