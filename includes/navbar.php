<nav class="site-nav">

  <?php if (isset($_SESSION['username'])) { ?>
    
    <span class="nav-user-greeting">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
    <a href="landing.php">Portfolios</a>
    <a href="logout.php">Logout</a>

  <?php } else { ?>

    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>

  <?php } ?>
  
</nav>