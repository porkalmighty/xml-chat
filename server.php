<?php
session_start();
require_once 'header.php';
if(!isset($_SESSION) || empty($_SESSION)){
    header('Location: index.php');
}
echo sprintf("<h1>Welcome, %s!</h1>", $_SESSION['user']);
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
        echo sprintf("<li class='channel__name'><span class='channel-name'>Channel: %s </span>", $channel->name);
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
if(isset($_GET['err']))
{
    if($_GET['err'] == 404)
    {
        echo sprintf("<script>alert('Error loading chatroom, please try again');</script>");
    }
}
require_once 'footer.php';?>
