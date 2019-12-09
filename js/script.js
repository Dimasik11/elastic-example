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
        console.log('create');
    };

    const deleteIndex = ($object) => {
        console.log('delete');
    };
});