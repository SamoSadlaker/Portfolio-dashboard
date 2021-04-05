<div id="Tickets">
  <h2 class="title">Ticketlist</h2>

  <a class="new" href="/newticket">Create ticket</a>

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
    <?php foreach($data->getTickets($_SESSION['id']) as $item) : ?>
      <tr>
        <td><?= $item->id ?></td>
        <td><?= $item->name ?></td>
        <td><?= $item->type ?></td>
        <td><?= $item->status = 1 ? "open" : "closed"  ?></td>
        <td><?= date("d.m.Y H:i", strtotime($item->created )) ?></td>
        <td><a href="#"><i class='bx bx-link'></i></a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>