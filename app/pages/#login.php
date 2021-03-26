<?php
$auth->aLoged();
?>
<main id="Login">

  <div class="container">
    <div class="head">
      <img src="assets/img/logo.svg" alt="Logo">
      <h1>Login page</h1>
    </div>
    <form id="loginForm">
      <p id="error"></p>
      <div class="line">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required placeholder="your email">
      </div>
      
      <div class="line">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required placeholder="your password">
        <i class='bx bxs-low-vision'></i>
      </div>

      <button type="submit">Login</button>

    </form>

    <p>If you don't have account, create one.  <a href="/register">Register here</a></p>

  </div>

</main>