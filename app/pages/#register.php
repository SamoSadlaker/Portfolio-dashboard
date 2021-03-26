<?php
$auth->aLoged();
?>
<main id="Register">

  <div class="container">
    <div class="head">
      <img src="assets/img/logo.svg" alt="Logo">
      <h1>Register page</h1>
    </div>
    <form id="registerForm" method="POST">
      <p id="error"></p>
      <div class="row">
        <div class="col">
          <label for="name">Name</label>
          <input type="test" name="name" id="name" required placeholder="your name">
        </div>
        <div class="col">
          <label for="lastname">Lastname</label>
          <input type="text" name="lastname" id="lastname" required placeholder="your lastname">
        </div>

      </div>

      <div class="line">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required placeholder="your username">
      </div>

      <div class="line">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required placeholder="your email">
      </div>
      
      <div class="line">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required placeholder="your password">
        <i class='bx bxs-low-vision'></i>
      </div>

      <button type="submit">Register</button>

    </form>

    <p>If you have account, just login.  <a href="/login">Login here</a></p>

  </div>

</main>