<?php
require_once 'bootstrap.php';


$current_password = request()->get('current_password');
$new_password = request()->get('password');
$confirm_password = request()->get('confirm_password');

if ($new_password != $confirm_password) {
    $session->getFlashBag()->add('error', 'new passwords do NOT match');
    redirect('/account.php');
}

if (!password_verify($current_password, getPasswordById($session->get('id')))) {
    $session->getFlashBag()->add('error', 'password is wrong');
    redirect('/account.php');
}

$hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

if (changePassword($hashedPassword, $session->get('id'))) {
    $session->getFlashBag()->add('success', 'password is changed');
    redirect('/');
}