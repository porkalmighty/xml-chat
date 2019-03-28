<?php
require_once 'header.php';
?>
<main>
  <div class="loginForm">
    <form class="login" action="lib/login.php" method="post">
      <label for="user_name">Username:</label>
      <input type="text" name="username" id="username"/>
      <input type="submit" name="login" value="Login"/>
    </form>
  </div>
</main>
<?php require_once 'footer.php'; ?>
