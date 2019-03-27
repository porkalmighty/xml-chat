<?php
//load XML
$chatServer = simplexml_load_file("servers/chatroomserver.xml");

echo "<h1>Welcome, User!</h1>";
echo "<h2>Select a room:</h2>";
foreach($chatServer as $k => $v)
{
  echo "<section class='channels'>";
  echo sprintf("<h2>%s Server</h2>", $v->location);
  echo "<ul>";
  foreach ($v->xpath('.//channel') as $channel) {
    echo sprintf("<li class='channel__name'><span class='channel-name'>Channel: %s </span>", $channel->name);
    echo "<ul>";
    foreach ($channel->xpath('.//chatroom') as $chatrooms => $chatroom) {
      echo sprintf('<li><button class="roomList" type="button" value="%s">%s <div class="btnWrap"><span class="server-type">type: %s</span><span class="server-id">id: %s</span></button></div></li>', $chatroom->id, $chatroom->name, $chatroom->type, $chatroom->id);
    }
    echo "</ul>";
    echo "</li>";
  }
  echo "</ul>";
  echo "</section>";
}

// echo "<pre>";
// var_dump($v);
// echo "<pre>";
// echo "<ul>";
// echo sprintf("<li>%s</li>", $v->xpath('//name'));
// echo "</ul>";
