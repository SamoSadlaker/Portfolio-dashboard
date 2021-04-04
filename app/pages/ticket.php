<div id="Tickets">
  <h2 class="title">Ticketlist</h2>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Type</th>
        <th>Status</th>
        <th>Created</th>
        <th>Read</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach($data->getTickets($_SESSION['ID']) as $item) : ?>
      <tr>
        <td><?= $item->id ?></td>
        <td><?= $item->name ?></td>
        <td><?= $item->type ?></td>
        <td><?= $item->status ?></td>
        <td><?= $item->created ?></td>
        <td>Open</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>