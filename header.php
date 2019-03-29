<?php
require_once 'lib/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Chat Room</title>
    <link rel="stylesheet" href="public/style.css">
  </head>
  <body>
    <div class="wrapper">
      <?php if(isset($_SESSION['user']) && isset($_SESSION['userid']))
      {?>
      <header>
        <nav id="nav">
          <ul>
            <li><a href="server.php">Server List</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </header>
      <?php }?>
