<div id="Users">
  <h2 class="title">Users</h2>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>UUID</th>
        <th>Name</th>
        <th>Lastname</th>
        <th>Username</th>
        <th>Email</th>
        <th>Position</th>
        <th>Verified</th>
      </tr>
    </thead>
    
    <tbody>
    <?php foreach($data->getUsers() as $item) : ?>
      <tr>
        <td><?= $item->id ?></td>
        <td>#<?= $item->uuid ?></td>
        <td><?= $item->name ?></td>
        <td><?= $item->lastname ?></td>
        <td><?= $item->username ?></td>
        <td><?= $item->email ?></td>
        <td><?= $data->getPosition($item->type) ?></td>
        <td><?= $item->verified = 1 ? "<i class='bx bxs-check-circle true'></i>" : "<i class='bx bx-error false'></i>" ?> </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>