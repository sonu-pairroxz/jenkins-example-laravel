$(function() {
    var table = $('#optionvalue').DataTable({
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
                data: 'option_name',
                name: 'option_name'
            },
            {
                data: 'options',
                name: 'options'
            },
            {
                data: 'sort_no',
                name: 'sort_no'
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