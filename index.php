<?php

use models\SearchModel;

require_once 'basic/Autoloader.php';

Autoloader::autoload();

$model = new SearchModel();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/script.js"></script>

    <title>Пример работы с elastic-search</title>
</head>
<body>
<div class="container">
    <div class="btn-index-block">
        <button class="create-index btn btn-success">
            Создать индекс
        </button>
        <button class="delete-index btn btn-danger">
            Удалить индекс
        </button>
    </div>
    <div class="row">
        <div class="search-block">
            <input type="text" class="form-control" placeholder="Введите запрос" id="search-field">
        </div>
    </div>
</div>
</body>
</html>
