$(document).ready(function () {

    const DELAY = 450;

    "use strict";

    let $btnCreate = $('.create-index'),
        $btnDelete = $('.delete-index'),
        $btnInsert = $('.insert-data'),
        $resultBlock = $('.result-block'),
        $searchField = $('#search-field');
    
    
    $btnCreate.on('click', function () {
        createIndex($(this));
    });

    $btnDelete.on('click', function () {
        deleteIndex($(this));
    });

    $btnInsert.on('click', function () {
        insertData();
    });

    // Отправляем запросы на получение адресов черезе DELAY после окончания ввода
    $searchField.on('keyup', $.debounce(DELAY, function (e) {
        let term = $(this).val();
        $resultBlock.empty();

        if (term.length >= 3) {
            search($(this).val());
        }
    }));


    const createIndex = ($object) => {
        $.ajax({
            url: '/createIndex.php',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                console.log(2312);
                alert('Индекс успешно создан');
            },
        });
    };

    const deleteIndex = ($object) => {
        $.ajax({
            url: '/deleteIndex.php',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                console.log(2312);
                alert('Индекс успешно удален');
            },
        });
    };

    const search = (val) => {
        $.ajax({
            url: '/search.php',
            type: 'GET',
            dataType: 'json',
            data: {term : val},
            success: function (response) {
                console.log(response);
                showListLastNames(response);
            },
        });
    };

    const insertData = () => {
        $.ajax({
            url: '/insertLastName.php',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                alert('Данные успешно залиты');
            },
        });
    };

    const showListLastNames = (data) => {
        let str = '';
        data.map(function (item) {
            str += '<div>' +item+ '</div>';
        });

        $resultBlock.html(str);
    }
});