<?php
// assign posted values to variables
$roomID = $_POST['rId'];
$userName = $_POST['uname'];
$userId = $_POST['uId'];
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

//load the xml file
$file = sprintf("../servers/chatrooms/%s.xml", $roomID);
$doc = new DOMDocument('1.0', 'utf-8');
$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;

// I set it to toronto because for some reason my machine detects Europe
// when I leave the date blank
$date = new DateTime(null, new DateTimeZone('America/Toronto'));
$formatted_date = $date->format('M-d-Y g:i:s a');

$doc->load($file);
$messages = $doc->getElementsByTagName("messages")[0];

// create a new element <message>
$new_message = $doc->createElement("message");

// create element <text>
$message_text = $doc->createElement("text");

// create element <timestamp>
$new_timestamp = $doc->createElement("timestamp");

// create the atttributes for <message>
$msgUserIdAttr = $doc->createAttribute("userid");
$msgUserNameAttr = $doc->createAttribute("username");

// add attribute values
$msgUserIdAttr->value = $userId;
$msgUserNameAttr->value = $userName;

// append message text to <text>
$new_message_text = $doc->createTextNode($message);
$message_text->appendChild($new_message_text);

// append timestamp value to <timestamp>
$new_timestamp_val = $doc->createTextNode((string)$formatted_date);
$new_timestamp->appendChild($new_timestamp_val);

// add attributes to <message>
$new_message->appendChild($msgUserIdAttr);
$new_message->appendChild($msgUserNameAttr);

// append to <message>
$new_message->appendChild($message_text);
$new_message->appendChild($new_timestamp);

//add $new_message to $messages
$messages->appendChild($new_message);

$doc->save($file);

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
