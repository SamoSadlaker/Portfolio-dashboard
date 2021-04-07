<div id="Settings">
  <h2 class="title">Settings</h2>
  
  <div class="container">
    <section class="password-container">
      <h5>Change password</h5>
      <form class="form" id="updatePassword" method="post">
        <p id="pError"></p>
        <div class="line">
          <label for="old-password">Current password</label>
          <input type="password" required placeholder="old password" id="oPassword">
        </div>
        <div class="line">
          <label for="new-password">New password</label>
          <input type="password" required placeholder="new password" id="pPassword">
        </div>
        <div class="line">
          <label for="new-password-again">New password again</label>
          <input type="password" required placeholder="new password again" id="pPasswordAgain">
        </div>
        <button class="submit" type="submit">Change password</button>
      </form>
    </section>
    <section class="email-container">
      <h5>Update email</h5>
      <form class="form" id="updateEmail" method="post">
        <p id="eError"></p>
        <div class="line">
          <label for="email">New email</label>
          <input type="email" required placeholder="new email" id="uEmail">
        </div>
        <div class="line">
          <label for="password">Password</label>
          <input type="password" required placeholder="your password" id="uPassword">
        </div>
        <button class="submit" type="submit">Change email</button>
      </form>
    </section>
    <section class="upload-container">
      <h5>Change profile picture</h5>
      <p id="error"></p>
      <div class="drop-area">
        <i class='bx bxs-cloud-upload'></i>
        <span class="upload">You can drop image here, or</span>
        <button id="uploadBtn">Upload image</button>
        <input id="uploadInput" type="file" hidden>
      </div>
      
    </section>
  </div>
 
</div>