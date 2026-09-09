<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$pageTitle = "Portfolios";
include 'includes/header.php';
include 'includes/navbar.php';
?>

<main class="page-hero">
  <p class="landing-session-info">
    Logged in as <?= htmlspecialchars($_SESSION['student_first_name'] . ' ' . $_SESSION['student_last_name']) ?>
    (<?= htmlspecialchars($_SESSION['username']) ?>)
  </p>
  <h1>Choose a Portfolio to View</h1>
  <div class="hero-button-group">
    <a href="ralph-portfolio.html" class="btn-outline">Ralph's Portfolio</a>
    <a href="rae-portfolio.html" class="btn-outline">Rae's Portfolio</a>
  </div>
</main>

<?php include 'includes/footer.php'; ?>