<?php

$stats = $data->getStats();


?>
<div id="Index">
  <div class="info">
    <div class="badge">
      <i class='bx bxs-user-rectangle'></i>
      <div class="data">
        <span><?= $stats[0] ?></span>
        <p>Users</p>
      </div>
      
    </div>
    <div class="badge">
      <i class='bx bx-credit-card'></i>
      <div class="data">
        <span><?= $stats[1] ?></span>
        <p>Orders</p>
      </div>
      
    </div>
    <div class="badge">
      <i class='bx bx-receipt' ></i>
      <div class="data">
        <span><?= $stats[2] ?></span>
        <p>Tickets</p>
      </div>
      
    </div>
  </div>

  <div class="about">
    <h3>Informations</h3>
    <table>
      <tbody>
        <tr>
          <th>UUID:</th>
          <td>#<?= $_SESSION['uuid'] ?></td>
        </tr>
        <tr>
          <th>Name:</th>
          <td><?= $_SESSION['name'] ?></td>
        </tr>
        <tr>
          <th>Lastname:</th>
          <td><?= $_SESSION['lastname'] ?></td>
        </tr>
        <tr>
          <th>Username:</th>
          <td><?= $_SESSION['username'] ?></td>
        </tr>
        <tr>
          <th>Email:</th>
          <td><?= $_SESSION['email'] ?></td>
        </tr>
        <tr>
          <th>Possition:</th>
          <td><?= $data->getPosition($_SESSION['rank']) ?></td>
        </tr>
        <tr>
          <th>Verified:</th>
          <td><?= ($_SESSION['verified'] == "1") ? "true" : "false" ?></td>
        </tr>

      </tbody>
    </table>
  </div>
</div>