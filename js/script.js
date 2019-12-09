$(document).ready(function () {
    "use strict";

    let $btnCreate = $('.create-index'),
        $btnDelete = $('.delete-index');
    
    
    $btnCreate.on('click', function () {
        createIndex($(this));
    });

    $btnDelete.on('click', function () {
        deleteIndex($(this));
    });


    const createIndex = ($object) => {
        $.ajax({
            url: '/createIndex.php',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
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
            },
        });
    };
});