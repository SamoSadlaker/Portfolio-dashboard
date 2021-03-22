<!DOCTYPE html>
<html lang="sk">
<head>
  <!-- Basic Meta Tags -->
  <meta charset="UTF-8">
  <meta name="title" content="Dasboard SamoSadlaker's Portfolio">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="My name is SamoSadlaker, I am a web developer. This is my portfolio where you can find information about me and my projects.">
  <meta name="keywords" content="Portfolio, Web Development, Frontend, Backend, PHP, HTML, CSS, Java, Spigot, Developer, SamoSadlaker">
  <meta name="author" content="SamoSadlaker">
  <meta name="robots" content="noindex">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="assets/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="assets/img/favicons/safari-pinned-tab.svg" color="#008bf8">
  <link rel="shortcut icon" href="assets/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#151515">
  <meta name="msapplication-config" content="assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#151515">

  <!-- Page Title -->
  <title> <?= $routing->getPageName() ?> | Dashboard</title>
  <!-- Import Boxicons  -->
  <link rel="stylesheet" href="assets/css/boxicons.min.css">

  <!-- Import Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.min.css">
  
</head>
<body>
  
  <?php $routing->getPage() ?>

  <script src="assets/js/main.js"></script>

</body>
</html>