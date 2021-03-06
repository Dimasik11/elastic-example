<?php

use models\SearchModel;

require_once 'basic/Autoloader.php';
require_once 'vendor/autoload.php';

Autoloader::autoload();

$model = new SearchModel($_GET['term']);

echo json_encode($model->search());
