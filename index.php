<?php
session_start();
require_once 'header.php';

if(isset($_SESSION) && !empty($_SESSION)){
    header('Location: server.php');
}

?>
<main>
  <div class="loginForm">
    <form class="login" action="login.php" method="post">
      <label for="user_name">Username:</label>
      <input type="text" name="username" id="username"/>
      <input type="submit" name="login" value="Login"/>
    </form>
  </div>
</main>
<?php require_once 'footer.php'; ?>
