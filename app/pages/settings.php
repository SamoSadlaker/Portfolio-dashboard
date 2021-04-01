<div id="Settings">
  <h2 class="title">Settings</h2>
  
  <div class="container">
    <section class="password-container">
      <h5>Change password</h5>
      <form class="form" action="" method="post">
        <div class="line">
          <label for="old-password">Current password</label>
          <input type="password" name="old-password" required placeholder="old password" id="old-password">
        </div>
        <div class="line">
          <label for="new-password">New password</label>
          <input type="password" name="new-password" required placeholder="new password" id="new-password">
        </div>
        <div class="line">
          <label for="new-password-again">New password again</label>
          <input type="password" name="new-password-again" required placeholder="new password again" id="new-password-again">
        </div>
        <button class="submit" type="submit">Change password</button>
      </form>
    </section>
    <section class="email-container">
      <h5>Update email</h5>
      <form class="form" action="" method="post">
        <div class="line">
          <label for="email">New email</label>
          <input type="email" name="email" required placeholder="new email" id="email">
        </div>
        <div class="line">
          <label for="password">Password</label>
          <input type="password" name="password" required placeholder="your password" id="password">
        </div>
        <button class="submit" type="submit">Change email</button>
      </form>
    </section>
  </div>
 
</div>