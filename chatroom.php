<?php
//load XML
$chatServer = simplexml_load_file("servers/chatroomserver.xml");

echo "<h1>Welcome, User!</h1>";
echo "<h2>Select a room:</h2>";
foreach($chatServer as $k => $v)
{
  echo "<section class='channels'>";
  echo sprintf("<h2>%s Server</h2>", $v->attributes()->location);
  echo "<ul>";
  foreach ($v->xpath('.//channel/@name') as $channel => $name) {
    echo "<li> Channel: " . $name;
    echo "<ul>";
    foreach ($v->xpath('.//chatroom') as $y => $z) {
      echo sprintf('<li><button class="btnRoom" type="button" value="%s">%s | %s</button></li>', $z->attributes()->id, $z->roomName, $z->attributes()->type);
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
// echo sprintf("<li>%s</li>", $v->xpath('//roomName'));
// echo "</ul>";
