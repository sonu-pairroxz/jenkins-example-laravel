$(function() {
    var table = $('#portfolio').DataTable({
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
                data: 'project_type',
                name: 'project_type'
            },
            {
                data: 'project_name',
                name: 'project_name'
            },

            {
                data: 'status',
                name: 'status'
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