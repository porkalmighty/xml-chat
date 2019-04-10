<?php
session_start();

require_once('lib/functions.php');
if(isset($_POST['login']))
{
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // strip all special characters except underscore(_)
  // reference: https://www.php.net/manual/en/function.preg-replace.php
  $username = preg_replace('/[^a-zA-Z0-9\_]/', '', $username);

  // sanitize the string
  // reference: https://www.php.net/manual/en/filter.filters.sanitize.php
  $name = filter_var($username, FILTER_SANITIZE_STRING);

  $file = 'users.xml';
  // check if user is registered
  $users = simplexml_load_file($file);
  $userPath = sprintf('//user[contains(username, "%s")]', $username);
  $user = $users->xpath($userPath);
  $id = $users->xpath('//user[last()]/id');

  if($id)
  {
    //cast id to integer, and increment by 1
    $id = intval($id) + 1;
  }
  else
  {
    // if id does not exist, set id to 1
    $id = 1;
  }

  if($user)
  {
    $acc_pass = (string)$user[0]->password;
    if(password_verify($password, $acc_pass))
    {
      // if the password is correct, store it in session then redirect to servers.php
       $_SESSION['userid'] = intval($user[0]->id);
       $_SESSION['user'] = (string)$user[0]->username;
       header("Location: server.php");
    }
    else
    {
      // redirect to login page and show error
      header("Location: index.php?login=incorrectpw");
    }
  }
  else
  {
    // hash Password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $account = array(
      "id" => $id,
      "name" => $name,
      "pass" => $hashed_password,
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
