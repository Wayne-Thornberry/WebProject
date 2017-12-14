<?php

use itb\Database;

$pdo = new Database();
$pdo->setup();

echo '<a href="?view=0">return</a>';