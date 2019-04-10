<?php
session_start();
require_once 'header.php';

$msg = "";
if(isset($_SESSION['userid']) && isset($_SESSION['username']) || !empty($_SESSION['userid']) && !empty($_SESSION['username'])){
    header('Location: server.php');
}

if (isset($_GET['login'])) {
  switch($_GET['login'])
  {
    case "incorrectpw":
      $msg = "Incorrect Password!";
    break;
    case "failed":
      $msg = "Unknown error has occurred!";
    break;
  }
}
?>
<main>
  <div class="loginForm">
    <div class="flex-wrap">
      <form class="login" action="login.php" method="post">
        <h2 class="inverted">Login</h2>
        <div class="group">
          <label for="username">Username:</label>
          <input type="text" name="username" id="username"/>
        </div>
        <div class="group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password"/>
        </div>
        <div class="msg"><?= $msg; ?></div>
        <div class="group btn-group">
          <input type="submit" name="login" value="Login" class="btn btn-login"/>
          <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
        </div>
      </form>
    </div>
  </div>
</main>
<?php require_once 'footer.php'; ?>
