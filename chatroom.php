<?php
session_start();

if(!isset($_SESSION) || empty($_SESSION)){
    header('Location: index.php');
}
require_once 'header.php';
if(isset($_POST['roomId']) && isset($_POST['roomName']))
{
  $username = $_SESSION['user'];
  $userId = $_SESSION['userid'];
  $chatId = $_POST['roomId'];
  $chatName = $_POST['roomName'];
  $file = sprintf("servers/chatrooms/%s.xml", $chatId);

  // check if the file exists
  // create if it does not exist yet

  if(file_exists($file))
  {
    $chatRoom = simplexml_load_file($file);
  }
  else
  {
    $chatSettings = array(
      "id" => $chatId,
      "name" => $chatName,
      "file" => $file
    );

    $newRoom = createChatroom($chatSettings);

    if($newRoom)
    {
      $chatRoom = simplexml_load_file($file);
    }
    else
    {
      header("Location: server.php?err=404");
    }
  }
}
else
{
  header("Location: index.php");
}
?>
<h2> You are in chatroom: <?= $chatName; ?></h2>
<div class="chatInterface">
  <div class="chatInterface__window">
    <?php
      // load messages
      $messages = $chatRoom->xpath('//message');

      foreach($messages as $message => $m)
      {
        echo "<div class='chat-bubble'>";
        echo "<div class='chathead'>";
        echo sprintf("<span class='chatuser'>%s:</span>", $m->attributes()->username);
        echo sprintf("<span class='timestamp'>%s</span>", $m->timestamp);
        echo "</div>";
        echo "<div class='chatmsg'>";
        echo sprintf("<span class='chatmsgtxt'>%s</span>", $m->text);
        echo "</div>";
        echo "</div>";
      }

    ?>
  </div>
  <div class="chatInterface__controls">
    <form class="chatbox">
      <textarea name="chatArea" rows="8" cols="80" id="chatArea"></textarea>
      <input type="hidden" id="roomId" value="<?= $chatId;?>">
      <input type="hidden" id="userId" value="<?= $userId;?>">
      <input type="hidden" id="userName" value="<?= $username;?>">
      <button type="button" id="sendBtn">Send</button>
    </form>
  </div>
</div>
<?php require_once 'footer.php'; ?>
