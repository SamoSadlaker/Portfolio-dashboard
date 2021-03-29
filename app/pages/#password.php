<?php
$id = $auth->recoverPassword();
?>
<main id="Password">

  <div class="container">
    <div class="head">
      <img src="assets/img/logo.svg" alt="Logo">
      <h1>New password</h1>
    </div>
    <form id="passwordForm" method="POST">
      <p id="error"></p>
      <div class="line">
        <label for="password">New password</label>
        <input type="password" name="password" id="password" required placeholder="new password">
      </div>
      <div class="line">
        <label for="again">Password again</label>
        <input type="password" name="again" id="again" required placeholder="password again">
      </div>
      <input type="text" style="display: none;" name="uid" id="uid" value="<?= $id ?>">

      <button type="submit">Change password</button>
    </form>

  </div>

</main>