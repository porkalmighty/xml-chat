<?php
require_once 'header.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$chatId = "can1002";
$chatName = "Bachika";
$path = sprintf("servers/chatrooms/%s.xml", $chatId);

if(file_exists($path))
{
  $chatRoom = simplexml_load_file($path);
}
else
{
  // create the chat room
  $doc = new DOMDocument('1.0', 'utf-8');
  $doc->preserveWhiteSpace = false;
  $doc->formatOutput = true;

  $root = $doc->createElement("chatrooms");
  $chatroom = $doc->createElement("chatroom");
  $id = $doc->createElement("id");
  $name = $doc->createElement("name");
  $messages = $doc->createElement("messages");

  // add values to elemets
  $id->nodeValue = $chatId;
  $name->nodeValue = $chatName;

  // append the elements to root
  $chatroom->appendChild($id);
  $chatroom->appendChild($name);
  $chatroom->appendChild($messages);
  $root->appendChild($chatroom);
  $doc->appendChild($root);

  // save the xml
  if($doc->save($path))
  {
    $chatRoom = simplexml_load_file($path);
  }
  else
  {
    echo "failed";
  }
}
?>
<div class="chatInterface">
  <div class="chatInterface__window"></div>
  <div class="chatInterface__controls">
    <form class="chatbox" action="" method="post">
      <textarea name="chatArea" rows="8" cols="80" id="chatArea"></textarea>
      <button type="submit" name="sendChat" id="sendBtn">Send</button>
    </form>
  </div>
</div>
<?php require_once 'footer.php'; ?>
