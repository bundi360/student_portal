<?php
require_once 'config.php';
require_once 'Database.php';

$db = connect(DB_SERVER,USER,PASSWORD,DB_NAME);

echo $db;