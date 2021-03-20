<section id="Main">
  <nav class="navbar">
    <a href="/" class="logo"><img src="assets/img/Logo.svg" alt="logo"></a>
    <div class="info">
      <span><i class='bx bx-alarm'></i><?= Date("H:i") ?></span>
      <span><i class='bx bx-calendar'></i><?= Date("d.m. Y") ?></span>
    </div>
    <a href="/logout" class="logout">Logout</a>
  </nav>

  <aside class="sidebar">

  </aside>

  <?php $routing->getContent($page) ?>


  <footer>
    <p>version 0.1</p>
    <p>Copyright &copy; <?= Date("Y") ?> | All rights reserved</p>
    <p>Created by <a href="https://samosadlaker.eu" target="_blank">SamoSadlaker</a></p>
  </footer>

</section>