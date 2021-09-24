<?php
require_once 'bootstrap.php';

$username = request()->get('username');
$password = request()->get('password');
$user = getUserByUsername($username);

if (empty($user) || !password_verify($password, $user['password'])) {
    $session->getFlashBag()->add('error', 'username or password is incorrect');
    redirect('/login.php');
}

loginUser($user);
$session->getFlashBag()->add('success', $username . ' is successfuly loggedin');
redirect('/');