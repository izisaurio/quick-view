<?php

require '../vendor/autoload.php';

use QuickView\View, Inn\Response\Html;

$view = new View('template.php', [
	'name' => 'izisaurio',
	'mail' => 'izi.iisaac@gmail.com',
]);

$response = new Html($view);
$response->send();