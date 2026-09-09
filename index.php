<?php
session_start();

include 'includes/header.php';
include 'includes/navbar.php';

?>

<main class="page-hero">
  <h1>Welcome to MDP</h1>
  <p>You can log-in or register a new account to view the student portfolios.</p>
  <div class="hero-button-group">
    <a href="login.php" class="btn-primary">Login</a>
    <a href="register.php" class="btn-outline">Register</a>
  </div>
</main>

<?php include 'includes/footer.php'; ?>