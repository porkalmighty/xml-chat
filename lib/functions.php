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
  $cid = $doc->createElement("id");
  $cname = $doc->createElement("name");
  $messages = $doc->createElement("messages");

  // add values to elements
  $cid = $doc->createTextNode($id);
  $cname= $doc->createTextNode($name);

  // append the elements to root
  $chatroom->appendChild($cid);
  $chatroom->appendChild($cname);
  $chatroom->appendChild($messages);
  $root->appendChild($chatroom);
  $doc->appendChild($root);

  // save the xml
  if($doc->save($file)) return true;

  return false;
}

//create account function
function createAccount($parameters)
{
  $id = $parameters["id"];
  $name = $parameters["name"];
  $file = $parameters["file"];

  // create the chat room
  $doc = new DOMDocument('1.0', 'utf-8');
  $doc->preserveWhiteSpace = false;
  $doc->formatOutput = true;

  //load xml
  $doc->load($file);

  $user_list = $doc->getElementsByTagName("users")[0];
  // create new
  $new_user = $doc->createElement("user");
  $uid = $doc->createElement("id");
  $uname = $doc->createElement("username");

  // add values to elements
  $uid_val = $doc->createTextNode($id);
  $uid->appendChild($uid_val);

  $uname_val = $doc->createTextNode($name);
  $uname->appendChild($uname_val);

  // append the elements to user
  $new_user->appendChild($uid);
  $new_user->appendChild($uname);

  //append to users
  $user_list->appendChild($new_user);

  // save the xml
  if($doc->save($file)) return true;

  return false;
}

function checkLogin()
{
  if(isset($_SESSION['user']) && isset($_SESSION['userid']))
  {
    header("Location: server.php");
  }
  else
  {
    header("Location: index.php");
  }
}
