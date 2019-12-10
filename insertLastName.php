<?php
require_once 'basic/Autoloader.php';
require_once 'vendor/autoload.php';

Autoloader::autoload();

use models\ElasticComponent;

$model = new ElasticComponent();

$model->loadData();