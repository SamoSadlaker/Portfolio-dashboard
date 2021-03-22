<section id="Main">
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
        <img src="assets/img/profile.png" alt="" class="profile">
        <span class="name">Samo Sadlaker</span>
        <span>#54235298</span>
        <p><i class='bx bxs-check-circle'></i> <span>Active</span></p>
      </div>
      <ul class="sidebar-list">
        <li class="sidebar-item"><a href="/" class="sidebar-link"><i class='bx bx-home'></i> <span>Home</span></a></li>
        <li class="sidebar-item"><a href="/users" class="sidebar-link"><i class='bx bxs-user' ></i> <span>Users</span></a></li>
        <li class="sidebar-item"><a href="/chat" class="sidebar-link"><i class='bx bx-chat' ></i> <span>Chat</span></a></li>
        <li class="sidebar-item"><a href="/invoices" class="sidebar-link"><i class='bx bx-credit-card' ></i> <span>Invoices</span></a></li>
        <li class="sidebar-item"><a href="/orders" class="sidebar-link"><i class='bx bx-server' ></i> <span>Orders</span></a></li>
        <li class="sidebar-item"><a href="/ticket" class="sidebar-link"><i class='bx bx-receipt' ></i> <span>Tickets</span></a></li>
        <li class="sidebar-item"><a href="/todo" class="sidebar-link"><i class='bx bx-calendar-check' ></i> <span>To-do</span></a></li>
      </ul>
      <div class="foot">
        <a class="settings" href="/settings"><i class='bx bx-slider-alt' ></i></a>
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


</section>