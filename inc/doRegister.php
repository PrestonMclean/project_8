<?php
require_once 'bootstrap.php';

$username = request()->get('username');
$password = request()->get('password');
$confirmPassword = request()->get('confirm_password');

if ($password != $confirmPassword) {
    $session->getFlashBag()->add('error', 'passwords do NOT match');
    redirect('/register.php');
}

$dbUser = getUserByUsername($username);

if (!empty($dbUser)) {
    $session->getFlashBag()->add('error', 'username already exists');
    redirect('/register.php');
}


$hPassword = password_hash($password, PASSWORD_DEFAULT);
if (saveUserData($username, $hPassword)) {
    $session->getFlashBag()->add('success', $username . ' was added');
    loginUser(getUserByUsername($username));
    $session->getFlashBag()->add('success', $username . ' was loggedin');
    redirect('/');
}
