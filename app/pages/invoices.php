<div id="Invoices">
  <h2 class="title">Invoices</h2>


  <div class="invoice-container">
  <?php foreach($data->getInvoices($_SESSION['id']) as $item) : ?>
    <div class="card <?= ($item->status == "1") ? "done" : " "  ?>">
      <i class='bx bxs-file-pdf'></i>
      <p><?= $item->name ?></p>
      <a target="_blank" href="assets/docs/<?= $item->link ?>">View</a>
      <time><?= date("d.m.Y - H:i",strtotime($item->created)) ?></time>
    </div>
  <?php endforeach ?>
    
  </div>
 

</div>