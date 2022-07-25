$(function() {
    var table = $('#category').DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        scrollX: true,
        ajax: datatbleurl,
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'slug',
                name: 'slug'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });
});