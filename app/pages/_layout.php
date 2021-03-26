<?php
$auth->isLoged();

 ?>
  <nav class="navbar">
    <a href="/" class="logo"><img src="assets/img/Logo.svg" alt="logo"></a>
    <div class="info">
      <span><i class='bx bx-alarm'></i><?= Date("H:i") ?></span>
      <span><i class='bx bx-calendar'></i><?= Date("d.m. Y") ?></span>
    </div>
    <a href="/logout" class="logout"><i class='bx bx-log-out'></i></a>
  </nav>

  <aside id="Sidebar" class="sidebar ">
    <p id="menu" class="menu"><i class='bx bx-menu'></i></p>
    <div class="container">
      <div class="head">
        <!-- <img src="assets/img/profile.png" alt="" class="profile"> -->
        <p class="name"><?= $_SESSION['name'] . " " . $_SESSION['lastname'] ?></p>
        <span id="uuid">#<?= $_SESSION['uuid'] ?></span>
        <span id="active"><i class='bx bxs-check-circle'></i> Active</span>
      </div>
      <ul class="sidebar-list">
        <li class="sidebar-item"><a href="/" class="sidebar-link"><i class='bx bx-home'></i> Home</a></li>
        <li class="sidebar-item"><a href="/users" class="sidebar-link"><i class='bx bxs-user' ></i> Users</a></li>
        <li class="sidebar-item"><a href="/chat" class="sidebar-link"><i class='bx bx-chat' ></i> Chat</a></li>
        <li class="sidebar-item"><a href="/invoices" class="sidebar-link"><i class='bx bx-credit-card' ></i> Invoices</a></li>
        <li class="sidebar-item"><a href="/orders" class="sidebar-link"><i class='bx bx-server' ></i> Orders</a></li>
        <li class="sidebar-item"><a href="/ticket" class="sidebar-link"><i class='bx bx-receipt' ></i> Tickets</a></li>
        <li class="sidebar-item"><a href="/todo" class="sidebar-link"><i class='bx bx-calendar-check' ></i> To-do</a></li>
      </ul>
      <div class="foot">
        <a class="settings" href="/settings"><i class='bx bx-slider-alt'></i></a>
        <a class="logout" href="/logout">Logout</a>
      </div>
    </div>
    

  </aside>

  <?php $routing->getContent($page) ?>

  <footer>
    <p>version 0.1</p>
    <p>Copyright &copy; <?= Date("Y") ?> | All rights reserved</p>
    <p>Created by <a href="https://samosadlaker.eu" target="_blank">SamoSadlaker</a></p>
  </footer>