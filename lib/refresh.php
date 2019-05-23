<?php
// assign posted values to variables
$roomID = $_POST['rId'];

//load the xml file
$file = sprintf("../servers/chatrooms/%s.xml", $roomID);
$node = simplexml_load_file($file);
// xpath last reference -> https://www.w3schools.com/xml/xpath_syntax.asp
// xml tested on https://codebeautify.org/Xpath-Tester
$lastItem = $node->xpath('//message');
$items = array();


// I changed this because the css styles arent applying when I try to pring the elements via Jquery

// foreach($lastItem as $last)
// {
//     $items[] = array(
//         "username" => (string)$last->attributes()->username,
//         "message" => (string)$last[0]->text,
//         "timestamp" => (string)$last[0]->timestamp
//     );
// }

$item = "";
foreach($lastItem as $last)
{
  $item .= "<div class='chat-bubble'>";
  $item .=  "<div class='chathead'>";
  $item .=  sprintf("<span class='chatuser'>%s:</span>", (string)$last->attributes()->username);
  $item .=  sprintf("<span class='timestamp'>%s</span>", (string)$last[0]->timestamp);
  $item .=  "</div>";
  $item .=  "<div class='chatmsg'>";
  $item .=  sprintf("<span class='chatmsgtxt'>%s</span>", (string)$last[0]->text);
  $item .=  "</div>";
  $item .=  "</div>";
}

echo $item;
