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

$doc->load($file);
$messages = $doc->getElementsByTagName("messages")[0];

// create a new element <message>
$new_message = $doc->createElement("message");

// create the atttributes for <message>
$msgUserIdAttr = $doc->createAttribute("userid");
$msgUserNameAttr = $doc->createAttribute("username");

// add attribute values
$msgUserIdAttr->value = $userId;
$msgUserNameAttr->value = $userName;

// append message text to <message>
$new_message_text = $doc->createTextNode($message);
$new_message->appendChild($new_message_text);

// add attributes to <message>
$new_message->appendChild($msgUserIdAttr);
$new_message->appendChild($msgUserNameAttr);

//add $new_message to $messages
$messages->appendChild($new_message);

$doc->save($file);

$node = simplexml_load_file($file);
// xpath last reference -> https://www.w3schools.com/xml/xpath_syntax.asp
// xml tested on https://codebeautify.org/Xpath-Tester
$lastItem = $node->xpath('//message');
$items = array();

foreach($lastItem as $last)
{
    $items[] = array(
        "username" => (string)$last->attributes()->username,
        "message" => (string)$last[0]
    );
}

echo json_encode($items);
