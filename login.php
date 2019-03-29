<?php
session_start();

require_once 'lib/functions.php';
if(isset($_POST['login']))
{
  $username = trim($_POST['username']);
  // strip all special characters except underscore(_)
  // reference: https://www.php.net/manual/en/function.preg-replace.php
  $username = preg_replace('/[^a-zA-Z0-9\_]/', '', $username);

  // sanitize the string
  // reference: https://www.php.net/manual/en/filter.filters.sanitize.php
  $name = filter_var($username, FILTER_SANITIZE_STRING);

  $file = 'users.xml';
  // check if user is registered
  $users = simplexml_load_file($file);
  $xpath = sprintf('//user[contains(username, "%s")]', $username);
  $user = $users->xpath($xpath);
  $id = $users->xpath('//user[last()]/id')[0];
  //cast id to integer, and increment by 1
  $id = intval($id) + 1;

  if($user)
  {
    // if it exists, store it in session then redirect to servers.php
     $_SESSION['userid'] = intval($user[0]->id);
     $_SESSION['user'] = (string)$user[0]->username;
     header("Location: server.php");
  }
  else
  {
    $account = array(
      "id" => $id,
      "name" => $name,
      "file" => $file
    );

    $new_account = createAccount($account);
    if($new_account)
    {
      $_SESSION['user'] = $name;
      $_SESSION['userid'] = $id;
        header("Location: server.php");
    }
  }
}
