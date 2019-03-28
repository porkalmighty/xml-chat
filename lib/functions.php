<?php
// this function will access the xml file
// if there is no available file, it will create the xml file
function createChatroom($parameters)
{
  $id = $parameters["id"];
  $name = $parameters["name"];
  $file = $parameters["file"];

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
  $id->nodeValue = $id;
  $name->nodeValue = $name;

  // append the elements to root
  $chatroom->appendChild($id);
  $chatroom->appendChild($name);
  $chatroom->appendChild($messages);
  $root->appendChild($chatroom);
  $doc->appendChild($root);

  // save the xml
  if($doc->save($file))
    return true;

  return false;
}
