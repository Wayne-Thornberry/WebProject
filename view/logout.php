<?php

use itb\User;

$_SESSION['LoggedIn'] = false;
$_SESSION['User'] = new User('','','','','','','','');
header('location: ?view=5&login=1');