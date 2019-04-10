<?php
session_start();
require_once 'header.php';
$msg = "";
if(!isset($_SESSION) || empty($_SESSION)){
    header('Location: index.php');
}

if (isset($_GET['err'])) {
  switch($_GET['err'])
  {
    case "404":
      $msg = "Failed to load chatroom! please try again!";
    break;
  }
}
echo sprintf("<div class='msg'>%s</div>", $msg);
echo sprintf("<h2>Welcome, %s!</h2>", $_SESSION['user']);
?>
<div class="chatroom">
  <div class="chatroom__list">
    <?php
    //load XML
    $chatServer = simplexml_load_file("servers/chatroomserver.xml");
    foreach($chatServer as $k => $v)
    {
      echo "<section class='channels'>";
      echo sprintf("<h2>%s Server</h2>", $v->location);
      echo "<ul>";
      foreach ($v->xpath('.//channel') as $channel) {
        echo sprintf("<li class='channel__name'><span class='name'>Channel: %s </span>", $channel->name);
        echo "<ul>";
        foreach ($channel->xpath('.//chatroom') as $chatrooms => $chatroom)
        {
          echo "<li>";
          echo "<form action='chatroom.php' method='post'>";
          echo sprintf("<input type='hidden' value='%s' name='roomId'>", $chatroom->id);
          echo sprintf("<input type='hidden' value='%s' name='roomName'>", $chatroom->name);
          echo sprintf('<button class="roomList" type="submit"><span class="serverName">%s</span> <div class="btnWrap"><span class="server-type">type: %s</span><span class="server-id">id: %s</span></div></button>', $chatroom->name, $chatroom->type, $chatroom->id);
          echo "</form>";
          echo "</li>";
        }
        echo "</ul>";
        echo "</li>";
      }
      echo "</ul>";
      echo "</section>";
    }
    ?>
  </div>
</div>
<?php
require_once 'footer.php';?>
