<div id="Orders">
  <h2 class="title">Orders</h2>

  <div class="orders-container">
  <?php foreach($data->getOrders($_SESSION['id']) as $item) : ?>
    <div class="card">
      <h3><?= $item->name ?></h3>
      <p><?= $item->description ?></p>
      <div class="bar">
        <p class="value"><?= $item->percentage ?>%</p>
        <div class="progres" style="width: <?= $item->percentage ?>%;"></div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>

</div>