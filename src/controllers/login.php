<?php
loadModel('Login');
$exception = null;

if(count($_POST) > 0) {
  $login = new Login($_POST);
  try {
    $user = $login->checkLogin();
    echo "User {$user->name} logged";
    header("Location: day_records.php");
  } catch(AppException $e) {
    $exception = $e;
  }
}

loadView('login', $_POST + ['exception' => $exception]);