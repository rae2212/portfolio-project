<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> My Digital Portfolio</title>
  <link rel="stylesheet" href="css/site.css">

  <?php if (isset($extraCss)): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($extraCss) ?>">
  <?php endif; ?>
</head>

<body>

  <header class="site-header">
    <a href="index.php" class="site-title">MDP</a>
  </header>