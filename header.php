<?php
require_once 'lib/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="716615577613-ufvjiedkatkcbvu7c3ofm222h8bv2pl5.apps.googleusercontent.com">
    <title>Chat Room</title>
    <link rel="stylesheet" href="public/style.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
    <header>
      <div id="logo">
        <h1>Chat Room</h1>
      </div>
      <nav id="nav">
        <?php if(isset($_SESSION['user']) && isset($_SESSION['userid']))
        {?>
        <ul>
          <li><a href="server.php">Server List</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      <?php }?>
      </nav>
    </header>
    <div class="wrapper">
