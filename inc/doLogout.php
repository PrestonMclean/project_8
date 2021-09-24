<?php
require_once 'bootstrap.php';
    
$session->clear();
$session->getFlashBag()->add('success', 'Successfully Logged Out');
redirect('/');
